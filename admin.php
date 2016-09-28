<?php
session_start();
include "db/db.php";
include "lib/utils.php";
$currentUser = isLogged();

if (!$currentUser['is_admin']) {
    notFound();
}

if(isset($_GET['action']) && isset($_GET['id'])){
    if($_GET['action'] === 'publish'){
        $query = "Update topic Set is_published = 1 where id=" . $_GET['id'];
    }else if($_GET['action'] === 'unpublish'){
        $query = "Update topic Set is_published = 0 where id=" . $_GET['id'];
    }else if($_GET['action'] === 'delete'){
        $query = "Delete from topic where id=" . $_GET['id'];
    }
    if($query)
        $result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);
    header("Location: admin.php");
    exit();
}

$query = "Select * from topic";
$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);

$pageTitle = "Admin";
include "holder/header.php";
?>
<table class="table striped hovered">
    <thead>
        <tr>
            <td>Title</td>
            <td>Preview</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
        <?php while ($topic = mysql_fetch_assoc($result)) : ?>
            <tr>
                <td><a href="topic.php?id=<?php echo $topic['id'] ?>"><?php echo $topic['title'] ?></a></td>
                <td>
                    <?php echo substr($topic['content'], 0, 120) ?>...
                    <a href="topic.php?id=<?php echo $topic['id'] ?>">Preview</a>
                </td>
                <td>
                    <?php if ($topic['is_published']) : ?>
                    <a href="admin.php?action=unpublish&id=<?php echo $topic['id']?>"class="button warning">Unpublish</a>
                    <?php else : ?>
                        <a href="admin.php?action=publish&id=<?php echo $topic['id']?>"class="button success">Publish</a>
                    <?php endif; ?>
                    <a href="admin.php?action=delete&id=<?php echo $topic['id']?>" class="button danger">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php include "holder/footer.php"; ?>