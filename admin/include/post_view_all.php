<? //Didn't reload when i put it after table
if (isset($_GET['delete'])) {
    $Id = $_GET['delete'];
    $Query = "DELETE FROM post " .
        "WHERE Id = $Id";
    $DeletePostQuery = $connection->query($Query);
    QueryTest($DeletePostQuery);
    //header("Location: {$_SERVER['PHP_SELF']}");
} ?>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Image</th>
            <th>Category</th>
            <!-- <th>Content</th> -->
            <th>Tags</th>
            <th>Status</th>
            <th>Comments</th>
            <th>Date Created</th>
            <th>Date Modified</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <? $Query = "SELECT * FROM post";
        $GetAllPostsQuery = mysqli_query($connection, $Query);
        while ($Post = mysqli_fetch_assoc($GetAllPostsQuery)) {
            $Id = $Post['Id'];
            $Title = $Post['Title'];
            $Author = $Post['Author'];
            $Image = $Post['Image'];
            $Query = "SELECT Title FROM category WHERE Id = {$Post['CategoryId']}";
            $GetCategoryTitleQuery = mysqli_query($connection, $Query);
            $Category = mysqli_fetch_array($GetCategoryTitleQuery)[0];
            $Content = $Post['Content'];
            $Tags = $Post['Tag'];
            $Status = $Post['Status'];
            $Comments = $Post['CommentCount'];
            $DateCreated = $Post['DateCreated'];
            if (!isset($Post['DateModified'])) {
                $DateModifed = '-';
            } else $DateModifed = $Post['DateModified'];
        ?>
            <tr>
                <td><?= $Id; ?></td>
                <td><?= $Title; ?></td>
                <td><?= $Author; ?></td>
                <td><img src="../img/<?= $Image; ?>" class="img-responsive" width="100"></td>
                <td><?= $Category; ?></td>
                <!-- <td><? //$Content; ?></td> -->
                <td><?= $Tags; ?></td>
                <td><?= $Status; ?></td>
                <td><?= $Comments; ?></td>
                <td><?= $DateCreated; ?></td>
                <td><?= $DateModifed; ?></td>
                <td><a href="post.php?source=edit_post&edit=<?= $Id; ?>">Edit</a></td>
                <td><a href="post.php?delete=<?= $Id; ?>">Delete</a></td>
            </tr>
        <? } ?>
    </tbody>
</table>