

//globals for primary canvas
var stage, layer, canvas, bg, selectedGroup;
var verticalLines = [];
var serverTimerInterval;

//globals for drawing canvas
var drawStage, drawLayer, drawCanvas, drawContext, drawTool;
var drawColor = "#000000";
var drawRadius = 1;
var movingImage;
var mouseDown = false;

function handleMouseDown(evt){
	evt.preventDefault();
	evt.target.style.cursor = 'pointer';
};

function textUpdate(group, action, activeAnchor){
	var topLeft = group.getChild("topLeft");
	var bottomRight = group.getChild("bottomRight");
	var textShape = group.getChild("textShape");
	var lineHeight = textShape.fontSize;
	var context = textShape.context;
	context.font = textShape.fontSize + "pt " + textShape.fontFamily;

	
	switch(action){
		case "resize":
			textShape.possibleWidth = bottomRight.x-topLeft.x;
			textShape.possibleHeight = bottomRight.y-topLeft.y;
			textShape.wrap = true;
			break;
		case "tooWideResize":
			textShape.possibleWidth = stage.width-10;
			textShape.possibleHeight = textShape.textHeight;
			textShape.wrap = true;
			break;
	}
}

function update(group, activeAnchor){
    var center = group.getChild("center");
    var topLeft = group.getChild("topLeft");
    var bottomRight = group.getChild("bottomRight");
	var topRight = group.getChild("topRight");
    var image = group.getChild("image");
	var startHeight = image.height;
	var startWidth = image.width;
	var imageWidth, imageHeight, imageRatio;
	var thisLayer = group.getLayer();

    // update anchor positions
    switch (activeAnchor.name) {
		case "topLeft" :
			selectedGroup = group;
			group.rotating = true;
			break;
		case "bottomRight":
			imageWidth = bottomRight.x-topLeft.x;
			imageHeight = bottomRight.y-topLeft.y;
//			bottomRight.y = activeAnchor.y + imageHeight;
			topRight.x = activeAnchor.x;
			image.setPosition(topLeft.x, topLeft.y);
		    image.setScale(imageWidth/startWidth, imageHeight/startHeight);
			center.x = imageWidth/2;
			center.y = imageHeight/2;
			group.setCenterOffset(center.x,center.y);
			break;
		case "expand":
			imageWidth=image.width;
			imageHeight=image.height;
			topRight.x=imageWidth;
			topRight.y=0;
			bottomRight.x=imageWidth;
			bottomRight.y=imageHeight;
			group.setPosition(stage.width/2, stage.height/2);
			group.setCenterOffset(stage.width/2, stage.height/2);
			break;
    }
}

function addTextAnchor(group,x,y,name){
	var thisLayer = group.getLayer();
	var textShape = group.getChild("textShape");
	
	switch(name){
		case "topLeft":
			var anchor = new Kinetic.Circle({
		        x: x,
		        y: y,
		        stroke: "red",
		        fill: "salmon",
		        strokeWidth: 1,
		        radius: 7,
		        name: name,
		        draggable: true
		    });	
		
			anchor.on("click", function(){
				thisLayer.remove(group);
				thisLayer.draw();
		    }, false);
			
			break;
		case "bottomRight":
			var anchor = new Kinetic.Circle({
		        x: x,
		        y: y,
		        stroke: "#777777",
		        fill: "#E6E6E6",
		        strokeWidth: 1,
		        radius: 7,
		        name: name,
		        draggable: true
		    });
		
			anchor.on("dragmove", function(){
		        textUpdate(group, "resize", this);
				var groupLoc = this.getParent().getPosition();
				var anchorTop = groupLoc.y + textShape.textHeight;
				var anchorLeft = groupLoc.x + textShape.widestWord;
				//getTextWidth is the built in call to get the line at normal width
				var anchorRight = groupLoc.x + (textShape.getTextWidth() * 1.1);
				//getTextHeight is also built in & only measures a single line
				var anchorBottom = anchorTop + textShape.getTextHeight();
				this.setDragBounds({
					top: anchorTop, 
					left: anchorLeft + 10,
					right: anchorRight,
					bottom: anchorBottom
				});
		    });

		    anchor.on("mousedown", function(){
		        group.draggable(false);
		        this.moveToTop();
		    });
		    anchor.on("dragend", function(){
		        group.draggable(true);
		    });		
			break;
	}

	// add hover styling
    anchor.on("mouseover", function(){
        var layer = this.getLayer();
        document.body.style.cursor = "pointer";
        this.setStrokeWidth(3);
        layer.draw();
    });

    anchor.on("mouseout", function(){
        var layer = this.getLayer();
        document.body.style.cursor = "default";
        this.setStrokeWidth(1);
        layer.draw();
    });

	group.add(anchor);
}

