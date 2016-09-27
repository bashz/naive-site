<?php
session_start();
include "db/db.php";

$query = "Select * from topic where id=" . $_GET['id'];
$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
while ($data = mysql_fetch_assoc($result)) {
    echo $data['title'];
}
$pageTitle = "Admin";
include "holder/header.php";
?>
<?php include "holder/footer.php"; ?>