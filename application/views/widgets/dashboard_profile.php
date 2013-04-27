<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
<script>
	protectedPage();	
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<script src="<?php echo base_url();?>twitter-bootstrap/js/bootstrap-modal.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo base_url();?>/twitter-bootstrap/docs/assets/css/bootstrap.css">

	
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/form.css">
<script src="<?php echo base_url();?>/twitter-bootstrap/docs/assets/js/bootstrap-scrollspy.js" type="text/javascript"></script>
</head>
<body>

<div class="container-fluid">
    
		<div class="span12">
		
		<?php 
			$active =1;		
		?>
			<div data-offset="0" data-target="#navbar" data-spy="scroll">
					<ul class="nav nav-pills" id="myTab">
						<li><a href="#about">About</a></li>				
						<li><a href="#experience">Experience</a></li>
						<li><a href="#education">Education</a></li>
						<li><a href="#skills">Skills</a></li>
						<li><a href="#themes">Themes</a></li>
					</ul>
					<script src="<?php echo base_url();?>/twitter-bootstrap/docs/assets/js/bootstrap-scrollspy.js" type="text/javascript"></script>
					<?php 
					
					if(!empty($alert)){?>
					<div class="alert alert-success">
						<?php 
							if($alert === 1){
								$altmessage ="Basic Registration information stored successfully";
							}
							echo $altmessage;
						?>
					</div>
					<?php }?>
					<div class="tab-content" >	
					<!--
						<div class="tab-pane active" id="about">
							<?php $this->load->view('widgets/aboutme_edit',$account); ?>
						</div>
						<div class="tab-pane" id="education">					
							<?php $this->load->view('widgets/education_edit',$account); ?>
						</div>
						<div class="tab-pane" id="experience">
							<?php $this->load->view('widgets/experience_edit',$account); ?>
						</div>				
						<div class="tab-pane" id="skills">
							<?php $this->load->view('widgets/skills_edit',$account); ?>
						</div>
						<div class="tab-pane" id="themes">
							<?php $this->load->view('widgets/themes_edit',$account); ?>
						</div>-->
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
	$('#navbar').scrollspy();
	
	$('#myTab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
    })	
	
	function loadAll() {
		loadAndShowBio($("#bio"));
		loadAndShowEdu($("#education"));
		loadAndShowExp($("#experience"));
		loadAndShowSkills($("#skills"));
			loadAndShowReference($("#reference"));
		loadAndShowSocialIds($("#socialids"));
		loadAndShowContact($("#contact"));		
	}
	$(document).ready(function() {
		loadAll();
	})
</script>
