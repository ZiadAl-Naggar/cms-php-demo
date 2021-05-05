<?php
function QueryTest($Query) {
    global $connection;
    if (!$Query) {
        die("Query $Query Faild!<br>" . mysqli_error($connection));
    }
}

function WarningMessage($Message) {
    echo "<div class='alert alert-danger mt10' role='alert'>$Message</div>";
}

function IsInsertPostError($Check, $Message) {
    global $Errors;
    !isset($Errors[$Check])?: WarningMessage($Message);
}

// Category:
function InsertCategory()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $Title = $_POST['category-title'];
        if (empty($Title)) {
            echo 'Please, type a valid category name!';
        } else {
            $Query = "SELECT * FROM category";
            $ValidateCategoryQuery = mysqli_query($connection, $Query);
            $CategoryExist = false;
            while ($Category = mysqli_fetch_assoc($ValidateCategoryQuery)) {
                if ($Title == $Category['Title']) {
                    $Id = $Category['Id'];
                    echo "Category '$Title' already exists! with ID of '$Id'";
                    $CategoryExist = true;
                }
            }
            if (!$CategoryExist) {
                $Query = "INSERT INTO category(Title) VALUE('$Title')";
                $AddCategoryQuery = mysqli_query($connection, $Query);
                echo '<p class="text-success">Category is added successfully.</p>';
                if (!$connection) {
                    die('Faild to add category!<br>' . mysqli_error($connection));
                }
            }
        }
    }
}

function DeleteCategory()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $Id = $_GET['delete'];
        $Title = $_GET['title'];
        $Query = "DELETE FROM category WHERE Id = $Id";
        $DeleteCategoryQuery = mysqli_query($connection, $Query);
        // header("Location: category.php");
        echo "Category '$Title' is Deleted.";
        if (!$DeleteCategoryQuery) {
            die('Delete Category Query Faild!<br>' . mysqli_error($connection));
        }
    }
}

function UpdateCategory()
{
    global $connection;
    if(isset($_GET['edit'])){
        $Id = $_GET['edit'];
        $Title = $_GET['title'];?>
        <form action="" method="post">
            <form-group>
                <label for="">Edit Category</label>
                <input class="form-control" type="text" name="category-title" value="<?= $Title; ?>">
            </form-group>
            <br>
            <form-group>
                <input class="btn btn-primary" type="submit" name="update" value="Update Category">
            </form-group>
        </form>
        <? if(isset($_POST['update'])){
            $NewTitle = $_POST['category-title'];
            if(trim($NewTitle) != $Title){
            $Query = "UPDATE category SET Title = '$NewTitle' WHERE Id = $Id";
            $UpdateCategoryQuery = mysqli_query($connection, $Query);
            if (!$UpdateCategoryQuery) {
                die('Update Category Query Faild!<br>' . mysqli_error($connection));
            }
            echo "Category '$Id' upadted successfully.";
        } else echo 'Nothing to update!';
        }
    }
}

function SetCategoryTable()
{
    global $connection;
    $Query = "SELECT * FROM category";
    $GetAllCategoriesQuery = mysqli_query($connection, $Query);
    while($Category = mysqli_fetch_assoc($GetAllCategoriesQuery)){
        $Id = $Category['Id'];
        $Title = $Category['Title'];?>
        <tr>
            <td><?= $Id; ?></td>
            <td><?= $Title; ?></td>
            <td><a href="category.php?edit=<?= $Id; ?>&title=<?= $Title; ?>">Edit</a></td>
            <td><a href="category.php?delete=<?= $Id; ?>&title=<?= $Title; ?>">Delete</a></td>
        </tr>
    <?php }
}