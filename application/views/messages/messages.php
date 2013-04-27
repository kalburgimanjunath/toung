<div class="container-fluid">
    <div class="row-fluid">
		
		
		<div class="span4">
			<?php //$this->load->view('widgets/profile',$account); ?>
		</div>
		<div class="span8">
			<ul class="nav nav-pills" id="myTab">
				<li class="active"><a href="#new" data-toggle="tab">New Message</a></li>
				<li><a href="#inbox" data-toggle="tab">Inbox</a></li>
				<li><a href="#sent" data-toggle="tab">Sent</a></li>
				<li><a href="#draft" data-toggle="tab">Draft</a></li>
				<li><a href="#request" data-toggle="tab">Connection Request</a></li>
				<li><a href="#recommend" data-toggle="tab">Recommendations</a></li>
			</ul>
			<div class="tab-content">	
				<div class="tab-pane" id="inbox">
					<?php $this->load->view('messages/inbox'); ?>
				</div>
				<div class="tab-pane" id="sent">
					<?php $this->load->view('messages/sent',$messages); ?>
				</div>
				<div class="tab-pane" id="request">
					<?php $this->load->view('messages/inbox',$messages); ?>
				</div>
				<div class="tab-pane" id="draft">
					<?php $this->load->view('messages/inbox',$messages); ?>
				</div>
				<div class="tab-pane active" id="new">
						<?php $this->load->view('messages/compose'); ?>
				</div>
				<div class="tab-pane" id="recommend">
					<?php $this->load->view('messages/sent',$messages); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    $('#myTab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
    })
	    
</script>