<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calendar</title>
    <link rel="stylesheet" href="bai1.css">
</head>

<body>
    <h1>Select a Month/Year Combination hello</h1>
    <div>
        <select name="month">
            <?php 
                //create an array of month
                $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                
                //get current month
                $curr_month = date("m");
                echo $curr_month;

                //print these all months to option tag
                foreach ($months as $i=>$month){
                    $int_month = $i + 1;
                    if ($int_month == $curr_month) echo "<option value=\"$int_month\" selected>$month</option>\n";
                    else echo "<option value=\"$int_month\">$month</option>\n";
                }
            ?>
        </select>
        <select name="year">
            <?php 
                //get current year
                $curr_year = date("Y");
                for ($i = $curr_year - 10; $i <= $curr_year + 10; $i++){
                    //if $i is the current year then make it selected
                    if ($i == $curr_year) echo "<option value=\"$i\" selected>$i</option>\n";
                    else echo "<option value=\"$i\">$i</option>\n";
                }
            ?>
        </select>
        <input type="submit" value="GO!">
    </div>

    <?php 
        // create an array of days of week
        $daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    ?>

    <br>
    <table>
        <tr>
            <?php 
                foreach ($daysOfWeek as $day) {
                    echo "<th>$day</th>";
                }
            ?>
        </tr>
        <tr>
            
        </tr>
    </table>
</body>
</html>