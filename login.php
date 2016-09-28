<?php
session_start();
include "db/db.php";
include "lib/utils.php";

if (!empty($_GET)) {
    $email = $_GET['email'];
    $password = $_GET['password'];
    $query = "Select * from user where email='" . $email . "' and password='" . $password . "'";
    error_log($query);
    $result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
    if ($result) {
        $user = mysql_fetch_assoc($result);
        if ($user) {
            session_destroy();
            session_start();
            if ($_GET['remember']) {
                setcookie('PHPSESSID', session_id(), time() + 780000);
                $query = "Update user set phpsessid='" . session_id() . "' where id=" . $user['id'];
                $result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
            }
            $_SESSION['id'] = $user['id'];
            if ($user['is_admin'])
                header("Location: admin.php");
            else
                header("Location: index.php");
            exit();
        }
    }
    header("Location: login.php");
    exit();
}

session_destroy();

if (isset($_COOKIE['PHPSESSID']) && $_COOKIE['PHPSESSID']) {
    $query = "Select * from user where phpsessid='" . $_COOKIE['PHPSESSID'] . "'";
    $result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
    $user = mysql_fetch_assoc($result);
    if ($user) {
        session_start();
        $_SESSION['id'] = $user['id'];
        if ($user['is_admin'])
            header("Location: admin.php");
        else
            header("Location: index.php");
        exit();
    }
}

$pageTitle = "Login";
include "holder/header.php";
?>
<div class="login-form padding20 block-shadow" style="opacity: 1; transform: scale(1); transition: 0.5s;">
    <form action="login.php">
        <h1 class="text-light">Login</h1>
        <hr class="thin">
        <br>
        <div class="input-control text full-size" data-role="input">
            <label for="user_login">Email:</label>
            <input type="text" name="email" id="user_login" style="padding-right: 36px;">
            <button class="button helper-button clear" tabindex="-1" type="button"><span class="mif-cross"></span></button>
        </div>
        <br>
        <br>
        <div class="input-control password full-size" data-role="input">
            <label for="user_password">Password:</label>
            <input type="password" name="password" id="user_password" style="padding-right: 36px;">
            <button class="button helper-button reveal" tabindex="-1" type="button"><span class="mif-looks"></span></button>
        </div>
        <br>
        <label class="input-control checkbox small-check">
            <input type="checkbox" name="remember">
            <span class="check"></span>
            <span class="caption">Remember me</span>
        </label>
        <br>
        <div class="form-actions">
            <button type="submit" class="button primary">Login</button>
            <button type="button" class="button link">Cancel</button>
        </div>
    </form>
</div>
<?php include "holder/footer.php"; ?>