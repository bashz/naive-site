<?php
$conn = mysql_connect("localhost", "root", "&&11RooT") or trigger_error(mysql_error(),E_USER_ERROR);
$bdd = mysql_select_db("hackable", $conn);