function addAnchor(group, x, y, name){
	var thisLayer = group.getLayer();
	
    //set anchor styles
	switch (name){
		case "center":
		    var anchor = new Kinetic.Circle({
		        x: x,
		        y: y,
		        stroke: "#666",
		        fill: "#ddd",
		        strokeWidth: 1,
		        radius: 7,
		        name: name,
		        draggable: false,
				visible:false
		    });
			break;
		case "topLeft":
		    var anchor = new Kinetic.Circle({
		        x: x,
		        y: y,
		        stroke: "#0055CC",
		        fill: "#3387D5",
		        strokeWidth: 1,
		        radius: 7,
		        name: name,
		        draggable: false
		    });
			break;
		case "topRight":
		    var anchor = new Kinetic.Circle({
		        x: x,
		        y: y,
		        stroke: "red",
		        fill: "salmon",
		        strokeWidth: 1,
		        radius: 7,
		        name: name,
		        draggable: false
		    });
			break;
		case "bottomRight":
			var anchor = new Kinetic.Circle({
		        x: x,
		        y: y,
		        stroke: "#777777",
		        fill: "#E6E6E6",
		        strokeWidth: 1,
		        radius: 7,
		        name: name,
		        draggable: true
		    });
			break;
	}
    //set anchor actions
	switch (name){
		case "topLeft" :
		    anchor.on("mousedown", function(){
		        this.moveToTop();
				update(group, this);
		        group.draggable(false);

		    });
			break;
		case "bottomRight" :
			anchor.on("dragmove", function(){
				update(group, this);
			});
			anchor.on("mousedown", function(){
		        group.draggable(false);
				this.moveToTop();
		    });
			anchor.on("dragend", function(){
				group.draggable(true);
			})
			break;

		case "topRight":
			anchor.on("click", function(){
				thisLayer.remove(group);
				thisLayer.draw();
		    }, false);
			break;
	}

    // add hover styling
    anchor.on("mouseover", function(){
        var layer = this.getLayer();
        document.body.style.cursor = "pointer";
        this.setStrokeWidth(2);
        layer.draw();
    });

    anchor.on("mouseout", function(){
        var layer = this.getLayer();
        document.body.style.cursor = "default";
        this.setStrokeWidth(1);
		group.draggable(true);
        layer.draw();
    });
    
    group.add(anchor);
}

function formatText(){
	var fontFamily = $("#fontFamily").val();
	var fontSize = $("#fontSize").val();
	var textValue = $("#textInput").val();
	
	if (selectedGroup.children[0].name = "textShape"){
		var textShape = selectedGroup.children[0]		
		textShape.setFontFamily(fontFamily);
		textShape.setFontSize(fontSize);
		textShape.setText(textValue);
		stage.draw();
	}
	
}

function loadText(){
	var textValue = $("#textInput").val();
	var _fontSize = parseInt($("#fontSize").val());
	var _fontFamily = $("#fontFamily").val();
	
	var yPosition = $(window).scrollTop();
	console.log(yPosition);
	
	var textShape = new Kinetic.Text({
		text: textValue,
		fontSize: _fontSize,
		fontFamily: _fontFamily,
		textFill: "black",
		textStroke: undefined,
		textStrokeWidth: undefined,
		align: "left",
		verticalAlign: "top",
		padding: 0,
		x: 0,
		y: 0,
		fill: undefined,
		stroke: undefined,
		strokeWidth: undefined,
		visible: true,
		listen: true,
		name: "textShape",
		alpha: 1,
		scale: (1,1),
		rotation: 0,
		rotationDeg: 0,
		centerOffset: (0,0),
		draggable:true,
	});
	
	var textGroup = new Kinetic.Group({
		x: 0,
        y: yPosition+20,
        draggable: true,
	});
	
	layer.add(textGroup);
	stage.add(layer);
	textGroup.add(textShape);
	stage.draw();

	textGroup.on("mousedown", function(){
		this.moveToTop();
		selectGroup(this);	
    });

	textGroup.on("dragstart", function(){
		this.moveToTop();
		selectGroup(this);	
    });
	

	addTextAnchor(textGroup, 0, 0, "topLeft");
	addTextAnchor(textGroup,textShape.width,textShape.fontSize, "bottomRight");

	selectGroup(textGroup,"first load");
	
	formatText();
	
	stage.draw();
	
	//limit width to stage width
	var textStartWidth = textGroup.getChild('bottomRight').x-textGroup.getChild('topLeft').x;
	console.log(textShape.textHeight, textShape.possibleHeight);
	if(textStartWidth>stage.width){
		textUpdate(textGroup,'tooWideResize');
		textGroup.getChild('bottomRight').x = stage.width-10;
		layer.draw();
		console.log(textShape.textHeight, textShape.possibleHeight);
		textGroup.getChild('bottomRight').y = textShape.textHeight;
		textUpdate(textGroup,'tooWideResize');
		stage.draw();
	}

}

