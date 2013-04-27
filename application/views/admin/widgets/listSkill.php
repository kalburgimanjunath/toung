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
	$this->load->model("skills_model");
	$data=$this->skills_model->getMySkills($this->userId);	
	print_r($data);
?>
<tr><th>Skills</th></tr>
<tr>

	<?php	
		if (count($data) < 1) {
			echo '<td>No results found.</td>';			
		}else{
			
			foreach($data as $rowSkills){
				echo "<tr>";
				echo "<td><a href=".base_url()."admin/viewAccount/userid/".$rowSkills->userid.">".$rowSkills->skillname ."</a></td>";
				echo "</tr>";
			}
		}
	?>
</tr>
</table>


</body> 
</html>