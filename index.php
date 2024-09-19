<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rebirth calculator</title>
</head>
<body>
    <?php
        echo "<h1>REBIRTH CALCULATOR</h1>";
    ?>

    <form method="post">
        <input placeholder="Enter your current rebirth." id="rebirth" name="rebirth" type="number">
        <div>
            <label>Do you own the 2x gamepass?</label>
            <input type="radio" id="gamepassYes" name="twoExGamepass" value="yes">
            <label for="gamepassYes">Yes</label>
            <input type="radio" id="gamepassNo" name="twoExGamepass" value="no">
            <label for="gamepassNo">No</label>
        </div>
        <div>
            <label>Is it the weekend?</label>
            <input type="radio" id="multiplierYes" name="includeMultipliers" value="yes">
            <label for="weekendYes">Yes</label>
            <input type="radio" id="multiplierNo" name="includeMultipliers" value="no">
            <label for="weekendNo">No</label>
        </div>
        <div>
            <label>Do you own the Winter Ronin Helmet?</label>
            <input type="radio" id="wrhYes" name="wrh" value="yes">
            <label for="wrhYes">Yes</label>
            <input type="radio" id="wrhNo" name="wrh" value="no">
            <label for="wrhNo">No</label>
        </div>

        <div>
            <label>Do you own the Speedy Oil Extractor?</label>
            <input type="radio" id="soeYes" name="soe" value="yes">
            <label for="soeYes">Yes</label>
            <input type="radio" id="soeNo" name="soe" value="no">
            <label for="soeNo">No</label>
        </div>

        <div>
            <label>Do you control the middle point?</label>
            <input type="radio" id="mPointYes" name="mPoint" value="yes">
            <label for="mPointYes">Yes</label>
            <input type="radio" id="mPointNo" name="mPoint" value="no">
            <label for="mPointNo">No</label>
        </div>

        <br>
        <input placeholder="How many friends are in your session?" id="friends" name="friends" type="number">

        <br>
        <input placeholder="How many oil did you take?" id="oil" name="oil" type="number">

        <br>
        <input placeholder="How many full crates did you take?" id="crates" name="crates" type="number">
        
        <button type="submit" name="submit">Calculate time needed to rebirth</button>
    </form>

    <?php
        if(isset($_POST['submit'])){
            $rebirth = $_POST['rebirth'];
            $twoExGamepass = $_POST['twoExGamepass'];
            $includeMultipliers = $_POST['includeMultipliers'];
            $wrh = $_POST['wrh'];
            $friends = $_POST['friends'];
            $soe = $_POST['soe'];
            $mPoint = $_POST['mPoint'];
            $crates = $_POST['crates'];
            $oil = $_POST['oil'];
            $timeNeeded = 0;
            $costNeeded = 0;
            $cashMultiplier = 1;
            $rebirthBonusMoney = 0;
            $moneyPerSecond = 0;
            $timeLimitReached = false;

            switch ($friends){
                case 1:
                    $cashMultiplier = 1.1;
                    break;
                case 2:
                    $cashMultiplier = 1.2;
                    break;
                case 3:
                    $cashMultiplier = 1.3;
                    break;
            }

            if($twoExGamepass == "yes"){
                $cashMultiplier *= 2;
            }

            if($includeMultipliers == "yes"){
                $cashMultiplier *= 2;
            }

            if($wrh == "yes"){
                $cashMultiplier *= 1.5;
            }

            switch ($rebirth){
                case 0:
                    $costNeeded = 4213000;
                    $moneyPerSecond = 2777;
                    break;
                case 1:
                    $costNeeded = 7119000;
                    $moneyPerSecond = 2777;
                    break;
                case 2:
                    $costNeeded = 11139000;
                    $moneyPerSecond = 2777;
                    break;
                case 3:
                    $costNeeded = 16533000;
                    $moneyPerSecond = 2777;
                    break;
                case 4:
                    $costNeeded = 20148000;
                    $moneyPerSecond = 2777;
                    break;
                case 5:
                    $costNeeded = 26846000;
                    $moneyPerSecond = 2777;
                    break;
                case 6:
                    $costNeeded = 33000000;
                    $moneyPerSecond = 2777;
                    break;
                default:
                    $costNeeded = 37251000;
                    $moneyPerSecond = 2777;
                    break;
            }

            if ($crates > 0){
                if ($twoExGamepass == "yes"){
                    $costNeeded -= $crates * 1800000;
                }
                else{
                    $costNeeded -= $crates * 900000;
                }
            }

            if ($oil > 0){
                if ($twoExGamepass == "yes"){
                    $costNeeded -= $oil * 800000;
                }
                else{
                    $costNeeded -= $oil * 400000;
                }
            }

            if ($soe == "yes"){
                $moneyPerSecond += 20;
            }

            if ($mPoint == "yes"){
                $moneyPerSecond += 800;
            }

            $rebirthBonusMultiplier = $cashMultiplier * 2;
            $moneyInRebirth = 0;

            while ($timeNeeded < 561 || $moneyInRebirth < $costNeeded){
                $timeNeeded += 1;
                $moneyInRebirth += $moneyPerSecond * $rebirthBonusMultiplier;

                if ($timeNeeded == 561 && $moneyInRebirth < $costNeeded){
                    $timeLimitReached = true;
                    break;
                }
                else if ($moneyInRebirth >= $costNeeded){
                    $moneyLimitReached = true;
                    break;
                }
            }

            if($timeLimitReached){
                while ($moneyInRebirth < $costNeeded){
                    $timeNeeded += 1;
                    $moneyInRebirth += $moneyPerSecond * $cashMultiplier;
                    echo "<h2>Time needed to rebirth: " . $timeNeeded . " seconds</h2>";
                }
            }
            else if($moneyLimitReached){
                echo "<h2>Next rebirth reached before the rebirth bonus multiplier ran out. Time needed to rebirth: " . $timeNeeded . " seconds</h2>";
            }
        }
    ?>
</body>
</html>