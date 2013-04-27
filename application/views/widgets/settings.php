
<div class="span9">
	
	<ul class="nav nav-tabs" id="myTab">
		
				<li><a href="#about">About</a></li>										
				<li><a href="#education">Education</a></li>
				<li><a href="#theme">Select Theme</a></li>
				<li><a href="#message">Messages</a></li>
				<li><a href="#message">Settings</a></li>				
		
    </ul>
	<div class="tab-content">
		<div class="tab-pane" id="about">
			<?php $this->load->view('widgets/about'); ?>
		</div>
		<div class="tab-pane" id="education">
			<?php $this->load->view('widgets/profile'); ?>
		</div>
		<div class="tab-pane" id="messages">Messages</div>
		<div class="tab-pane" id="settings">Settings</div>
	</div>
    
</div>	
