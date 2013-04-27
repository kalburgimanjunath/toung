
<?php 
$data = $this->books_model->getBooks($account->userid);	

	for($i=0;$i<count($data);$i++){
		?>
		<iframe src="<?php echo base_url();?>uploads/books/<?php echo $data[$i]->coverpic;?>" style="border: none;height:500px;width:100%;"></iframe>
		<?php
	}
?>