function line(type){
	
	switch (type){
		case "horizontal" :
			var newLineGroup = new Kinetic.Group({
		        x: 0,
		        y: 200,
				draggable: true,
		        dragConstraint: "vertical"
		    });
			var line = new Kinetic.Rect({
				width:stage.width,
				height: 3,
				fill: "black",
				name: "line",
				type: "horizontal"
			});
			var dragTangle = new Kinetic.Rect({
				y:-8,
				visible:true,
				width:stage.width,
				height: 22,
				type: "horizontal"
			});
			break;
		case "vertical" :
			var newLineGroup = new Kinetic.Group({
		        x: stage.width/2,
				y: 0,
				draggable: true,
		        dragConstraint: "horizontal"
		    });
			var line = new Kinetic.Rect({
				width:3,
				height: stage.height,
				fill: "black",
				name: "line",
				type: "vertical"
			});
			var dragTangle = new Kinetic.Rect({
				x:-8,
				width:22,
				visible:true,
				height: stage.height,
				type: "vertical"
			});
			break;
	}
	
	newLineGroup.on("mousedown dragstart", function(){
		this.moveToTop();
		selectGroup(this);
	});

	newLineGroup.add(line);
	newLineGroup.add(dragTangle);


	layer.add(newLineGroup);
	stage.add(layer);

	
	var groupWidth = newLineGroup.getChild("line").width;
	switch (type){
		case "horizontal" :
			addAnchor(newLineGroup, groupWidth-10, 0, "topRight");
			break;
		case "vertical" :
			addAnchor(newLineGroup, groupWidth, 10, "topRight");
			verticalLines.push(newLineGroup);
			break;
	}
	
	selectGroup(newLineGroup);
	
	stage.draw();
}

function selectGroup(group,loadType){
	unselect();
	selectedGroup = group;
	
	var type = selectedGroup ? selectedGroup.children[0].name : null;
	switch (type){
		case "image":
			$('#textInput').val('');
			var topLeft = selectedGroup.getChild("topLeft");
		    var bottomRight = selectedGroup.getChild("bottomRight");
			var topRight = selectedGroup.getChild("topRight");
			topLeft.show();
			bottomRight.show();
			topRight.show();
			break;
		case "textShape":
			var topLeft = selectedGroup.getChild("topLeft");
		    var bottomRight = selectedGroup.getChild("bottomRight");
			topLeft.show();
			bottomRight.show();
			// as long as this isn't the first load, set the dropdowns
			var text = selectedGroup.children[0].text;
			var fontFamily = selectedGroup.children[0].fontFamily;
			var fontSize = selectedGroup.children[0].fontSize;
			$("#textInput").val(text);
			$('#fontFamily').val(fontFamily);
			$('#fontSize').val(fontSize);
			break;
		case "line":
			$('#textInput').val('');
			var topRight = selectedGroup.getChild("topRight");
			topRight.show();
			break;
	}
	
	layer.draw();
}

function unselect(){
	
	if (selectedGroup){
		var type = selectedGroup.children[0].name;
		switch (type){
			case "image":
				var topLeft = selectedGroup.getChild("topLeft");
			    var bottomRight = selectedGroup.getChild("bottomRight");
				var topRight = selectedGroup.getChild("topRight");
				topLeft.hide();
				bottomRight.hide();
				topRight.hide();
				break;
			case "textShape":
				var topLeft = selectedGroup.getChild("topLeft");
			    var bottomRight = selectedGroup.getChild("bottomRight");
				topLeft.hide();
				bottomRight.hide();
				$("#textTools").css({'background-color':'white'});
				break;
			case "line":
				var topRight = selectedGroup.getChild("topRight");
				topRight.hide();
				break;
		}

		layer.draw();
	}
	
}

