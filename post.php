<?php
include_once 'include/db.php';
include 'include/header.php';
include 'include/function.php';
?>

<!-- Navigation -->
<?php include 'include/navigation.php'; ?>

<? if(isset($_GET['post'])) {
    $PostId = $_GET['post'];
    $Query = "SELECT * FROM post WHERE Id = $PostId";
    $GetPostQuery = $connection->query($Query);
    $Post = $GetPostQuery->fetch_assoc();
    $Date = DateFormat($Post['DateCreated']);
    is_null($Post['DateModified']) ?: $DateUpdated = DateFormat($Post['DateModified']);
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- Post -->
            <h2><?= $Post['Title']; ?></h2>
            <p class='lead'>by <a href='index.php'><?= $Post['Author']; ?></a></p>
            <!-- <p><span class="glyphicon glyphicon-time"></span>  "Posted on August 24, 2013 at 9:00 PM</p> -->
            <? //isset($Post['DateModified'])? $Date = $Post['DateModified'] : $Date = $Post['DateCreated'];?>
            <p><span class='glyphicon glyphicon-time'></span>
            <?= isset($DateUpdated)? 'Updated on ' . $DateUpdated : ' Pulished at ' . $Date; ?></p>
            <hr>
            <img class='img-responsive' src='img/<?=$Post['Image'];?>' alt=''>
            <hr>
            <p><?= $Post['Content']; ?></p>
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