<script>
	protectedPage();	
</script>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
<script src="<?php echo base_url();?>twitter-bootstrap/js/bootstrap-modal.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/inner.css">


    <div class="modal hide" id="myModalOnload">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3><?php echo $account->username;?>, welcome to Toung...</h3>
		</div>
		
		
		<div class="modal-body">
			<p>Lets get some information to build your resume...</p><br/>
			<p>Would you like to use information on your linkedin or Facebook?</p>
		</div>
		
		
		<div class="modal-footer">
			<a href="<?php echo base_url();?>dashboard/setcommunityFacebook" class="btn btn-primary">Facebook</a>
			<a href="<?php echo base_url();?>dashboard/setcommunityLinkedin" class="btn btn-primary">Linkedin</a>
		</div>
		
    </div>	

	<?php //$this->load->view('widgets/settings'); ?>
	<?php //$this->load->view('widgets/profile',$account); ?>
	<?php $this->load->view('widgets/updates',$account); ?>
	<?php //$this->load->view('widgets/search_user',$account); ?>
	


<script src="<?php echo base_url();?>js/education.js"></script>
<script src="<?php echo base_url();?>js/experience.js"></script>
<script src="<?php echo base_url();?>js/skills.js"></script>
<script src="<?php echo base_url();?>js/reference.js"></script>
<script src="<?php echo base_url();?>js/contact.js"></script>
<script src="<?php echo base_url();?>js/bio.js"></script>
<script src="<?php echo base_url();?>js/socialids.js"></script>
<script src="<?php echo base_url();?>js/dashboard.js"></script>
<script src="<?php echo base_url();?>lib/jquery-fastconfirm/jquery.fastconfirm.js"></script>

<script src="<?php echo base_url();?>lib/allrating/js/jquery.allRating.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/allrating/css/allrating.css" />


<script src="<?php echo base_url();?>lib/markitup/jquery.markitup.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/markitup/skins/simple/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/markitup/sets/html/style.css" />

<script>   
$(document).ready(function() {
	loadAll();
	
	$('#navigation').localScroll({
		target:'#container'
	});
	
	<?php if($community_id<1): ?>
	$('#myModalOnload').modal('show');
	<?php endIf;?>
	$('.dropdown-toggle').dropdown();
	$().dropdown();
	
	
	/*Adjusts menu width dynamically*/
	var width = 50;
	$('#navi li').each(function() {
    	width += $(this).outerWidth( true );
	});
	$('#navi').css('width', width + 0);
	
	
});

</script>

</body>