<?php
header('Content-Type: text/html; charset=UTF-8'); 


foreach(array('UTF-7', 'UTF-8') as $type) {
    
    $string = "<script>alert('XSS');</script>";
    $string = mb_convert_encoding($string, $type);
    
    echo htmlentities($string); 
    print '<br />';
    
}

/*
htmlentities($string, ENT_QUOTES, 'UTF-8'); 
*/
?>

