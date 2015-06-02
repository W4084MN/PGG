<?php

global $sync_db_obj;
$sync_db_obj = mysqli_connect("localhost", "root", "123456", "db_pgg");
mysqli_query($sync_db_obj, "SET character_set_result=utf8");
mysqli_query($sync_db_obj, "SET character_set_client=utf8");
mysqli_query($sync_db_obj, "SET character_set_connection=utf8");
mysqli_query($sync_db_obj, "SET SESSION collation_connection = 'utf8_unicode_ci'");

?>