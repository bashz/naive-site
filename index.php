<?php
session_start();
include "db/db.php";

$query = "Select * from topic";

$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);

$pageTitle = "Home";
include "holder/header.php";
?>
<table class="table striped hovered">
    <thead>
        <tr>
            <td>Title</td>
            <td>Content</td>
            <td>Author</td>
        </tr>
    </thead>
    <tbody>
        <?php while ($topic = mysql_fetch_assoc($result)) : ?>
            <tr>
                <td><a href="topic.php?id=<?php echo $topic['id'] ?>"><?php echo $topic['title'] ?></a></td>
                <td><?php echo $topic['content'] ?></td>
                <td><?php echo $topic['user'] ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php include "holder/footer.php"; ?>