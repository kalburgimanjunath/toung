<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/css/theme1.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/css/user_management.css">

<title>CredMine: Sample Profile</title>
	
	
<!--[if IE]>
	<link href="iefix.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<script src="<?php echo base_url();?>lib/jquery-1.5.min.js" type="text/javascript"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<script src="<?php echo base_url();?>themes/scripts/scripts.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>themes/scripts/jquery.scrollTo.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>themes/scripts/user_management.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>themes/lib/theme.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>themes/scripts/jquery.localscroll-1.2.7-min.js" type="text/javascript"></script>
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:700,700italic|Cantarell:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
	<script src="<?php echo base_url();?>lib/jquery.tmpl.js"></script>	
	<script src="<?php echo base_url();?>lib/jgrowl/jquery.jgrowl.js" type="text/javascript"></script>		
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>lib/jquery-fastconfirm/jquery.fastconfirm.css"/>
	<script src="<?php echo base_url();?>js/common.js"></script>
	
</head>
<body>

<!--User Account Management-->
<div id="dash_wrap">
<div id="dash_open" class="dash_rounded_left dash_rounded_right"><img src="<?php echo base_url();?>themes/images/dash_logo.png" style="padding-right:10px;"></img>Dashboard<img style="padding-left:10px; padding-bottom:1px;" src="<?php echo base_url();?>themes/images/dash_arrow_down.png"></img></div>
<div id="dash_slider">
<div id="dash_content" class="dash_rounded_right">
	<ul>
		<li><a><span class="messbutton"></span><span class="dash_list_item">Messages</span></a></li>
		<i class="dash_div"></i>
		<li><a><span class="cusbutton"></span><span class="dash_list_item">Customize</span></a></li>
		<div style="float:right">
		<li>
			<form class="form_search">
				<input class="search_input" type="text" placeholder="Search People">
			</form>
		</li>
		<i class="dash_div"></i>
		<li>
			<a class="dash_drop"></a>
		</li>
		</div>
	</ul>

</div>
</div>
<div id="dash_close" class="dash_rounded"><img src="<?php echo base_url();?>themes/images/dash_logo.png" style="padding-right:10px;"></img>Dashboard<img style="padding-left:10px; padding-bottom:1px;" src="<?php echo base_url();?>themes/images/dash_arrow_up.png"></div>
</div>
<div id="header" class="shadow">
	<div class="headercontent">
		<div id="username" class="name"><?php echo $account->firstname;?></div>
		<div id="headline" class="headline"><?php echo $account->headline;?></div>
		<div class="social"></div>
		<div id="navigation" class="menu">
		<ul  class="nav">
	
					<li><a href="#me">ME</a></li>
					<li><a href="#education">EDUCATION</a></li>
					<li><a href="#experience">EXPERIENCE</a></li>
					<li><a href="#references">REFERENCES</a></li>
	                <li><a href="#contact">CONTACT</a></li>
	         </ul>
		</div>
	</div>
	</div>

<div id="container">
	        
        <!--END HEADER-->
        
<!--ME-->

<div id="me">
<div class="section">

<div class="usropts">
	<ul>
		<li><a class="secview"></a></li>
		<li><a class="secedit"></a></li>
		<li><a class="secup"></a></li>
		<li><a class="secdown"></a></li>
	</ul>
</div>

    <div class="box600">
		    <h1>About Me</h1>
		    <p>
			<?php echo $account->aboutme;?>
			</p>
    </div>
</div>
</div>
<!--END Me-->

<!--EDUCATION-->
<div id="education">
<div class="section">
<div class="box600">
<h1>Education</h1>


<?php 
	
	
	if(!empty($education)){
		//continue;
	}else{
		$education = '';
	}
	if(count($education)>0 && $education <>''){
		
		foreach($education as $strEducation){ 			
	?>

		<ul class="educ">
			<li><h2><?php if(!empty($education->institution)){echo $education->institution;}else{echo '';}?></h2></li>
			<li><h3>2008-2011</h3></li>
			<li><h4><?php if(!empty($strEducation->fieldofstudy)){echo $strEducation->fieldofstudy;}else{echo '';}?></h4></li>
			
		</ul>

	
<?php }
	}else{
		echo "<p>You do not have any information at the moment. </p>"; 
	}
	
?>

</div>
</div>
</div>
<!--End Education-->

