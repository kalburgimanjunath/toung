<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/tabs.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/form.css">


<script src="<?php echo base_url();?>js/tabs.js"></script>
<script>
$(document).ready(initTabs); 
</script>
<script src="<?php echo base_url();?>/twitter-bootstrap/docs/assets/js/bootstrap-scrollspy.js" type="text/javascript"></script>
<div class="span12">
			
		<div id="settings" class="wrapper clearfix">

		<div id="settingscontent" class="topcontent wrapper">
			This section needs to contain top level content.
			Settings allows you to manage your content and how it should be presented to other users and search pages.
		</div>

		<ul class="tabs">
			<li><a href="#pretab">Preferences</a></li>
			<li><a href="#thetab">Theme</a></li>
		</ul>
		

		<div class="tab_container" class="scrollspy-credential" data-offset="0" data-target="#navbarExample" data-spy="scroll">
			
			<div id="pretab" class="tab_content">
				<div id="prelist">
					<div class="preitem">
						<ul>
							<li class="label">Show My Tweets</li>
							<li class="content">
							<li class="label">Show My Contact Info</li>
							<li class="content">
							<li class="label">Show My Education</li>
							<li class="content">
							<li class="label">Show My Experience</li>
							<li class="content">
							<li class="label">Show My References</li>
						<li class="content">
							<li class="label">Show My Social Links</li>
						<li class="content">
						</ul>
						</div>
				</div>
			</div>
			<div id="thetab" class="tab_content">
				<div id="thelist">
					<div class="theitem"><br/>
						<ul>
							<li class="label">Font</li>
							<li class="content"><select id="font" type="select"><option>Arial</option></select></li>
							<li class="label">Background</li>
							<li class="content"><input id="bgcolor" type="text" maxlength="6" size="6" value="00ff00" /></input></li>
							<li class="label">Header 1 Color</li>
							<li class="content"><input id="h1color" type="text" maxlength="6" size="6" value="00ff00" /></input></li>
							<li class="label">Header 2 Color</li>
							<li class="content"><input id="h2color" type="text" maxlength="6" size="6" value="00ff00" /></input></li>
							<li class="label">Header 3 Color</li>
							<li class="content"><input id="h3color" type="text" maxlength="6" size="6" value="00ff00" /></input></li>
							<li class="label">Header 4 Color</li>
							<li class="content"><input id="h4color" type="text" maxlength="6" size="6" value="00ff00" /></input></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

	</div> 
</div>
<script src="<?php echo base_url();?>js/bio.js"></script>
<script>   

function loadAll() {
	loadAndShowBio($("#bio"));	
}


$(document).ready(function() {
	loadAll();
});
</script>  


<script src="<?php echo base_url();?>lib/markitup/jquery.markitup.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/markitup/skins/simple/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/markitup/sets/html/style.css" />

<link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url();?>lib/colorpicker/css/colorpicker.css" />
<script type="text/javascript" src="<?php echo base_url();?>lib/colorpicker/js/colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>lib/colorpicker/js/jquery-ui-1.8.22.custom.min.js"></script>
<!-- end of settings div -->
