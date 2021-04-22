<?php
include_once 'include/db.php';
include 'include/header.php';

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
            while($Post = mysqli_fetch_assoc($PostQuery)) {
                $Title = $Post['Title'];
                $Author = $Post['Author'];
                $Content = $Post['Content'];
                $Image = $Post['Image']; ?>
            <h2><a href='#'><?= $Title; ?></a></h2>
            <p class='lead'>by <a href='index.php'><?= $Author; ?></a></p>
            <? isset($Post['DateModified'])? $Date = $Post['DateModified'] : $Date = $Post['DateCreated'];?>
            <p><span class='glyphicon glyphicon-time'></span><?= $Date; ?></p>
            <hr>
            <img class='img-responsive' src='img/<?=$Image;?>' alt=''>
            <hr>
            <p><?= $Content; ?></p>
            <a class='btn btn-primary' href='#'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
            <hr>
            <? }?>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include 'include/sidebar.php'; ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include 'include/footer.php'; ?>