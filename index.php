<?php
include_once 'include/db.php';
include 'include/header.php';
include 'include/function.php';

$Query = "SELECT * FROM post;";
$PostQuery = mysqli_query($connection, $Query);
?>

<!-- Navigation -->
<?php include 'include/navigation.php'; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <?
            while ($Post = mysqli_fetch_assoc($PostQuery)) {
                $Id = $Post['Id'];
                $Title = $Post['Title'];
                $Author = $Post['Author'];
                $Content = substr($Post['Content'], 0, 250);
                $Image = $Post['Image'];
                $Date = DateFormat($Post['DateCreated']);
                is_null($Post['DateModified']) ?: $DateUpdated = DateFormat($Post['DateModified']); ?>
                <h2><a href='post.php?post=<?= $Id ?>'><?= $Title; ?></a></h2>
                <p class='lead'>by <a href='index.php'><?= $Author; ?></a></p>
                <p><span class='glyphicon glyphicon-time'></span>
                <?= isset($DateUpdated)? ' ' . $DateUpdated : ' ' . $Date; ?></p>
                <hr>
                <img class='img-responsive' src='img/<?= $Image; ?>' alt=''>
                <hr>
                <p><?= $Content .' ...'; ?></p>
                <a class='btn btn-primary' href='post.php?post=<?= $Id ?>'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
                <hr>
            <? } ?>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include 'include/sidebar.php'; ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include 'include/footer.php'; ?>