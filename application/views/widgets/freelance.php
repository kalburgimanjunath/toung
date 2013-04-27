<form method="post" action="<?php echo base_url();?>portfolio/do_upload" class="form-horizontal" enctype="multipart/form-data">
	<div class="modal-header">
	<h3>Upload Your Project images</h3>
	</div>
	
	<div class="modal-body">
	<p><input type="file" id="userfile" name="userfile" /></p>
	</div>
	
	<div class="modal-footer">
	<a href="#" class="btn" data-dismiss="modal">Close</a>
	<input type="submit" class="btn btn-primary" id="save_picture" value="Save changes"/>
	</div>
	<?php $this->load->view('widgets/freelance_view'); ?>
</form>