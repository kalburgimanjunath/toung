<div class="span12" >
	
    <div class="row-fluid">
		<div class="span2">		
			<?php 				
				if(!empty($account->communityid)){
					$data['social'] = $this->socialids_model->getMySocialIds($account->userid);		
					$image_properties = array(
					  'src' => $data['social'][0]->identity,
					  'alt' => '',
					  'class' => '',
					  'width' => '150',
					  'height' => '150',
					  'title' => 'Profile Picture',
					  'style' => 'display:block'
					);
					echo img($image_properties);	
					
			?>
				<!--<fb:profile-pic uid="loggedinuser" size="small" facebook-logo="true"></fb:profile-pic>-->
			<?php
				}else{
					$this->load->view('widgets/picture',$profile);
				}
			?>
			
			<div class="span10">
				<p><b><?php echo ucfirst($account->fullname);?></b></p>
				<a href="<?php echo base_url();?>profile/editprofile"><i class="icon-list-alt"></i>Edit Profile</a>
			</div>
			
		</div>
		<!--
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo $this->config->config['facebook_api_key'];?>";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>-->
		
		<div class="span10">
		
			<?php $this->load->view('widgets/about',$account); ?>
				
				<div class="span12">
					<ul class="nav nav-pills" id="myTab">
						<li class="active"><a href="#wall" data-toggle="tab">My Wall</a></li>		
						<li><a href="#about" data-toggle="tab">My Network</a></li>				
						<li><a href="#activity" data-toggle="tab">Activity</a></li>
						<!--<li><a href="#photos" data-toggle="tab">Photos</a></li>-->
						<li><a href="#freelance" data-toggle="tab">My Projects</a></li>
						<li><a href="#training" data-toggle="tab">My Training MATS</a></li>
						<li><a href="#eshop" data-toggle="tab">E-Shop</a></li>
					</ul>
					
					<div class="tab-content" >	
						<!--
							<div class="tab-pane active" id="wall">
								<?php $this->load->view('widgets/fbwall',$account); ?>
							</div>
							<div class="tab-pane" id="about">
								<?php //$this->load->view('widgets/fbconnections',$account); ?>
							</div>
							<div class="tab-pane" id="activity">					
								<?php //$this->load->view('widgets/fbactivity',$account); ?>
							</div>
							<div class="tab-pane" id="freelance">					
								<?php //$this->load->view('widgets/activity',$account); ?>
								<?php $this->load->view('widgets/freelance_view',$account); ?>
							</div>
							<!--
							<div class="tab-pane" id="photos">					
								<?php //$this->load->view('widgets/fbphotos',$account); ?>
							</div>-->
							
							<!--
							<div class="tab-pane" id="training">					
								Training materials will be available here.
								<?php $this->load->view('widgets/pdfViewer',$account); ?>
							</div>
							<div class="tab-pane" id="eshop">					
								E-Shop
							</div>
						-->
					</div>
				</div>
			</div>
			
						
			
			<?php //$this->load->view('widgets/dashboard_profile',$account); ?>
		<!--Body content-->
		</div>
		
    </div>
</div>
 <script>
	$('#myTab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
    })
	$(window).load(function() {
		$('#loading-image').hide();
	});
</script>

