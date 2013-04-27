<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CredMine</title>
<link rel="stylesheet" href="<?php echo base_url();?>/twitter-bootstrap/docs/assets/css/bootstrap.css">
</head>
<body>
<strong>Users Account Information
<table class="table">
		<?php	
			  $data=$this->data; 
			  if (count($data) < 1) {?>
				<tr><td>No results found. Please try your search again, or try <a href="another-search">another search</a>.</td></tr>			
		<?php }else{?>
				<tr><th>USERNAME</th><th>FULLNAME</th><th>FIRST NAME</th><th>LASR NAME</th><th>EMAIL</th><th> </th></tr>
		<?php 
					foreach($data as $rowAccount){
						echo "<tr>";
						echo "<td><a href=".base_url()."admin/viewAccount/userid/".$rowAccount->userid.">".$rowAccount->username."</a></td><td>".$rowAccount->fullname."</td>";
						echo "<td>".$rowAccount->firstname."</td><td>".$rowAccount->lastname."</td><td>".$rowAccount->email."</td>";
						echo "<td><a class='btn btn-danger'>Delete</a></td>";
						echo "<td><a class='btn btn-info' href=".base_url()."admin/viewAccount/userid/".$rowAccount->userid.">View</a></td>";
						echo "</tr>";
					}
				}	
		?>
</table>


</body> 
</html>