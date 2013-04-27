<?php
	$image_properties = array(		 
		  'alt' => '',
		  'class' => '',
		  'width' => '250',
		  'height' => '250',
		  'title' => 'Theme'
	);
?>

<form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
	<fieldset>
			<ul class="nav nav-tabs" id="myTab">
				<li><a href="#theme1">Theme1</a></li>	
				<li><a href="#theme2">Theme2</a></li>	
				<li><a href="#theme3">Theme3</a></li>
			</ul>
			 
			<div class="tab-content">	
				<div class="tab-pane" id="theme1">
					
					    <div class="btn-group">
							<a class="btn" href="<?php echo base_url();?>profile/preview/1" id="p1" target="_new" rel="popover" href="#" data-original-title="Theme 1" data-content="<img src=<?php echo base_url().'images/extras/theme1.jpg';?> width=200 height=200/>">Preview</a>
							<button class="btn">Use this Theme</button>
						</div>
				</div>	
				<div class="tab-pane" id="theme2">
					
						 <div class="btn-group">
							<a class="btn" href="<?php echo base_url();?>profile/preview/2" id="p2" target="_new" rel="popover" href="#" data-original-title="Theme 2" data-content="<img src=<?php echo base_url().'images/extras/theme2.jpg';?> width=200 height=200/>">Preview</a>
							<button class="btn">Use this Theme</button>
						</div>
				</div>	
				<div class="tab-pane" id="theme3">
					
						 <div class="btn-group">
							<a class="btn" href="<?php echo base_url();?>profile/preview/3" id="p3" target="_new" rel="popover" href="#" data-original-title="Theme 3" data-content="<img src=<?php echo base_url().'images/extras/theme3.jpg';?> width=200 height=200/>">Preview</a>
							<button class="btn">Use this Theme</button>
						</div>
				</div>	
			</div>
		
				
	</fieldset>					
<form>	

<script src="<?php echo base_url();?>/twitter-bootstrap/docs/assets/js/bootstrap-tooltip.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>/twitter-bootstrap/docs/assets/js/bootstrap-popover.js" type="text/javascript"></script>		

<script>
	$('#p1').focusin(		
		$('#p1').popover('show')
	);
	$('#p1').focusin(		
		$('#p1').popover('hide')
	);
	$('#p2').focusin(		
		$('#p2').popover('show')
	);
	$('#p2').focusin(		
		$('#p2').popover('hide')
	);
	$('#p3').focusin(		
		$('#p3').popover('show')
	);
	$('#p3').focusin(		
		$('#p3').popover('hide')
	);
		
	$('#myTab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	})
</script>