function loadMeme(docImage, expand){
    var image = docImage;
	var imageRatio = image.height/image.width;
	var newImageWidth = image.width;
	var newImageHeight = image.height;
	
	var yPosition = $(window).scrollTop();

	var newImageGroup = new Kinetic.Group({
        x: stage.width/2,
        y: yPosition + newImageHeight/2 + 20,
        draggable: true,
		centerOffset: {
			x: newImageWidth/2,
			y: newImageHeight/2
		}
    });

	var newImage = new Kinetic.Image({
        x: 0,
	    y: 0,
        image: image,
        width: newImageWidth,
        height: newImageHeight,
        name: "image"
    });

	newImage.on("dblclick dbltap", function(){
		thisGroup = this.getParent();

		this.width = stage.width;
		this.height = stage.height;
		var expand = {name:"expand"}
		update(thisGroup,expand);
		
		layer.draw();
    });

	layer.add(newImageGroup);
	stage.add(layer);

    newImageGroup.add(newImage);
    addAnchor(newImageGroup, 0, 0, "topLeft");
	addAnchor(newImageGroup, newImageWidth, 0, "topRight");
    addAnchor(newImageGroup, newImageWidth, newImageHeight, "bottomRight");
	addAnchor(newImageGroup, newImageWidth/2, newImageHeight/2, "center");

	newImageGroup.on("mousedown", function(){
		this.moveToTop();
		selectGroup(this);
    });
	

    newImageGroup.on("dragstart", function(){
		this.moveToTop();
		selectGroup(this);
    });

	selectGroup(newImageGroup);

    stage.draw();
}

function initDrawStage(){


			//set first brushContainer's border as initially selected
			//choose size
			$(".brushContainer:first").css("border", "1px solid black");

			drawStage = new Kinetic.Stage({
				container: "drawContainer", 
				width: 300, 
				height: 300
			});

			drawStage.onContent("mousedown", function(){
		        document.body.style.cursor = "pointer";
				var userPos = drawStage.getUserPosition();
				//firefox requires a separate X, Y variable (no object)
				var userPosX = userPos.x;
				var userPosY = userPos.y;
				drawContext.beginPath();
				drawContext.moveTo(userPosX,userPosY);
				mouseDown = true;
			});

			drawStage.onContent("mousemove", function(){
				var userPos = drawStage.getUserPosition();
				if (mouseDown){
					if (drawTool=="eraser"){
						var startGlobComp = drawContext.globalCompositeOperation;
						drawContext.globalCompositeOperation = "destination-out";
						//drawContext.strokeStyle = "white";
						drawContext.lineJoin = "round";
						drawContext.lineWidth = drawRadius;
						drawContext.lineTo(userPos.x, userPos.y);
						drawContext.stroke();
						drawContext.globalCompositeOperation = startGlobComp;
					} else {
						drawContext.strokeStyle = drawColor || "#000000";
						drawContext.lineJoin = "round";
						drawContext.lineWidth = drawRadius;
						drawContext.lineTo(userPos.x, userPos.y);
						drawContext.stroke();
					}
				}
			});

			drawStage.onContent("mouseup", function(){
				document.body.style.cursor = "default";
				mouseDown = false;
			});

			drawLayer = new Kinetic.Layer();

			drawStage.add(drawLayer);
			
			$("#drawContainer canvas").each(function(){
				$(this).addClass("drawCanvas");
			});

			var drawCanvasElements = $(".drawCanvas");
			drawCanvas = drawCanvasElements[2];
			drawCanvas.addEventListener('mousedown', handleMouseDown, false);

			drawContext = drawCanvas.getContext('2d');
	
}

function initStage(){
	
    stage = new Kinetic.Stage({
		container: "container", 
		width: 550, 
		height: 400
	});	
	
	stage.onContent("mouseup", function(){ 
		if (selectedGroup != undefined){
			selectedGroup.rotating = false;			
		}
	}, false); 

	stage.onContent("mouseout", function(){ 
		if (selectedGroup != undefined){
			selectedGroup.rotating = false;			
		}
	}, false);

	stage.onContent("mousemove", function(){
		if (selectedGroup === undefined){
			return null;
		} else {
			//group rotation
			if (selectedGroup.rotating && selectedGroup.rotating == true){
				var center = selectedGroup.getChild("center").getAbsolutePosition();
				var centerInternal = selectedGroup.getChild("center").getPosition();
				var topLeft = selectedGroup.getChild("topLeft");
				var mousePos = stage.getUserPosition();
				var groupPos = selectedGroup.getAbsolutePosition();
				var groupOffset = selectedGroup.getCenterOffset();

				var cornerOpposite = centerInternal.x - topLeft.x;
				var cornerAdjacent = centerInternal.y - topLeft.y;
				var cornerAtan = Math.atan(cornerOpposite/cornerAdjacent);
			
				var adjacent = center.x - mousePos.x;
				var opposite = center.y - mousePos.y;
				//figure out the angle (in radians) 
				var atan = Math.atan(opposite/adjacent);

				//rotation = Quarter of a Circle (1/2 Pi) + the angle above
				selectedGroup.rotation = 0.5 * Math.PI + atan + cornerAtan; 
				if (mousePos.x <= center.x) { 
					selectedGroup.rotation += Math.PI;
				}
				layer.draw();	
			}
		}
	}, false);
	
	layer = new Kinetic.Layer();
    stage.add(layer);

	$("#container canvas").each(function(){
		$(this).addClass("mainCanvas");
	});
	
}

