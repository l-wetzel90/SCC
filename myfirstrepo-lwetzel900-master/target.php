<?php
$things = filter_input(INPUT_GET, 'things');
$stuff = filter_input(INPUT_GET, 'anum', FILTER_VALIDATE_INT);
$password = filter_input(INPUT_GET, 'secret', FILTER_VALIDATE_INT);

if ($stuff === $password){
    $message = 'you guessed it!';
}else {
    $message = 'nope';
}

var_dump($stuff);
var_dump($password);

?>
<!DOCTYPE html>
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>  
    <body>
        <h2>
            <?php
            echo $message
            ?>
        </h2>
        
        <p><?php echo $password ?></p>
    </body>
</html>