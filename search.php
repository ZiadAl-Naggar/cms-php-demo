<?php
include 'include/db.php';
include 'include/header.php';

if (isset($_POST['search'])) {
    $Search = $_POST['search-field'];
    $Query = "SELECT * FROM post ";
    $Query .= "WHERE Tag LIKE '%$Search%' OR Title LIKE '%$Search%' OR Content LIKE '%$Search%' OR Author LIKE '%$Search%' OR DateCreated LIKE '%$Search%' OR DateModified LIKE '%$Search%';";
    $SearchQuery = mysqli_query($connection, $Query);
    $SearchResultCount = mysqli_num_rows($SearchQuery);

    if (!$SearchQuery) {
        die('Search Query Faild!<br>' . mysqli_error($connection));
    }
} ?>

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
            <? if($SearchResultCount == 0){
            echo 'No Posts about "' . $Search . '" have been found :(';
            } else {
            while($Post = mysqli_fetch_assoc($SearchQuery)) {
            $Title = $Post['Title'];
            $Author = $Post['Author'];
            $Content = $Post['Content'];
            $Image = $Post['Image']; ?>
            <h2><a href='#'><?= $Title; ?></a></h2>
            <p class='lead'>by <a href='index.php'><?= $Author; ?></a></p>
            <? isset($Post['DateModified'])? $Date = $Post['DateModified'] : $Date = $Post['DateCreated'];?>
            <p><span class='glyphicon glyphicon-time'></span><?= $Date; ?></p>
            <hr>
            <img class='img-responsive' src='img/<?= $Image; ?>' alt=''>
            <hr>
            <p><?= $Content; ?></p>
            <a class='btn btn-primary' href='#'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
            <hr>
            <? }
        }?>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include 'include/sidebar.php'; ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include 'include/footer.php'; ?>