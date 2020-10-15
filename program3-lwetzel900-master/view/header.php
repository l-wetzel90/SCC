<?php
$basedir = dirname(__DIR__);
$basedir = explode("\\", $basedir);
$basedir = array_pop($basedir);
//array_pop(explode("\\", dirname(__DIR__))) 
?>
<!DOCTYPE html>
<html>    
    <!-- the head section -->
    <head>
        <title>Summerstar Creations</title>
        <link rel="stylesheet" type="text/css" href="/<?php echo htmlspecialchars($basedir) ?>/main.css" >
        
    </head>
    <!-- the body section -->
    <body>
        <header>
            <img src="/<?php echo htmlspecialchars($basedir) ?>/images/SummerstarCreationsLogo.jpg" alt="Kissing Heart">
            <p>Planning, Decorating and Everything Wedding</p>
        </header>
        <nav id="navbar">
            <ul>
                <li><a href="/<?php echo htmlspecialchars($basedir) ?>">Home</a></li>
                <li> <a href="/<?php echo htmlspecialchars($basedir) ?>/user">User</a></li>
                <li> <a href="/<?php echo htmlspecialchars($basedir) ?>/user/?action=visitorShow">Visitor</a></li>
                <li> <a href="/<?php echo htmlspecialchars($basedir) ?>/store">Store</a></li>
                <li class="admin"><a href="/<?php echo htmlspecialchars($basedir) ?>/admin">Admin</a></li>
            </ul>
        </nav>    



