<!DOCTYPE html>
<?php
//1525 first GIT repo
$rando = rand(1,2);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Loren Wetzel</title>
    </head>
    <body>

        <form action="target.php" method="get">

                <label>Things</label>
                <input type="text" name="things"><br>

                <label>Stuff</label>
                <input type="number" name="anum"><br>
                
                <input type="hidden" name="secret" value="<?php echo $rando ?>">

                <label>&nbsp;</label>
                <input type="submit" value="Send"><br>

        </form>

    </body>
</html>
