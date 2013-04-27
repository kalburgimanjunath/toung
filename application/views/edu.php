<script>
	protectedPage();
</script>

<script src="<?php echo base_url();?>js/education.js"></script>

<div id="education">
</div>
<div id="addeducation">
<input type="submit" value="Add Education" name="Add Education" id="addnewedu" class="submitbutton">
</div>

<script>
	$(function() {
		loadAndShowEdu($("#education"));		
			                           	
		$('#addnewedu').click(function() {
			$.jGrowl("Add new education");
			addEdu();
		});	

	});
</script>