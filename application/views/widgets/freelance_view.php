<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style_common.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style1.css" />
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css' />
<div class="scrollspy-credential" data-offset="0" data-target="#navbarExample" data-spy="scroll">
	<div class="main">
	<?php
		$data = $this->myportfolio_model->getMyportfolio($account->userid);		
		for($i=0;$i<count($data);$i++){
	?>
		
			<div class="view view-first">
				<img src=<?php echo base_url()."uploads/myportfolio/".$userid."/".$data[$i]->image;?>  />
					<div class="mask">
						<h2 class="port-h2"><?php echo $data[$i]->title;?></h2 class="port-h2">
							<p><?php echo $data[$i]->description;?></p>
							<a href="#" class="info">Buy Now</a>
					</div>
			</div> 
	<?php
		}
	?>
	</div>
</div>
			