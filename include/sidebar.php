<div class="col-md-4">
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <!-- Search Form -->
        <form action="search.php" method="post">
            <div class="input-group">
                <input type="text" class="form-control" name="search-field">
                <span class="input-group-btn">
                    <button class="btn btn-default" name="search" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                <?php
                    $Query = "SELECT * FROM category LIMIT 6";
                    $GetAllCategoriesQuery = mysqli_query($connection, $Query);
                    while($Category = mysqli_fetch_assoc($GetAllCategoriesQuery)){
                        echo "<li><a href='#'>{$Category['Title']}</a></li>";
                    }
                ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <? include 'include/widget.php';?>

</div>