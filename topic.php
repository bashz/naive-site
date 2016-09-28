<?php
session_start();
include "db/db.php";
include "lib/utils.php";
$currentUser = isLogged();

if (!empty($_POST)) {
    $user = $_SESSION['id'];
    $topic = $_POST['topic'];
    $content = $_POST['comment'];
    $query = "Insert Into comment (`content`, `user`, `topic`) Values ('$content', $user, $topic);";

    $result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);

    header("Location: topic.php?id=" . $topic);
    exit();
} else if (isset($_GET['id'])) {
    $published = "is_published = 1 and";
    if($currentUser['is_admin'])
        $published = ""; 
    
    $query = "Select * from topic where $published id=" . $_GET['id'];

    $result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
    $topic = mysql_fetch_assoc($result);
    if (!$topic) {
        notFound();
    }
} else {
    notFound();
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
    
    <?php
    $query = "Select C.*, U.username from comment C left join user U on U.id = C.user where C.topic=" . $_GET['id'];

    $result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
    ?>
    <?php while ($comment = mysql_fetch_assoc($result)) : ?>
        <div class="row cells8">
            <h2 class="sub-leader cell"><?php echo $comment['username'] ?></h2>
            <p class="text-default"><?php echo $comment['content'] ?></p>
        </div>
    <?php endwhile; ?>
    
    <?php if($currentUser) : ?>
    <form action="topic.php" method="post">
        <div class="input-control textarea row" data-role="input" data-text-auto-resize="true" data-text-max-height="200">
            <textarea placeholder="Say something about this..." name="comment"></textarea>
        </div>
        <input type="hidden" name="topic" value="<?php echo $topic['id'] ?>">
        <input type="submit" class="button primary" value="Submit">
    </form>
    <?php endif; ?>

</div>
<?php include "holder/footer.php"; ?>