function getBase64(imageURL, addBase64){
	
	var startTime;
	
	function serverTimer(){
		serverTimerInterval=setInterval(function(){timeCheck()},1000);
	}
	
	function timeCheck(){
		var d=new Date();
		var t=d.toLocaleTimeString();
		console.log(t);
		if(t>=startTime+3000){
			$('#slowError').show();
		}
		if(t>=startTime+8000){
			xmlhttp.abort();
			$('#ajax-loader').hide();
			clearInterval(serverTimerInterval);
			$('#slowError').hide();
		};
	}
	
	$('#ajax-loader').show();
	if (window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
		var d=new Date();
		startTime=d.toLocaleTimeString();
		serverTimer();
	} else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		var d=new Date();
		startTime=d.toLocaleTimeString();
		serverTimer();
	}
	
	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
		var base64 = xmlhttp.responseText;
		addBase64(base64);
		$('#ajax-loader').hide();		
	  }
	}
	
	xmlhttp.open("POST","base64.php?q="+imageURL,true);
	xmlhttp.send();
}

function initImageSearch(){

	$("#searchInput").focus();
	$("#searchInput").keyup(function(event){
		//wait for Enter
		var text = $("#searchInput").val();
				
		if(event.which==13 && text !== ''){

			$("#result").html("");
			$("#memes img").each(function(){
				$(this).hide();
				if( $(this).hasClass(text) ){
					$(this).show();
					$('#clearSearch').show();
				}
			});
			
			function getUrlImage(text){

				$('#clearSearch').show();

				$("#result").html('');
				var url=text;
				$("#result").prepend($('<img/>')
					.attr({ src : url, height : 73})
					.css({'cursor': 'pointer'})
					.data({'mediaUrl':url})
					.addClass('clickImage')
					.click(function(){
						var imgHeight = this.height;
						var imgWidth = this.width;
						var originalRatio = imgWidth/imgHeight;
						function addBase64(base64){
							//create an image element, onload trigger click so loadMeme can get its elements
							$('<img/>').attr({
									src: "data:image/png;base64,"+base64,
									height: imgHeight,
									width: imgWidth
								})
								.css({'cursor':'pointer'})
								.addClass('clickImage')
								.click(function(){
  										var imageObj = new Image();
  										imageObj.onload = function() {
  											imageObj.height = 150;
  											imageObj.width = originalRatio * imageObj.height;
  											loadMeme(imageObj);
  										}
  										imageObj.src = this.src;
								})
								.load(function(){
									$("#memes").prepend($(this));
									$(this).trigger('click');
								});
						}
						getBase64($(this).data('mediaUrl'), addBase64);
					})
				);
			}
			
			function webSearch(){
				if($("#webSearchCheckbox:checked").val()){
					$('.progress').show();
					$('#clearSearch').show();
					var percent = '0%';
					$('#progressBar').css({'width':percent});
					var search_input = text;
					var keyword= encodeURIComponent(search_input);
					var bing_url='http://api.bing.net/json.aspx?JsonType=callback&JsonCallback=?&Appid=7D13B720B11BB8FA40D2E0B73D1CA5E4474A7F7C&query='+keyword+'&sources=image&adult=strict&Image.Filters=Size:Medium'; 
					$.ajax({
						type: "GET",
						url: bing_url,
						dataType:"jsonp",
						success: function(response){
							$("#result").html('');
							var count = 1;
							var total = response.SearchResponse.Image.Results.length;
							if(response.SearchResponse.Image.Results.length){ 
								$.each(response.SearchResponse.Image.Results, function(i,data){
									var mediaUrl = data.MediaUrl;
									var url=data.Thumbnail.Url;
									$("#result").prepend($('<img/>')
										.attr({ src : url, height : 73})
										.css({'cursor': 'pointer'})
										.data({'mediaUrl':mediaUrl})
										.addClass('clickImage')
										.click(function(){
											var imgHeight = this.height;
											var imgWidth = this.width;
											var originalRatio = imgWidth/imgHeight;
											function addBase64(base64){
												//create an image element, onload trigger click so loadMeme can get its elements
												$('<img/>').attr({
														src: "data:image/png;base64,"+base64,
														height: imgHeight,
														width: imgWidth
													})
													.css({'cursor':'pointer'})
													.addClass('clickImage')
													.click(function(){
				   										var imageObj = new Image();
				   										imageObj.onload = function() {
				   											imageObj.height = 150;
				   											imageObj.width = originalRatio * imageObj.height;
				   											loadMeme(imageObj);
				   										}
				   										imageObj.src = this.src;
													})
													.load(function(){
														$("#memes").prepend($(this));
														$(this).trigger('click');
													});
											}
											getBase64($(this).data('mediaUrl'), addBase64);
										})	
									);
									percent = 100*(count/total) + "%";
									$('#progressBar').css({'width':percent});
									count++;
									if(percent="100%"){
										$('.progress').hide();
										$('#progressBar').css({'width':'0%'});
									}

								});
							} else {
								$("#result").html("");
							};
						}
					});		
				}
				
			}


			$('<img />').attr('src',text)
				.load(function () { 
					console.log('imageURL');
					getUrlImage(text);
				})
				.error(function () {
					console.log('not imageURL');
					webSearch();
			});

		} else if(event.which==13 && text == ''){
			$("#result").html("");
			$("#memes img").each(function(){
				$(this).show();
			});
			$('#clearSearch').hide();
		};
	});
}

