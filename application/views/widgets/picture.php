<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<?php			
	$image_properties = array(
	  'src' => 'images/extras/default_picture.jpg',
	  'alt' => '',
	  'class' => '',
	  'width' => '250',
	  'height' => '250',
	  'title' => 'Profile Picture'
	);
	
	$path = $this->config->config['imageupload_path'].$profile[0]->userid.'/'.$profile[0]->avatar;
	echo $path;
	if(empty($profile[0]->avatar)){
		$image_properties = array(
		  'src' => 'images/extras/default_picture.jpg',
		  'alt' => '',
		  'class' => '',
		  'width' => '250',
		  'height' => '250',
		  'title' => 'Profile Picture'
		);
	}
	if(file_exists($path)){					
		$image_properties = array(
			'src' => $this->config->config['imageupload_path'].$profile[0]->userid.'/'.$profile[0]->avatar,
			'alt' => '',
			'class' => '',
			'width' => '250',
			'height' => '250',
			'title' => 'Profile Picture'
		);
						
	}else if(!empty($profile[0]->avatar)){
		$image_properties = array(
		  'src' => $this->config->config['imageupload_path'].$profile[0]->userid.'/'.$profile[0]->avatar,
		  'alt' => '',
		  'class' => '',
		  'width' => '250',
		  'height' => '250',
		  'title' => 'Profile Picture'
		);
						
	}
	else{
		$image_properties = array(
		  'src' => 'images/extras/default_picture.jpg',
		  'alt' => '',
		  'class' => '',
		  'width' => '250',
		  'height' => '250',
		  'title' => 'Profile Picture'
		);				
	}
	echo img($image_properties);	
?>





	

