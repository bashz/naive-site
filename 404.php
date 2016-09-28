<?php
session_start();
include "db/db.php";
include "lib/utils.php";

error_log("Page not found, referrer : " . $_GET['ref']);

$pageTitle = "Not Found";
include "holder/header.php";
?>
<div class="grid padding20">
    <div class="row padding20">
        <h1 class="leader"><a href="index.php">Not Found, go home</a></h1>
    </div>
</div>
<?php include "holder/footer.php"; ?>