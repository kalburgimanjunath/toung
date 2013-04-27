<script>
	protectedPage();
</script>

<div class="profilenav">
	<ul class="pnav">
		<li><a href="#editcontent">Edit Content</a></li>
		<li><a href="#edittheme">Edit Theme</a></li>
		<li><a href="#profile">View Profile</a></li>
	</ul>
</div>

<div id="container">
				<div id="profile" class="defaulttheme rounded">
					
					<div class="panes" id="edit">
						<div id="bio">
							<h2 class="rounded">Bio</h2>
							<div class="spinner-m"><span style="padding-left: 36px; font-size: 1.5em;">Loading...</span></div>
						</div>							
						
						<div id="education">
							<h2 class="rounded">Education</h2>
							<div class="spinner-m"><span style="padding-left: 36px; font-size: 1.5em;">Loading...</span></div>
                        			</div>
                        			
						<div id="experience">
							<h2 class="rounded">Experience</h2>
							<div class="spinner-m"><span style="padding-left: 36px; font-size: 1.5em;">Loading...</span></div>
						</div>
						
						<div id="skills">
							<h2 class="rounded">Skills</h2>
							<div class="spinner-m"><span style="padding-left: 36px; font-size: 1.5em;">Loading...</span></div>
						</div>
					
						<div id="reference">
							<h2 class="rounded">Reference</h2>
							<div class="spinner-m"><span style="padding-left: 36px; font-size: 1.5em;">Loading...</span></div>
						</div>

						<div id="socialids">
							<h2 class="rounded">Networks</h2>
							<div class="spinner-m"><span style="padding-left: 36px; font-size: 1.5em;">Loading...</span></div>
						</div>
						
						<div id="contact">
							<h2 class="rounded">Reference</h2>
							<div class="spinner-m"><span style="padding-left: 36px; font-size: 1.5em;">Loading...</span></div>
						</div>
				</div>
			</div>
</div>

<script src="<?php echo base_url();?>js/education.js"></script>
<script src="<?php echo base_url();?>js/experience.js"></script>
<script src="<?php echo base_url();?>js/skills.js"></script>
<script src="<?php echo base_url();?>js/reference.js"></script>
<script src="<?php echo base_url();?>js/contact.js"></script>
<script src="<?php echo base_url();?>js/bio.js"></script>
<script src="<?php echo base_url();?>js/socialids.js"></script>
<script src="<?php echo base_url();?>lib/jquery-fastconfirm/jquery.fastconfirm.js"></script>

<script src="<?php echo base_url();?>lib/allrating/js/jquery.allRating.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/allrating/css/allrating.css" />

<script src="<?php echo base_url();?>lib/markitup/jquery.markitup.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/markitup/skins/simple/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/markitup/sets/html/style.css" />

<script>     
function loadAll() {
	loadAndShowBio($("#bio"));
	loadAndShowEdu($("#education"));
	loadAndShowExp($("#experience"));
	loadAndShowSkills($("#skills"));
        loadAndShowReference($("#reference"));
	loadAndShowSocialIds($("#socialids"));
	loadAndShowContact($("#contact"));
}


$(document).ready(function(){
	        loadAll();
	}
);	


</script>

