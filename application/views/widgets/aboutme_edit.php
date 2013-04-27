<?php
	$strlocation = '';
	$arrlocation[] = $account->streetaddress1;
	$arrlocation[] = $account->city;
	$arrlocation[] = $account->state;
	$arrlocation[] = $account->postalcode;
	$arrlocation[] = $account->country;
	$strlocation = implode(',',$arrlocation);	
?>
<script src="<?php echo base_url();?>js/common.js"></script>
<form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
	<fieldset>
		
			<div class="control-group">
				<label class="control-label" for="location">Location</label>
					<div class="controls">
						<input type="text" class="input-xlarge" tabindex="1" size="20" id="user_location" name="user[location]" maxlength="50" value="<?php echo $strlocation;?>">								
						<p class="help-block"></p>
						<label class="error" id="locationerror"></label>
					</div>
			</div>
							
			<div class="control-group">
				<label class="control-label" for="user_headline">Headline</label>
				<div class="controls">								
					<input id="user_headline" class="input-xlarge" type="text" tabindex="2" size="20" name="user[headline]" maxlength="50" placeHolder="Some thing catcy that describes you" value="<?php echo $account->headline;?>"/>
					<p class="help-block"></p>
					<label class="error" id="headlineerror"></label>
				</div>
			</div>
							
			<div class="control-group">
				<label class="control-label" for="user_tags">Tags</label>
				<div class="controls">								
					<input id="user_tags" class="input-xlarge" type="text" tabindex="3" size="20" name="user[tags]" maxlength="50" placeHolder="Eg:Enterpreneour,Student,Designer,Marketer"/>
					<p class="help-block"></p>
					<label class="error" id="tagserror"></label>
				</div>
			</div>
							
			<div class="control-group">
				<label class="control-label" for="user_bio">Short Bio</label>
				<div class="controls">
					<textarea id="user_bio" class="input-xlarge" type="text" tabindex="4" rows="4" cols="50" name="user[bio]"><?php echo $account->aboutme;?></textarea>
					<p class="help-block"></p>
					<label class="error" id="bioerror"></label>
				</div>
			</div>
			<!--				
			<div class="control-group">
				<label class="control-label" for="user_picture">Picture</label>						
				<div class="controls">
					<div class="span2">
						<?php   if(!empty($fb_pic)): ?>
								<img src="<?php echo $fb_pic;?>" width="50" heigh="50"/>
								<?php
								else :
									echo img('images/extras/cam.png');	
								endif;
						?>
					</div>
					<div class="span6">
												
						<input id="user_picture" class="fileUpload" type="file" tabindex="5" size="" name="user[picture]" maxlength="20" />								
						<p class="help-block"></p>						
					</div>
				</div>
			</div>
			-->
			<div class="form-actions">
				<input class="btn btn-primary" type="submit" id="user_next" value="Commit Changes">
			</div>					
		</fieldset>					
<form>	


<script>
$("#user_next").click(function(event) {
		event.preventDefault();
		validateAbout();
		return false;
});
function validateAbout() {
    	var user_tags = $("#user_tags").val();
		alert(user_tags);
    	var errorid = $("#abt" + " .errors");
	
		$(errorid).empty();
		$(errorid).hide();
		
		if (isEmpty(user_tags)) {
			$(errorid).append("You must enter a valid tags." );
		}	
		
			
		if ($(errorid).html()) {
			$(errorid).show();
			return false;
		}
		
		return true;
	}
	
if (! validateAbout()) {
	return;
}
</script>
