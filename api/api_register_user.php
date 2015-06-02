<?php
header('Content-Type: application/json');
session_start();
require_once '../config/db_global.php';

$arr_r_callback = array();

$g_r_username = $_POST['r_username_inp'];
$g_r_password = $_POST['r_password_inp'];
$g_r_firstname = $_POST['r_first_name'];
$g_r_lastname = $_POST['r_last_name'];
$g_r_email = $_POST['r_email_'];
$g_r_birthday = $_POST['r_birthday_'];
$g_r_phonenumber = $_POST['r_phonenumber_'];

$cur_date = time();
$encypt_psw = md5($g_r_password);
if (($g_r_username) && ($g_r_password) && ($g_r_firstname) && ($g_r_lastname) && ($g_r_email) && ($g_r_birthday) && ($g_r_phonenumber) != "") {
    //only alphanumeric
    if (preg_match('/^(?=.{8,25}$)[a-zA-Z][a-zA-Z0-9]*(?: [a-zA-Z0-9]+)*$/', $g_r_username)) {
        //chk existing username
        $preparing_chk = "
        SELECT u.user_name
        FROM user AS u
        WHERE u.user_name = '" . $g_r_username . "'
        ";
        $exc_chk = mysqli_query($sync_db_obj, $preparing_chk);
        $exc_rows = mysqli_num_rows($exc_chk);
        if ($exc_rows != 0) {
            $arr_r_callback["msg"] = "0x2007c";
        } else {
            $preparing_data = "
            INSERT INTO user(user_name, user_password, user_email, first_name, last_name, birthday, telephone, created_date)
            VALUES ('" . $g_r_username . "', '" . $encypt_psw . "', '" . $g_r_firstname . "', '" . $g_r_lastname . "', '" . $g_r_email . "', '" . $g_r_birthday . "', '" . $g_r_phonenumber . "', '" . $cur_date . "')
            ";
            $exc_add = mysqli_query($sync_db_obj, $preparing_data);
            if ($exc_add == TRUE) {
                $arr_r_callback["msg"] = "0x4b0fd08";
            }
        }
    }
    else {
        $arr_r_callback['msg'] = "0x0a";
    }
}
else {
    $arr_r_callback["msg"] = "0x00000f002";
}
echo json_encode($arr_r_callback);
?>