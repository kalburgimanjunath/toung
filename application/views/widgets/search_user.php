<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Toung</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/profile.css">
</head>
<body>

<div class="span6">
	
	<ul class="nav nav-tabs" id="myTab">
		<li class="active"><a href="#user">People</a></li>
		<li><a href="#job">Jobs</a></li>
    </ul>
     
    <div class="tab-content">
		<div class="tab-pane active" id="user">
			<form method="post" class="well form-search" action="<?php echo base_url();?>account/search_user">
				<div class="span4">
					<input type="search" name="keyword" id="keyword" size="50" maxlength="50" class='search_box' placeholder="Search for people,companies and titles"/>
					<input type="submit" value="Search" class="btn btn-primary"  id="searchuser"/>
				</div>
			</form>
		</div>
		
		<div class="tab-pane" id="job">
			<form method="post" class="form-search" action="<?php echo base_url();?>account/search_user">
				<div class="span4">
					<input type="search" name="keyword" id="keyword" size="40" class='search_box' placeholder="Search job by keyword,title or company"/>
					<input type="submit" value="Search" class="btn btn-primary"  id="searchuser"/>
				</div>
			</form>		
		</div>   
    </div>
	<p><b>To Do</b> :<a data-toggle="modal" href="#myModal" >Update your professional photo</a></p>

	<div class="modal hide" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Change Your Professional Photo</h3>
		</div>
		<div class="modal-body">
			<p><input type="file" name="photo" /></p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
    </div>
</div>	


 <script>
	$('#myTab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
    })
</script>