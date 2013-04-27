<script src="<?php echo base_url();?>lib/jquery-1.7.2.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>lib/9bro.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>lib/kinetic-v3.9.1.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>lib/base64.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>lib/canvas2image.js" type="text/javascript"></script>
	
	<script src="<?php echo base_url();?>lib/BlobBuilder.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>lib/canvas-toBlob.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>lib/FileSaver.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo base_url();?>/twitter-bootstrap/docs/assets/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url();?>/twitter-bootstrap/docs/assets/css/bootstrap-responsive.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/css/9bro.css" />
<!-- facebook software developer kit -->	
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=187071938081502";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="http://www.9bro.com">
				<img src="9bro.png"/>
			</a>
			<div class="nav-collapse">
				<ul class="nav">
					<button id="clearCanvas" class="btn">Clear</button>
					<a id="saveCanvas" class="btn btn-primary">Save</a>
				</ul>
				<ul class="nav pull-right" style="margin-top:8px">
					<li><button id="newDrawing" class="btn btn-success" style="margin-top:0px;margin-right:9px">Draw</button></li>
					<li><input id="searchInput" type="text" class="search-query span3 pull-right textClass" placeholder="Search or Image link"></li>
					<li><label class="checkbox" style="padding-top:5px;margin-left:15px;margin-bottom:0px" ><input id="webSearchCheckbox" type="checkbox" checked="checked"> Web</label></li>
					<li class="divider-vertical"></li>
					<li><a style="padding-bottom:5px; padding-top:5px" data-toggle="modal" href="#aboutDialog">About</a></li>
				<ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
</div>
<div class="container">
		<div id="aboutDialog" class="modal hide fade in">
			<div class="modal-header">
				<button class="close" data-dismiss="modal">×</button>
				<h3>
					About 9BRO
				</h3>
			</div>
			<div class="modal-body">
				<div class="page-header">
		          <h1>Why? <small>Y U NO read below!??</small></h1>
		        </div>
				<div class="span5">
				  <label>
				    <h3>Fun</h3>
				    <p>Because making memes would be more fun if it were easy.  So, 9BRO makes it easier.</p>
				  </label>
				</div>
				<div class="span5">
				  <label>
				    <h3>Forever Alone No More!</h3>
				    <p>Make sweet comics and surround yourself with the adoration of an adoring 9gag public. Hey, maybe you'll make it to the Hot page.</p>
				  </label>
				</div>
				<div class="span5">
				  <label>
				    <h3>Zombie Apocalypse</h3>
				    <p>Zombies are coming to get us. They're probably runners. 9BRO comics are the only known repellent. Protect yourself, make a comic.</p>
				  </label>
				</div>
				<div class="span5">
				  <label>
				    <h3>Time Travel Paradoxes</h3>
				    <p>We've sent a future version of you back in the past to kill your grandpa and marry an ancestor. 9BRO comics can restore the original timeline.</p>
				  </label>
				</div>
				<div class="span5">
				  <label>
				    <h3>Robot Overlords</h3>
				    <p>The easiest way to defeat a robot is to make it laugh. Good luck.</p>
				  </label>
				</div>
				<div class="span5">
				  <label>
				    <h3>The Moon is Chasing You</h3>
				    <p>Have you ever noticed the moon seems to follow you while staring out your car window at night? Making meme comics can stop that.</p>
				  </label>
				</div>
				<div class="span5">
				  <label>
				    <h3>Vampires in Popular Culture</h3>
				    <p>Vampires own Hollywood. 9BRO meme comics are made of sunlight cured, crucifix-shaped, vampire-killing stakes.</p>
				  </label>
				</div>
				<div class="span5">
				  <label>
				    <h3>Justin Bieber</h3>
				    <p>You're jealous of Justin Bieber's undeserved worship. Make meme comics disparaging him.</p>
				  </label>
				</div>
				<div class="span5">
				  <label>
				    <h3>Video Games</h3>
				    <p>9BRO meme comics have been custom engineered to promote only the video games you love.</p>
				  </label>
				</div>
				<div class="span5">
				  <label>
				    <h3>Ninjas</h3>
				    <p>10 ninjas are reading over your shoulder while you create 9BRO meme comics. Usually there are 17.</p>
				  </label>
				</div>
				<div class="span5">
				  <label>
				    <h3>Chuck Norris</h3>
				    <p>Chuck Norris wrote War and Peace using nothing but 9BRO.com and an actual war.</p>
				  </label>
				</div>
				<div class="span5">
				  <label>
				    <h3>Don't want to live on this planet anymore</h3>
				    <p>9BRO comics are stored on planets that can be only reached via jetpack.</p>
				  </label>
				</div>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a> 
			</div>
		</div>
		
	
	<div id="saveDialog" class="modal hide fade in">
		<div class="modal-header">
			<button class="close" data-dismiss="modal">×</button>
			<h3>
				Right-click Image &gt; Save as
			</h3>
		</div>
		<div class="modal-body">
			<p id="saveImage">
				
			</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a> 
