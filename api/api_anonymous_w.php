<?php

header('Content-Type: application/json');
$src_paragraph = $_POST['src_p'];
$src_paragraph = strip_tags($src_paragraph);
$src_paragraph = trim($src_paragraph);
$respone_re = array();

function w_data_words($e) {    
    if ($e != "") {
        $e = strtolower($e); //all lowercase
        $path = "../files/words.txt";
        $e = preg_replace('/^\.+|\.+$/', "", $e); //remove . (dot)
        $words = preg_split("/[\s,;:?!&()\"]+/", $e);
        file_put_contents($path, implode(PHP_EOL, $words));
    }
}

function w_data_sentence($a) {
    if ($a != "") {
        $path = "../files/sentence.txt";
        $sentence = preg_split("/[.!?] .*?/", $a); // pattern non-remove all dot [/^\.+|\.+$/]
        file_put_contents($path, implode(PHP_EOL, $sentence));
    }
}

if ($src_paragraph != "") {
    w_data_sentence($src_paragraph);
    w_data_words($src_paragraph);
    $respone_re['msg'] = "0xd0a";
} else {
    $respone_re['msg'] = "@F";
}
echo json_encode($respone_re);
?>