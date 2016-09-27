<?php
session_start();
include "db/db.php";

if (!empty($_POST)) {
    $user = $_SESSION['id'];
    $topic = $_POST['topic'];
    $content = $_POST['comment'];
    $query = "Insert Into comment (`content`, `user`, `topic`) Values ('$content', $user, $topic);";

    $result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);

    header("Location: topic.php?id=" . $topic);
    exit();
} else {
    $query = "Select * from topic where id=" . $_GET['id'];

    $result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
    $topic = mysql_fetch_assoc($result);
}

$pageTitle = $topic['title'];
include "holder/header.php";
?>
<div class="grid padding10">
    <div class="row cells4">
        <h1 class="leader cell"><?php echo $topic['title'] ?></h1>
        <p class="text-accent">
            <?php echo $topic['content'] ?>
        </p>
    </div>
    <div class="row cells8">
        <h2 class="sub-leader cell">USER</h3>
            <p class="text-default">
                Comment
            </p>
    </div>
    <form action="topic.php" method="post">
        <div class="input-control textarea row" data-role="input" data-text-auto-resize="true" data-text-max-height="200">
            <textarea placeholder="Say something about this..." name="comment"></textarea>
        </div>
        <input type="hidden" name="topic" value="<?php echo $topic['id'] ?>">
        <input type="submit" class="button primary" value="Submit">
    </form>

</div>
<?php include "holder/footer.php"; ?>