<?php
if (isset($_GET['edit'])) {
    $PostId = $_GET['edit'];
    $Query = "SELECT * FROM post WHERE Id = $PostId";
    $GetPostById = $connection->query($Query);
    $Post = $GetPostById->fetch_assoc();

    if (isset($_POST['update_post'])) {
        $CategoryId   = $_POST['category'];
        $Title        = $_POST['title'];
        //    $User         = $_POST['user'];
        $Author       = $_POST['author'];
        $Image        = $_FILES['image']['name'];
        $ImageTemp    = $_FILES['image']['tmp_name'];
        $Content      = $_POST['content'];
        $Tags         = $_POST['tags'];
        $Status       = $_POST['status'];

        !empty($CategoryId) ?: $Errors['Category'] = true;
        !empty($Title) ?: $Errors['Title'] = true;
        !empty($Author) ?: $Errors['Author'] = true;
        !empty($Content) ?: $Errors['Content'] = true;
        !empty($Tags) ?: $Errors['Tags'] = true;

        if (move_uploaded_file($ImageTemp, "../img/$Image")) {
        } else  $Errors['Image'] = true;

        if (!isset($Errors)) {
            $Query = "UPDATE post SET "
            . "CategoryId = $CategoryId, "
            . "Title = '$Title', "
            . "Author = '$Author', "
            . "Image = '$Image', "
            . "Content = '$Content', "
            . "Tag = '$Tags', "
            . "Status = '$Status', "
            . "DateModified = now()"
            . "WHERE Id = {$Post['Id']}";

            $UpdatePost = $connection->query($Query);
            if ($UpdatePost) {
                echo '<p class="text-success">Post updated.</p>';
            }
            QueryTest($UpdatePost);
        }
    }
?>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="<?= $Post['Title']?>">
            <? IsInsertPostError('Title', "Enter Title."); ?>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select name="category" id="">
                <? $Query = "SELECT * FROM category;";
                $GetAllCategoryTitlesQuery = $connection->query($Query);
                while ($Category = $GetAllCategoryTitlesQuery->fetch_assoc()) {
                    $Id = $Category['Id'];
                    $Title =  $Category['Title']; ?>
                    <option value="<?= $Id; ?>" <?= !($Id == $Post['Id'])?: 'selected';?> ><?= $Title; ?></option>
                <? } ?>
            </select>
            <? IsInsertPostError('Category', "Choose category."); ?>
        </div>

        <div class="form-group">
            <label for="title">Author</label>
            <input type="text" class="form-control" name="author" value="<?= $Post['Author'];?>">
            <? IsInsertPostError('Author', "Enter author name."); ?>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="">
                <option value="draft" <?= !($Post['Status'] == "draft")?: 'selected';?>>Draft</option>
                <option value="published" <?= !($Post['Status'] == "published")?: 'selected';?>>Published</option>
            </select>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image">
            <? IsInsertPostError('Image', "Image couldn't be uploaded."); ?>
        </div>

        <div class="form-group">
            <img src="../img/<?= $Post['Image']?>" class="img-responsive" width="125">
        </div>

        <div class="form-group">
            <label for="tags">Tags</label>
            <input type="text" class="form-control" name="tags" value="<?= $Post['Tag'];?>">
            <? IsInsertPostError('Tags', "Enter tag(s), seperated by \" , \"."); ?>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control mytextarea" name="content" id="" cols="30" rows="10"><?= $Post['Content'];?></textarea>
            <? IsInsertPostError('Content', "Enter some text."); ?>
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="update_post" value="update_post">
        </div>
    </form>
<? } ?>