<?php
include 'include/header.php';
include 'include/navigation.php';
?>


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome Admin
                    <small>Author</small>
                </h1>

                <div class="col-xs-6">
                    <form action="category.php" method="post">
                        <form-group>
                            <label for="">Add Category</label>
                            <input class="form-control" type="text" name="category-title">
                        </form-group>
                        <br>
                        <form-group>
                            <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                        </form-group>
                    </form>
                    <br>
                    <? InsertCategory();?>
                    <? DeleteCategory();?>
                    <? UpdateCategory();?>
                </div>

                <div class="col-xs-6">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <? SetCategoryTable();?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<? include 'include/footer.php';