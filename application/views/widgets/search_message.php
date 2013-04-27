<?php

 foreach ($results as $result)
 {
    echo '<h4>'.$result['firstname'].'</h4>';
    echo $result['lastname'];
    echo '<hr>';    
}

if (count($results) < 1) {
    echo 'No results found. Please try your search again, or try <a href="another-search">another search</a>.';
}
?>
