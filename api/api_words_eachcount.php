<?php
header('Content-Type: application/json');
include 'api_sub_syllable_counter.php';
$arr_ecw = array();
$each_syllable = $_POST['hdnValueSyllable_'];


// if (isset($each_syllable)) {
	$path = "../files/words.txt";
	$arr_wordslist = file($path);
	$remove_duplicate = array_unique($arr_wordslist);
	$arr_nums = (int)count($remove_duplicate);
	foreach ($remove_duplicate as $key => $value) {
		$cc = count_syllables($value); //ok
		echo $value." => ".$cc, PHP_EOL;
	}
	// for ($i=1; $i <= $arr_nums; $i++) {
	// }
	// echo "loop => ".$throw_result.", ";
	// echo "count => ".$arr_nums;
	// $wordslist = explode(" ", file_get_contents($path));
	// $v = array_unique($wordslist);
	// $arr_ecw['msg'] = $value;
// }

echo json_encode($arr_ecw);
?>