function addMeme(newMeme){
	var newImage = Canvas2Image.saveAsPNG(newMeme, true);
	$("#memes").prepend(newImage);
	newImageClickListener(newImage);
}

function changeHeight(action){
	var mainCanvas = $(".mainCanvas");
	var currentHeight = mainCanvas[2].height;
	var newHeight;
	switch(action){
		case "bigger":
			newHeight = currentHeight + 200;
			break;
		case "smaller":
			newHeight = currentHeight - 200;
			break;
	}
	
	mainCanvas[0].height = newHeight;
	mainCanvas[1].height = newHeight;
	mainCanvas[2].height = newHeight;

	stage.height = newHeight;
	bg.height = newHeight;
	
	for (var i = 0; i<verticalLines.length; i++){
		verticalLines[i].getChild("line").height = newHeight;
	}
	
	stage.draw();
}

function newImageClickListener(image){
	$(image)
		.attr({height:100})
		.addClass('clickImage')
		.click(function(){
			loadMeme(this);
		}
	);
}

function initClickListeners(){
	
	$("input").focus(function(){
		unselect();
	});
	
	$("#saveCanvas").click(function(){
		
//		var saveCanvas = document.getElementsByClassName('mainCanvas')[2];
//        saveCanvas.toBlob(function(blob) {
//            saveAs(blob, "exported_image.png");
//        }, "image/png");

		unselect();

		function saveCanvas(){

//detect browser
//			var userAgent = navigator.userAgent.toString().toLowerCase();
//			console.log(userAgent);
//			if ((userAgent.indexOf('safari') != -1) && !(userAgent.indexOf('chrome') != -1)) {
//				//action
//			}

			
			try {
				var saveCanvas = document.getElementsByClassName('mainCanvas')[2];
				saveCanvas.toBlob(function(blob) {
					saveAs(blob, "9bro_image.png");
				}, "image/png");				
			} catch (err) {
				//if the code above doesn't work, their prob using Safari so open the Save Dialog modal
				console.log(err);
				if ($('#saveCanvas').attr('data-toggle') == undefined){
					$('#saveCanvas').attr({'data-toggle':'modal', href:"#saveDialog"}).trigger('click');					
				}
				var saveCanvas = $("#container canvas");
				var saveImage = Canvas2Image.saveAsPNG(saveCanvas[2], true);
				$("#saveImage").html('');
				$("#saveImage").html(saveImage);
			}
			
			
			
			
			layer.remove(layer.getChild('logo'));
			stage.draw();
		}
		
		var imageObj = new Image();
		imageObj.onload = function() {
		    var logo = new Kinetic.Image({
		        x: 2,
		        y: stage.height-27,
		        image: imageObj,
				name: "logo"
		    });

		    // add the shape to the layer
		    layer.add(logo);

		    // add the layer to the stage
		    stage.add(layer);
			stage.draw();
			saveCanvas();
		};
		imageObj.src = "canvasLogoLong.png";		
	});
	
	$("#clearCanvas").click(function(){
		var numChildren = layer.getChildren().length-1;
		for (var i=1; i<=numChildren; i++){
			layer.remove(layer.getChildren()[1]);			
			stage.draw();
		}
		unselect();
		$("#textInput").val('').blur();
		
//		location.reload();
	});


	$('#clearSearch').click(function(){
		$('#result').html('');
		$("#memes img").each(function(){
			$(this).show();
		});
		$("#searchInput").val('');
		$('#clearSearch').hide();		
	});
	//choose color
	$("#colorGroup > div").each(function(){
		$(this).click(function(){
			drawColor = $(this).css("background-color");
			$(".selectedCell").css("background-color", drawColor);
		});
	});

	//choose size
	$(".brushContainer").each(function(){
		$(this).click(function(){
			//clear all borders & set hover
			$(".brushContainer").css("border", "1px solid white");
			//select this border
			var width = $(this).find("div").css("width");
			var pLocation = width.indexOf("p");
			drawRadius = width.slice(0,pLocation)-4;
			$(this).css("border", "1px solid black");
			$(this).css("border", "1px solid black");
		});
	});

	//clear drawing
	$("#clearDrawing").click(function(){
		drawStage.clear();
	});

	//save custom to memes
	$("#saveDrawing").click(function(){
		var drawCanvasElements = $(".drawCanvas");
		var newMeme = drawCanvasElements[2];
		addMeme(newMeme);
		$("#custom").hide()
		drawStage.clear();
	});
	
	$("#cancelDrawing").click(function(){
		$("#custom").hide();
		drawStage.clear();
	});
	
	$("#newDrawing").click(function(){
		$("#custom").show();
	});
	
	//
	$("#fontFamily").change(function(){
		if(selectedGroup.children[0].name == "textShape"){
			formatText();
		}
	});
	
	$("#fontSize").change(function(){
		if(selectedGroup.children[0].name == "textShape"){
			formatText();
		}
	});
	
	$("#textInput").keyup(function(event){
		if(selectedGroup && selectedGroup.children[0].name == "textShape"){
			formatText();
		} else if (event.which==13){
			loadText();
			$(this).blur();
		}
	});
	
	$("#textButton").click(function(){
		loadText();
		$(this).blur();
	});
	
	$("#hLine").click(function(){
		line("horizontal");
	});
	
	$("#vLine").click(function(){
		line("vertical");
	});
	
	$("#bigger").click(function(){
		changeHeight("bigger");
	});
	
	$("#smaller").click(function(){
		changeHeight("smaller");
	});
	
	$(document).keydown(function(e){ 
		var elid = $(document.activeElement).hasClass('textClass'); 
		if(e.keyCode === 8 && !elid && selectedGroup){ 
			e.preventDefault();
			var thisLayer = selectedGroup.getLayer();
			thisLayer.remove(selectedGroup);
			unselect();
			$("#textInput").val('').blur;
			selectedGroup = undefined;
			thisLayer.draw();
		} 
	});
	

}

