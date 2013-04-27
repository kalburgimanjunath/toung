<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CredMine</title>
<link rel="stylesheet" href="<?php echo base_url();?>/twitter-bootstrap/docs/assets/css/bootstrap.css">
</head>
<body>


<table class="table">
<?php
	$this->load->model("education_model");
	$data=$this->education_model->getMyEducation($this->userId);	
?>
<tr><th>Education</th></tr>	
<?php	
	if (count($data) < 1) {
		echo '<tr><td>No results found.</td></tr>';			
	}else{
		foreach($data as $rowAccount){
			echo "<tr>";
			echo "<td><a href=".base_url()."admin/viewAccount/userid/".$rowAccount->userid.">".$rowAccount->institution."</a></td>";
			echo "</tr>";
		}
	}
?>
</table>


</body> 
</html>