<?php

function notFound() {
    header("Location: 404.php?ref=" . $_SERVER['REQUEST_URI']);
    exit;
}

function isLogged() {
    if ($_SESSION['id']) {
        $uQuery = "Select * from user where id=" . $_SESSION['id'];
        $uResult = mysql_query($uQuery) or trigger_error(mysql_error(), E_USER_ERROR);
        $currentUser = mysql_fetch_assoc($uResult);
        if ($currentUser) {
            return $currentUser;
        }
    }
    return false;
}

