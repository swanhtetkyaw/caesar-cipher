<?php
    $text = "";

    if(isset($_POST['text']) && isset($_POST['shift'])){
        $text = $_POST['text'];
        $asciiTextArr = unpack("C*", $text);
        $shiftNumber = $_POST['shift'];
        $encodedArr = array();

        function encodeCharacter($characterNum, $shiftNumber,$start,$end) {
            global $encodedArr;
            $shiftedCharNum = $characterNum + $shiftNumber;
    
            if($shiftedCharNum > $end) {
                $shiftedCharNum = $start + ($shiftedCharNum - $end);
            }
    
            $encodedChar = chr($shiftedCharNum);
            $encodedArr[] = $encodedChar;
        }
    
        foreach($asciiTextArr as $ench) {
    
            if ($ench >= 97 && $ench <= 122) {
                encodeCharacter($ench,$shiftNumber,96,122);
            }elseif($ench >= 65 && $ench <=90) {
                encodeCharacter($ench,$shiftNumber,64,90);
            }else {
                 $encodedArr[] = chr($ench);
            }
        }
        $text =  implode("",$encodedArr);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>caesar-cipher</title>
</head>
<body>
    <form action="caesar-cipher.php" method="post">
        <label for="text">Enter Text :</label>
        <input type="text" id="text" name="text" required>
        <label for="shift">Enter Shift Number: </label>
        <input type="text" id="shift" name="shift" required>
        <button type="submit">Encode</button>
    </form>
    <p><?php echo $text ?></p>
</body>
</html>