<?php
session_start();
include "db/db.php";
include "lib/utils.php";
$currentUser = isLogged();

$query = "Select T.*, U.username from topic T left join user U on U.id = T.user where T.is_published = 1";

$result = mysql_query($query) or trigger_error(mysql_error(), E_USER_ERROR);

$pageTitle = "Home";
include "holder/header.php";
?>
<table class="table striped hovered">
    <thead>
        <tr>
            <td>Title</td>
            <td>Preview</td>
            <td>Author</td>
        </tr>
    </thead>
    <tbody>
        <?php while ($topic = mysql_fetch_assoc($result)) : ?>
            <tr>
                <td><a href="topic.php?id=<?php echo $topic['id'] ?>"><?php echo $topic['title'] ?></a></td>
                <td>
                    <?php echo substr($topic['content'], 0, 120) ?>...
                    <a href="topic.php?id=<?php echo $topic['id'] ?>">Read More</a>
                </td>
                <td><?php echo $topic['username'] ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php include "holder/footer.php"; ?>