$(document).ready(function(){

	var windowHeight = $(window).height();
	var windowWidth = $(window).width();
	var rightContainerHeight = windowHeight - 65;
	
	var canvasPosition = $("#canvasContainer").offset();
	var canvasWidth = $("#canvasContainer").width()
	var memePositionX = canvasPosition.left + canvasWidth + 40;
	
//	$("#canvasContainer").height(canvasContainerHeight)
//		.css({
//			overflow:'scroll'
//		});
		
	$("#right").height(rightContainerHeight).width((windowWidth/2)-80)
		.css({
			position:'fixed',
			top: 62,
			left: memePositionX,
			overflow:'scroll'
		});

	var sources = [
		"Angry.png", 
		"AreYouKiddingMe.png", 
		"AwwYeah.png", 
		"Baww.png", 
		"BeerGuy.png", 
		"BitchPlease.png",
		"Blond.png", 
		"CerealGuy.png", 
		"CerealSpitting.png", 
		"ChallengeAccepted.png",
		"ChallengeCompleted.png", 
		"ChallengeConsidered.png", 
		"CleanFuckYea.png", 
		"CloseEnough.png",
		"Concentrated2.png", 
		"Derrrp.png", 
		"DeskFlip.png", 
		"Determined.png", 
		"DudeComeOn.png", 
		"EWBTE.png",
		"FFFUUU.png", 
		"FYeaStar.png", 
		"Facepalm.png", 
		"FairEnough.png", 
		"FapFap.png", 
		"FemaleHappy.png",
		"FemaleMilk.png", 
		"FemaleRage.png", 
		"FemaleRetarded.png", 
		"ForeverAlone.png",
		"ForeverAloneExcited.png", 
		"ForeverDontCare.png", 
		"Freddie.png", 
		"FuckYea.png", 
		"FuckYeaFemale.png",
		"FullPanel.png", 
		"GTFO.png", 
		"Gasp.png", 
		"Genius.png", 
		"Grandma.png", 
		"GrannyTroll.png", 
		"Happy.png",
		"HatAndMonocle.png", 
		"HatersGonnaHate.png", 
		"HeckNo.png", 
		"Hehehe.png", 
		"Hitler.png", 
		"Horror.png",
		"IamDisappointed.png", 
		"JackieChan.png", 
		"LOL.png", 
		"LadyFreddie.png", 
		"Later.png",
		"Manymonths.png.jpg", 
		"MeGusta.png", 
		"MeGustaCreepy.png", 
		"Meanwhile.png", 
		"Milk.png",
		"MotherofGod.png", 
		"Muchlater.png.jpg", 
		"NeverAlone.png", 
		"NewspaperGuy.png",
		"NewspaperGuyTear.png", 
		"NotBad.png", 
		"NotSureIfGusta.png", 
		"NothingToDoHere.png", 
		"OMGRun.png",
		"OMGRunBlonde.png", 
		"OhGodWhy.png", 
		"OriginalRage.png", 
		"OriginalTroll.png", 
		"Pfftch.png",
		"PhoenixWright.png", 
		"PukeRainbows.png", 
		"Rage1.png", 
		"Rage2.png", 
		"RedEyes.png",
		"ScumbagSteveHat.png", 
		"Shocked.png", 
		"SlightlyFabricated.png", 
		"Smile.png", 
		"Smile2.png",
		"SoClose.png", 
		"SoMuchWin.png", 
		"SonMeGusta.png", 
		"SoonComputer.png", 
		"SpiderpMan.png", 
		"Stoned.png",
		"StopItSeriously.png", 
		"StopItYou.png", 
		"StraightFace.png", 
		"Surprised.png", 
		"Sweaty.png",
		"Sweet.png", 
		"TheSaddest.png", 
		"Thenextday3.png.jpg", 
		"Thoughtful.png", 
		"Three_days_later.png",
		"Threeweekslater.png", 
		"Troll.png", 
		"TrollDad.png", 
		"TrollDadFull.png", 
		"TrollDadJump.png",
		"TrueStory.png", 
		"Twelve_seconds_later.png.jpg", 
		"Two_hours_later.png", 
		"WaitAMinute.png",
		"WeGotABadassOverHere.png", 
		"WellDone.png", 
		"WhatsAllThisRacket.png", 
		"WhyWithHands.png",
		"YUNO.png", 
		"YouDontSay.png", 
		"sir.png"
	];

	$('#searchInput').typeahead({source: sources, items:5});

	for (var i=0; i<=sources.length-1; i++){
		$("#memes").append($('<img/>').attr({ 
				src : 'memes/common_75px/'+sources[i],
				height : 73
			})
			.addClass("clickImage")
			.addClass(sources[i])
			.css({'cursor': 'pointer'})
			.click(function(){
				var source = this.src;
				var file = source.split("/");
				var imageObj = new Image();
				imageObj.onload = function() {
					imageObj.height = imageObj.height/2;
					imageObj.width = imageObj.width/2;
					loadMeme(imageObj);
				}
				imageObj.src = 'memes/common/'+file[5];
//				$('#memesUsed').show();
//				$(this).clone().prependTo('#memesUsed');
			})	
		);
	}
		
	initStage();
	initDrawStage();
	initImageSearch();
	
	//add white background for addMeme
	bg = new Kinetic.Rect({
		width: stage.width,
		height: stage.height,
		fill: "white",
		draggable: false
	});
	
	bg.on("mousedown", function(){
		unselect();
		$("#textInput").val('').blur();
		selectedGroup = undefined;
	});

	layer.add(bg);
	stage.add(layer);
	bg.moveToBottom();

	initClickListeners();
	

	
});
