<!DOCTYPE html>

<?php
// TASKS
// 1. Look at my version http://citatscc.org/~fs148523/Seasonal/
// 2. You'll use the $seasons array to make the appropriate parts of the page be dynamic to match my version.
// 3. Use php's date function to get current month's number without leading zeros http://php.net/manual/en/function.date.php
// 4. Write some logic to use the month number to create a month string to use as a key for the $seasons array 
// 5. Add the ability so that if the month is appended on the URL as a get parameter override the actual month
//      e.g. if this is entered in the address bar http://localhost/SeasonalWorkIt/index.php?month=12
//           the page would display the styling for Winter

$month_from_url = filter_input(INPUT_GET, 'month', FILTER_VALIDATE_INT);

$seasons = array(
    "Winter" => array('bg_color' => 'gray', "text_color" => "white", "saying" => ", happy holidays!"),
    "Spring" => array('bg_color' => 'green', "text_color" => "purple", "saying" => " the ides of march."),
    "Summer" => array('bg_color' => 'yellow', "text_color" => "pink", "saying" => " to wear sunscreen."),
    "Fall" => array('bg_color' => 'orange', "text_color" => "brown", "saying" => " oktoberfest, Prosit!"),
    "Error" => array('bg_color' => 'red', "text_color" => "deeppink", "saying" => " dude what did you do?")
);

if (isset($month_from_url)) {
    $month = $month_from_url;
} else {
    $month = date('n');
}


switch ($month) {
    case 1:
    case 2:
    case 12:
        $season = 'Winter';
        break;
    case 3:
    case 4:
    case 5:
        $season = 'Spring';
        break;
    case 6:
    case 7:
    case 8:
        $season = 'Summer';
        break;
    case 9:
    case 10:
    case 11:
        $season = 'Fall';
        break;
    default:
       $season = 'Error';
            break;
}

//$season = 'Summer';

var_dump($seasons[$season]);
?>

<html>
    <head>
        <meta charset="UTF-8">
        <style>body {
                background-color: <?php echo $seasons[$season]['bg_color']?>; }

            h1, h2 {
                color: <?php echo $seasons[$season]['text_color']?>; }
        </style>

        <title>Seasons Greetings</title>
    </head>
    <body>
        <h1> Season's Greetings! </h1>
        <h2>Month: <?php echo $month?></h2>
        <p> I hope you're having a happy <?php echo $season?> </p>

        <p> and make sure to remember <?php echo $seasons[$season]['saying']?> </p>

        <br><br>
        <?php 
            for($i = 1; $i <= 12; $i++){
                echo "<a href=\"index.php?month=".$i."\">Month " . $i . " override test link</a><br>";
            }
        ?>
        
    </body>
</html>