<!-- 		<a href="#" class="btn btn-primary">Save changes</a> -->
		</div>
	</div>

	<!-- left -->
	<div class="row">
		<!-- input controls -->
		<div id="left" class="span6">
			<!-- draw modal -->
			<div id="custom" style="display:none">
				<div id="colorSelectorGroup">
					<div id="colorSelected">
						<div class="selectedCell" style="background-color: #000000" ;=""></div>
					</div>
					<div id="colorGroup">
						<div class="blackCell" style="background-color: #000000" ;=""></div>
						<div class="colorCell" style="background-color: #464646" ;=""></div>
						<div class="colorCell" style="background-color: #787878" ;=""></div>
						<div class="colorCell" style="background-color: #990030" ;=""></div>
						<div class="colorCell" style="background-color: #ed1c24" ;=""></div>
						<div class="colorCell" style="background-color: #ff7e00" ;=""></div>
						<div class="colorCell" style="background-color: #ffc20e" ;=""></div>
						<div class="colorCell" style="background-color: #fff200" ;=""></div>
						<div class="colorCell" style="background-color: #a8e61d" ;=""></div>
						<div class="colorCell" style="background-color: #22b14c" ;=""></div>
						<div class="colorCell" style="background-color: #00b7ef" ;=""></div>
						<div class="colorCell" style="background-color: #4d6df3" ;=""></div>
						<div class="colorCell" style="background-color: #2f3699" ;=""></div>
						<div class="colorCell" style="background-color: #6f3198" ;=""></div>
						<br>
						<div class="whiteCell" style="background-color: #ffffff" ;=""></div>
						<div class="colorCell" style="background-color: #dcdcdc" ;=""></div>
						<div class="colorCell" style="background-color: #b4b4b4" ;=""></div>
						<div class="colorCell" style="background-color: #9c5a3c" ;=""></div>
						<div class="colorCell" style="background-color: #ffa3b1" ;=""></div>
						<div class="colorCell" style="background-color: #e5aa7a" ;=""></div>
						<div class="colorCell" style="background-color: #f5e49c" ;=""></div>
						<div class="colorCell" style="background-color: #fff9bd" ;=""></div>
						<div class="colorCell" style="background-color: #d3f9bc" ;=""></div>
						<div class="colorCell" style="background-color: #9dbb61" ;=""></div>
						<div class="colorCell" style="background-color: #99d9ea" ;=""></div>
						<div class="colorCell" style="background-color: #709ad1" ;=""></div>
						<div class="colorCell" style="background-color: #546d8e" ;=""></div>
						<div class="colorCell" style="background-color: #b5a5d5" ;=""></div>
					</div>
					<div id="brushes">
						<div class="brushContainer" style="border: 1px solid black; ">
							<div id="brush1" class="brush"></div>
						</div>
						<div class="brushContainer">
							<div id="brush2" class="brush"></div>
						</div>
						<div class="brushContainer">
							<div id="brush3" class="brush"></div>
						</div>
						<div class="brushContainer">
							<div id="brush4" class="brush"></div>
						</div>
						<div class="brushContainer">
							<div id="brush5" class="brush"></div>
						</div>
					</div>
					<div id="cancelSave" class="btn-toolbar">
						<a id="clearDrawing" class="btn btn-mini" href="#">Clear</a>
						<a id="saveDrawing" class="btn btn-primary btn-mini" href="#">Save</a>
						<a id="cancelDrawing" class="btn btn-danger btn-mini" href="#">Cancel</a>
					</div>
				</div>
				<div id="drawContainer">
				<div style="width: 300px; height: 300px; position: relative; display: inline-block; " class="kineticjs-content"><canvas style="position: absolute; display: none; " width="300" height="300" class="kineticjs-buffer-layer drawCanvas"></canvas><canvas style="position: absolute; display: none; " width="300" height="300" class="kineticjs-path-layer drawCanvas"></canvas><canvas style="position: absolute; " width="300" height="300" class="drawCanvas"></canvas></div></div>
			</div>
			<!-- Tools: text, lines, change height  -->
			<div id="tools">
				<div class="input-append">
					<input id="textInput" class="span5 textClass" placeholder="Enter text, bro" type="text"><button id="textButton" class="btn" type="button">Add</button>
				</div>
				<div class="row">
					<div class="span3">
						<select id="fontFamily" class="span2">
							<option>Arial</option>
							<option selected="selected">Courier</option>
							<option>Impact</option>
							<option>Times New Roman</option>
						</select>
						<select id="fontSize" class="span1">
							<option>10</option>
							<option selected="selected">15</option>
							<option>20</option>
							<option>25</option>
							<option>30</option>
							<option>35</option>
							<option>40</option>
						</select>
					</div>
					<div class="span3">
					<div class="btn-toolbar pull-right" style="margin-top:0px;margin-bottom:0px">
						<div class="btn-group">
							<button id="hLine" class="btn">Horizontal</button>
							<button id="vLine" class="btn">Vertical</button>
						</div>
						<div class="btn-group">
							<button id="bigger" class="btn"><i class="icon-chevron-down"></i></button>
							<button id="smaller" class="btn"><i class="icon-chevron-up"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- canvas -->
		<div id="canvasContainer" style="margin-top:75px">
			<div id="container" onmousedown="return false;"><div style="width: 550px; height: 400px; position: relative; display: inline-block; " class="kineticjs-content"><canvas style="position: absolute; display: none; " width="550" height="400" class="kineticjs-buffer-layer mainCanvas"></canvas><canvas style="position: absolute; display: none; " width="550" height="400" class="kineticjs-path-layer mainCanvas"></canvas><canvas style="position: absolute; " width="550" height="400" class="mainCanvas"></canvas></div></div>
		</div>
	</div>

	<!-- right -->	
	<div id="right" style="height: 546px; width: 603px; position: fixed; top: 62px; left: 708px; overflow: scroll; ">
		<!-- facebook like -->			
		<div class="fb-like fb_edge_widget_with_comment fb_iframe_widget" data-href="http://www.9bro.com" data-send="false" data-width="450" data-show-faces="false" data-font="lucida grande" fb-xfbml-state="rendered"><span style="height: 24px; width: 450px; "><iframe id="f2ff30e614" name="f30ef4738" scrolling="no" style="border: none; overflow: hidden; height: 24px; width: 450px; " title="Like this content on Facebook." class="fb_ltr" src="http://www.facebook.com/plugins/like.php?api_key=187071938081502&amp;locale=en_US&amp;sdk=joey&amp;channel_url=http%3A%2F%2Fstatic.ak.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D12%23cb%3Df22f3adfe4%26origin%3Dhttp%253A%252F%252F9bro.com%252Ff39aa421b8%26domain%3D9bro.com%26relation%3Dparent.parent&amp;href=http%3A%2F%2Fwww.9bro.com&amp;node_type=link&amp;width=450&amp;font=lucida%20grande&amp;layout=standard&amp;colorscheme=light&amp;show_faces=false&amp;send=false&amp;extended_social_context=false"></iframe></span></div>
		
		<div class="progress" style="display:none">
			<div id="progressBar" class="bar"></div>
		</div>
		<a class="btn btn-info" id="clearSearch" href="#" style="display:none; margin-bottom:5px">Clear Search</a>
		<img id="ajax-loader" src="ajax-loader.gif" style="display:none">
		<div class="alert alert-error" id="slowError" style="display:none">
			<strong>Wow, this is slow!</strong> If it takes too long, it will stop loading.
		</div>
		<div id="memesUsed" style="display:none"></div>
		<div id="result"></div>
		<div id="memes"><img src="memes/common_75px/Angry.png" height="73" class="clickImage Angry.png" style="cursor: pointer; "><img src="memes/common_75px/AreYouKiddingMe.png" height="73" class="clickImage AreYouKiddingMe.png" style="cursor: pointer; "><img src="memes/common_75px/AwwYeah.png" height="73" class="clickImage AwwYeah.png" style="cursor: pointer; "><img src="memes/common_75px/Baww.png" height="73" class="clickImage Baww.png" style="cursor: pointer; "><img src="memes/common_75px/BeerGuy.png" height="73" class="clickImage BeerGuy.png" style="cursor: pointer; "><img src="memes/common_75px/BitchPlease.png" height="73" class="clickImage BitchPlease.png" style="cursor: pointer; "><img src="memes/common_75px/Blond.png" height="73" class="clickImage Blond.png" style="cursor: pointer; "><img src="memes/common_75px/CerealGuy.png" height="73" class="clickImage CerealGuy.png" style="cursor: pointer; "><img src="memes/common_75px/CerealSpitting.png" height="73" class="clickImage CerealSpitting.png" style="cursor: pointer; "><img src="memes/common_75px/ChallengeAccepted.png" height="73" class="clickImage ChallengeAccepted.png" style="cursor: pointer; "><img src="memes/common_75px/ChallengeCompleted.png" height="73" class="clickImage ChallengeCompleted.png" style="cursor: pointer; "><img src="memes/common_75px/ChallengeConsidered.png" height="73" class="clickImage ChallengeConsidered.png" style="cursor: pointer; "><img src="memes/common_75px/CleanFuckYea.png" height="73" class="clickImage CleanFuckYea.png" style="cursor: pointer; "><img src="memes/common_75px/CloseEnough.png" height="73" class="clickImage CloseEnough.png" style="cursor: pointer; "><img src="memes/common_75px/Concentrated2.png" height="73" class="clickImage Concentrated2.png" style="cursor: pointer; "><img src="memes/common_75px/Derrrp.png" height="73" class="clickImage Derrrp.png" style="cursor: pointer; "><img src="memes/common_75px/DeskFlip.png" height="73" class="clickImage DeskFlip.png" style="cursor: pointer; "><img src="memes/common_75px/Determined.png" height="73" class="clickImage Determined.png" style="cursor: pointer; "><img src="memes/common_75px/DudeComeOn.png" height="73" class="clickImage DudeComeOn.png" style="cursor: pointer; "><img src="memes/common_75px/EWBTE.png" height="73" class="clickImage EWBTE.png" style="cursor: pointer; "><img src="memes/common_75px/FFFUUU.png" height="73" class="clickImage FFFUUU.png" style="cursor: pointer; "><img src="memes/common_75px/FYeaStar.png" height="73" class="clickImage FYeaStar.png" style="cursor: pointer; "><img src="memes/common_75px/Facepalm.png" height="73" class="clickImage Facepalm.png" style="cursor: pointer; "><img src="memes/common_75px/FairEnough.png" height="73" class="clickImage FairEnough.png" style="cursor: pointer; "><img src="memes/common_75px/FapFap.png" height="73" class="clickImage FapFap.png" style="cursor: pointer; "><img src="memes/common_75px/FemaleHappy.png" height="73" class="clickImage FemaleHappy.png" style="cursor: pointer; "><img src="memes/common_75px/FemaleMilk.png" height="73" class="clickImage FemaleMilk.png" style="cursor: pointer; "><img src="memes/common_75px/FemaleRage.png" height="73" class="clickImage FemaleRage.png" style="cursor: pointer; "><img src="memes/common_75px/FemaleRetarded.png" height="73" class="clickImage FemaleRetarded.png" style="cursor: pointer; "><img src="memes/common_75px/ForeverAlone.png" height="73" class="clickImage ForeverAlone.png" style="cursor: pointer; "><img src="memes/common_75px/ForeverAloneExcited.png" height="73" class="clickImage ForeverAloneExcited.png" style="cursor: pointer; "><img src="memes/common_75px/ForeverDontCare.png" height="73" class="clickImage ForeverDontCare.png" style="cursor: pointer; "><img src="memes/common_75px/Freddie.png" height="73" class="clickImage Freddie.png" style="cursor: pointer; "><img src="memes/common_75px/FuckYea.png" height="73" class="clickImage FuckYea.png" style="cursor: pointer; "><img src="memes/common_75px/FuckYeaFemale.png" height="73" class="clickImage FuckYeaFemale.png" style="cursor: pointer; "><img src="memes/common_75px/FullPanel.png" height="73" class="clickImage FullPanel.png" style="cursor: pointer; "><img src="memes/common_75px/GTFO.png" height="73" class="clickImage GTFO.png" style="cursor: pointer; "><img src="memes/common_75px/Gasp.png" height="73" class="clickImage Gasp.png" style="cursor: pointer; "><img src="memes/common_75px/Genius.png" height="73" class="clickImage Genius.png" style="cursor: pointer; "><img src="memes/common_75px/Grandma.png" height="73" class="clickImage Grandma.png" style="cursor: pointer; "><img src="memes/common_75px/GrannyTroll.png" height="73" class="clickImage GrannyTroll.png" style="cursor: pointer; "><img src="memes/common_75px/Happy.png" height="73" class="clickImage Happy.png" style="cursor: pointer; "><img src="memes/common_75px/HatAndMonocle.png" height="73" class="clickImage HatAndMonocle.png" style="cursor: pointer; "><img src="memes/common_75px/HatersGonnaHate.png" height="73" class="clickImage HatersGonnaHate.png" style="cursor: pointer; "><img src="memes/common_75px/HeckNo.png" height="73" class="clickImage HeckNo.png" style="cursor: pointer; "><img src="memes/common_75px/Hehehe.png" height="73" class="clickImage Hehehe.png" style="cursor: pointer; "><img src="memes/common_75px/Hitler.png" height="73" class="clickImage Hitler.png" style="cursor: pointer; "><img src="memes/common_75px/Horror.png" height="73" class="clickImage Horror.png" style="cursor: pointer; "><img src="memes/common_75px/IamDisappointed.png" height="73" class="clickImage IamDisappointed.png" style="cursor: pointer; "><img src="memes/common_75px/JackieChan.png" height="73" class="clickImage JackieChan.png" style="cursor: pointer; "><img src="memes/common_75px/LOL.png" height="73" class="clickImage LOL.png" style="cursor: pointer; "><img src="memes/common_75px/LadyFreddie.png" height="73" class="clickImage LadyFreddie.png" style="cursor: pointer; "><img src="memes/common_75px/Later.png" height="73" class="clickImage Later.png" style="cursor: pointer; "><img src="memes/common_75px/Manymonths.png.jpg" height="73" class="clickImage Manymonths.png.jpg" style="cursor: pointer; "><img src="memes/common_75px/MeGusta.png" height="73" class="clickImage MeGusta.png" style="cursor: pointer; "><img src="memes/common_75px/MeGustaCreepy.png" height="73" class="clickImage MeGustaCreepy.png" style="cursor: pointer; "><img src="memes/common_75px/Meanwhile.png" height="73" class="clickImage Meanwhile.png" style="cursor: pointer; "><img src="memes/common_75px/Milk.png" height="73" class="clickImage Milk.png" style="cursor: pointer; "><img src="memes/common_75px/MotherofGod.png" height="73" class="clickImage MotherofGod.png" style="cursor: pointer; "><img src="memes/common_75px/Muchlater.png.jpg" height="73" class="clickImage Muchlater.png.jpg" style="cursor: pointer; "><img src="memes/common_75px/NeverAlone.png" height="73" class="clickImage NeverAlone.png" style="cursor: pointer; "><img src="memes/common_75px/NewspaperGuy.png" height="73" class="clickImage NewspaperGuy.png" style="cursor: pointer; "><img src="memes/common_75px/NewspaperGuyTear.png" height="73" class="clickImage NewspaperGuyTear.png" style="cursor: pointer; "><img src="memes/common_75px/NotBad.png" height="73" class="clickImage NotBad.png" style="cursor: pointer; "><img src="memes/common_75px/NotSureIfGusta.png" height="73" class="clickImage NotSureIfGusta.png" style="cursor: pointer; "><img src="memes/common_75px/NothingToDoHere.png" height="73" class="clickImage NothingToDoHere.png" style="cursor: pointer; "><img src="memes/common_75px/OMGRun.png" height="73" class="clickImage OMGRun.png" style="cursor: pointer; "><img src="memes/common_75px/OMGRunBlonde.png" height="73" class="clickImage OMGRunBlonde.png" style="cursor: pointer; "><img src="memes/common_75px/OhGodWhy.png" height="73" class="clickImage OhGodWhy.png" style="cursor: pointer; "><img src="memes/common_75px/OriginalRage.png" height="73" class="clickImage OriginalRage.png" style="cursor: pointer; "><img src="memes/common_75px/OriginalTroll.png" height="73" class="clickImage OriginalTroll.png" style="cursor: pointer; "><img src="memes/common_75px/Pfftch.png" height="73" class="clickImage Pfftch.png" style="cursor: pointer; "><img src="memes/common_75px/PhoenixWright.png" height="73" class="clickImage PhoenixWright.png" style="cursor: pointer; "><img src="memes/common_75px/PukeRainbows.png" height="73" class="clickImage PukeRainbows.png" style="cursor: pointer; "><img src="memes/common_75px/Rage1.png" height="73" class="clickImage Rage1.png" style="cursor: pointer; "><img src="memes/common_75px/Rage2.png" height="73" class="clickImage Rage2.png" style="cursor: pointer; "><img src="memes/common_75px/RedEyes.png" height="73" class="clickImage RedEyes.png" style="cursor: pointer; "><img src="memes/common_75px/ScumbagSteveHat.png" height="73" class="clickImage ScumbagSteveHat.png" style="cursor: pointer; "><img src="memes/common_75px/Shocked.png" height="73" class="clickImage Shocked.png" style="cursor: pointer; "><img src="memes/common_75px/SlightlyFabricated.png" height="73" class="clickImage SlightlyFabricated.png" style="cursor: pointer; "><img src="memes/common_75px/Smile.png" height="73" class="clickImage Smile.png" style="cursor: pointer; "><img src="memes/common_75px/Smile2.png" height="73" class="clickImage Smile2.png" style="cursor: pointer; "><img src="memes/common_75px/SoClose.png" height="73" class="clickImage SoClose.png" style="cursor: pointer; "><img src="memes/common_75px/SoMuchWin.png" height="73" class="clickImage SoMuchWin.png" style="cursor: pointer; "><img src="memes/common_75px/SonMeGusta.png" height="73" class="clickImage SonMeGusta.png" style="cursor: pointer; "><img src="memes/common_75px/SoonComputer.png" height="73" class="clickImage SoonComputer.png" style="cursor: pointer; "><img src="memes/common_75px/SpiderpMan.png" height="73" class="clickImage SpiderpMan.png" style="cursor: pointer; "><img src="memes/common_75px/Stoned.png" height="73" class="clickImage Stoned.png" style="cursor: pointer; "><img src="memes/common_75px/StopItSeriously.png" height="73" class="clickImage StopItSeriously.png" style="cursor: pointer; "><img src="memes/common_75px/StopItYou.png" height="73" class="clickImage StopItYou.png" style="cursor: pointer; "><img src="memes/common_75px/StraightFace.png" height="73" class="clickImage StraightFace.png" style="cursor: pointer; "><img src="memes/common_75px/Surprised.png" height="73" class="clickImage Surprised.png" style="cursor: pointer; "><img src="memes/common_75px/Sweaty.png" height="73" class="clickImage Sweaty.png" style="cursor: pointer; "><img src="memes/common_75px/Sweet.png" height="73" class="clickImage Sweet.png" style="cursor: pointer; "><img src="memes/common_75px/TheSaddest.png" height="73" class="clickImage TheSaddest.png" style="cursor: pointer; "><img src="memes/common_75px/Thenextday3.png.jpg" height="73" class="clickImage Thenextday3.png.jpg" style="cursor: pointer; "><img src="memes/common_75px/Thoughtful.png" height="73" class="clickImage Thoughtful.png" style="cursor: pointer; "><img src="memes/common_75px/Three_days_later.png" height="73" class="clickImage Three_days_later.png" style="cursor: pointer; "><img src="memes/common_75px/Threeweekslater.png" height="73" class="clickImage Threeweekslater.png" style="cursor: pointer; "><img src="memes/common_75px/Troll.png" height="73" class="clickImage Troll.png" style="cursor: pointer; "><img src="memes/common_75px/TrollDad.png" height="73" class="clickImage TrollDad.png" style="cursor: pointer; "><img src="memes/common_75px/TrollDadFull.png" height="73" class="clickImage TrollDadFull.png" style="cursor: pointer; "><img src="memes/common_75px/TrollDadJump.png" height="73" class="clickImage TrollDadJump.png" style="cursor: pointer; "><img src="memes/common_75px/TrueStory.png" height="73" class="clickImage TrueStory.png" style="cursor: pointer; "><img src="memes/common_75px/Twelve_seconds_later.png.jpg" height="73" class="clickImage Twelve_seconds_later.png.jpg" style="cursor: pointer; "><img src="memes/common_75px/Two_hours_later.png" height="73" class="clickImage Two_hours_later.png" style="cursor: pointer; "><img src="memes/common_75px/WaitAMinute.png" height="73" class="clickImage WaitAMinute.png" style="cursor: pointer; "><img src="memes/common_75px/WeGotABadassOverHere.png" height="73" class="clickImage WeGotABadassOverHere.png" style="cursor: pointer; "><img src="memes/common_75px/WellDone.png" height="73" class="clickImage WellDone.png" style="cursor: pointer; "><img src="memes/common_75px/WhatsAllThisRacket.png" height="73" class="clickImage WhatsAllThisRacket.png" style="cursor: pointer; "><img src="memes/common_75px/WhyWithHands.png" height="73" class="clickImage WhyWithHands.png" style="cursor: pointer; "><img src="memes/common_75px/YUNO.png" height="73" class="clickImage YUNO.png" style="cursor: pointer; "><img src="memes/common_75px/YouDontSay.png" height="73" class="clickImage YouDontSay.png" style="cursor: pointer; "><img src="memes/common_75px/sir.png" height="73" class="clickImage sir.png" style="cursor: pointer; "></div>
	</div>
</div>


<script src="<?php echo base_url();?>twitter-bootstrap/js/bootstrap-transition.js"></script>
<script src="<?php echo base_url();?>twitter-bootstrap/js/bootstrap-button.js"></script>
<script src="<?php echo base_url();?>twitter-bootstrap/js/bootstrap-typeahead.js"></script>
<script src="<?php echo base_url();?>twitter-bootstrap/js/bootstrap-alert.js"></script>
<script src="<?php echo base_url();?>twitter-bootstrap/js/bootstrap-modal.js"></script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-32062107-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</div>