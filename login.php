<?php
session_destroy();
include "db/db.php";

if (!empty($_GET)) {
    $email = $_GET['email'];
    $password = $_GET['password'];
    $query = "Select * from user where email='" . $email . "'";
    $result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
    if ($result) {
        $user = mysql_fetch_assoc($result);
        if ($user['password'] == $password) {
            session_start();
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
        <br>
        <div class="form-actions">
            <button type="submit" class="button primary">Login</button>
            <button type="button" class="button link">Cancel</button>
        </div>
    </form>
</div>
<?php include "holder/footer.php"; ?>