<?php
session_start();
session_destroy();
setcookie('PHPSESSID', '', time() - 780000);
header("Location: login.php");