<!--EXPERIENCE-->

<div id="experience">
<div class="section">
<div class="box155"></div>
<div class="box590">
<h1>Experience</h1>
<?php 
	if(!empty($experience)){
		//continue;
	}else{
		$experience = '';
	}
	if(count($experience)>0 && $experience <>''){
	foreach($experience as $strExperience){ ?>

	<ul class="exper">
		<li><h2><?php echo $strExperience->position.' - '.$strExperience->company;?></h2></li>
		<li><h3>Santa Cruz, California</h3></li>
		<li><h4>2010-Present</h4></li>
		<li><p><?php echo $strExperience->description;?></p>
		</li>
	</ul>

<?php }
	}else{
		echo "<p>You do not have any information at the moment. </p>"; 
	}
	
?><div class="box155"></div>
</div>
</div>
<!--End Experience-->

<!--REFERENCES-->
<div id="references">
<div class="section">
<div class="box280">
<h1>References</h1>
<ul class="ref">
<li><h3>CEO, Wise Solutions</h3></li>
<li><h4>Jeremiah Ridenour</h4></li>
<li>(831) 750-0738</li>
</ul>

<ul class="ref">
<li><h3>VP of Products, Ketera</h3></li>
<li><h4>Mike Gardner</h4></li>
<li>(408) 572-9585</li>
</ul>

<ul class="ref">
<li><h3>Director of Product Management, Ketera</h3></li>
<li><h4>Brian Grove</h4></li>
<li>(408) 572-9583</li>
</ul>

<ul class="ref">
<li><h3>VP of Engineering, Jack Be</h3></li>
<li><h4>Deepak Alur</h4></li>
<li>(510) 589-5608</li>
</ul>

<ul class="ref">
<li><h3>CEO and Co-Founder, Jack Be</h3></li>
<li><h4>Luis Derechin</h4></li>
<li>(703) 943-9449</li>
</ul>

<ul class="ref">
<li><h3>Jack Be Director of Development</h3></li>
<li><h4>Girish Ippadi</h4></li>
<li>(408) 215-8958</li></ul>

</div>
<div class="box590">
<h1>Testimonials</h1>
<p class="ref">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam laoreet mi dolor, quis tempus lorem. Quisque vehicula ligula at enim convallis tempus. In convallis, magna quis ullamcorper fringilla, erat ante facilisis lorem, et aliquet tellus sem mattis felis. Sed blandit mi at sem sagittis fringilla. Mauris eget justo dui. Nullam consequat condimentum tortor, et ultrices dui ultricies sed. Phasellus quis turpis massa. Quisque fermentum egestas tortor, tempor adipiscing urna posuere dignissim. Maecenas condimentum erat nec est rhoncus faucibus ut at nunc. Donec ornare arcu sit amet enim vestibulum sagittis. Maecenas semper posuere eros. Phasellus lacinia blandit faucibus.
</p>
<ul class="ref2">
<li><h3>CEO, Wise Solutions</h3></li>
<li><h4>Jeremiah Ridenour</h4></li>
</ul>

<p class="ref">
Quisque fermentum egestas tortor, tempor adipiscing urna posuere dignissim. Maecenas condimentum erat nec est rhoncus faucibus ut at nunc. Donec ornare arcu sit amet enim vestibulum sagittis. Maecenas semper posuere eros. Phasellus lacinia blandit faucibus.Quisque fermentum egestas tortor, tempor adipiscing urna posuere dignissim. Maecenas condimentum erat nec est rhoncus faucibus ut at nunc. Donec ornare arcu sit amet enim vestibulum sagittis. Maecenas semper posuere eros. Phasellus lacinia blandit faucibus.</p>
<ul class="ref2">
<li><h3>VP of Products, Ketera</h3></li>
<li><h4>Mike Gardner</h4></li>
</ul>

<p class="ref">
Sed blandit mi at sem sagittis fringilla. Mauris eget justo dui. Nullam consequat condimentum tortor, et ultrices dui ultricies sed. Phasellus quis turpis massa. Quisque fermentum egestas tortor, tempor adipiscing urna posuere dignissim.</p>
<ul class="ref2">
<li><h3>VP of Engineering, Jack Be</h3></li>
<li><h4>Deepak Alur</h4></li>
</ul>
</div>
</div>
</div>
<!--End References-->

<div id="footer"></div>
</body>
</html>
