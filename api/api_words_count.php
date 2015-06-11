<?php

header('Content-Type: application/json');
$arr_cb = array();
$hdn_syllable = $_POST['hdnValueSyllable_'];


if (isset($hdn_syllable)) {
    $count = 0;
    $path = "../files/words.txt";
    $f = fopen($path, "r");
    while (!feof($f)) {
        $line = fgets($f);
        $count++;
    }
    fclose($f);
    $arr_cb['msg'] = $count;
}
echo json_encode($arr_cb);
?>