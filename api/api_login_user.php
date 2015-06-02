<?php

header('Content-Type: application/json');
session_start();
include '../config/db_global.php';

$arr_universe = array();
$g_username = $_POST['username_inp'];
$g_password = $_POST['password_inp'];
$g_remme = $_POST['rem_inp'];

if (($g_username) && ($g_password) != "") {
    $encypt_src = md5($g_password);
    $exist_user = "
    SELECT *
    FROM user AS u
    WHERE u.user_name = '" . $g_username . "' AND u.user_password = '" . $encypt_src . "'
    ";
    $qry = mysqli_query($sync_db_obj, $exist_user);
    $rows = mysqli_num_rows($qry);
    if ($rows == 0) {
        $arr_universe["msg"] = "0x1d5ef03";
    }
    else {
        while ($_data = mysqli_fetch_array($qry)) {
            $us_userName = $_data['user_name'];
        }
        if ($g_remme != "remember-me") {
            $_SESSION['uSname'] = $us_userName;
            $arr_universe["msg"] = "0x0c00fe9";
        } else {
            $_SESSION['uSname'] = $us_userName;
            $arr_universe["msg"] = "0x0c00fe9";
        }
    }
}
echo json_encode($arr_universe);
?>