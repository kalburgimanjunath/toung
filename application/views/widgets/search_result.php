<?php
	print_r($results);
    echo '<h4>'.$results->firstname.'</h4>';
    echo $results->firstname;
    echo '<hr>';    


if (count($results) < 1) {
    echo 'No results found. Please try your search again, or try <a href="another-search">another search</a>.';
}
?>
