<?php
require_once '../config/db_global.php';
session_start();
session_unset();
session_destroy();
header("Location: ../index.php");
?>