<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CredMine</title>
<link rel="stylesheet" href="<?php echo base_url();?>/twitter-bootstrap/docs/assets/css/bootstrap.css">
</head>
<body>
<?php $rowAccount=$this->data; ?>
<strong>Users:<?php echo ucwords($rowAccount->fullname);?> Account Information
<table class="table">
<tr>	
	<?php	
		if (count($rowAccount) < 1) {
			echo '<td>No results found. Please try your search again, or try <a href="another-search">another search</a>.</td>';			
		}
	?>	
</tr>
	<?php 	
		$arrAddress=array(
			$rowAccount->streetaddress1,
			$rowAccount->city,
			$rowAccount->state,
			$rowAccount->country,
			$rowAccount->postalcode
		);
		$strAddress=implode(',',$arrAddress);
		$userId = $rowAccount->userid;
		$this->userId=$userId;
		echo "<tr><td>Username</td><td>".$rowAccount->username."</td></tr>";
		echo "<tr><td>Fullname</td><td>".$rowAccount->fullname."</td></tr>";
		echo "<tr><td>Firstname</td><td>".$rowAccount->firstname."</td></tr>";
		echo "<tr><td>Lastname</td><td>".$rowAccount->lastname."</td></tr>";
		echo "<tr><td>Email</td><td>".$rowAccount->email."</td></tr>";
		echo "<tr><td>Tele Phone</td><td>".$rowAccount->phone."</td></tr>";
		echo "<tr><td>Mobile</td><td>".$rowAccount->mobile."</td></tr>";
		echo "<tr><td>Status</td><td>".$rowAccount->status."</td></tr>";
		echo "<tr><td>Address</td><td>".wordwrap($strAddress,30,"<br/>")."</td></tr>";
		echo "<tr><td>Aboutme</td><td>".$rowAccount->aboutme."</td></tr>";		
		echo "<tr><td>".$this->load->view('admin/widgets/listEducation',$userId)."</td></tr>";
		echo "<tr><td>".$this->load->view('admin/widgets/listExperience',$userId)."</td></tr>";
		echo "<tr><td>".$this->load->view('admin/widgets/listSkill',$userId)."</td></tr>";
	?>


</table>


</body> 
</html>