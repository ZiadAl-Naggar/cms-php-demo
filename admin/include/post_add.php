<?php
//Start using mysqli in oop, next step to use PDO as it supports more database 
if (isset($_POST['create_post'])) {
    $CategoryId   = $_POST['category'];
    $Title        = $_POST['title'];
    //    $User         = $_POST['user'];
    $Author       = $_POST['author'];
    $Image        = $_FILES['image']['name'];
    $ImageTemp    = $_FILES['image']['tmp_name'];
    $Content      = $_POST['content'];
    $Tags         = $_POST['tags'];
    $Status       = $_POST['status'];
    $Date         = date('d-m-y');

    !empty($CategoryId) ?: $Errors['Category'] = true;
    !empty($Title) ?: $Errors['Title'] = true;
    !empty($Author) ?: $Errors['Author'] = true;
    !empty($Content) ?: $Errors['Content'] = true;
    !empty($Tags) ?: $Errors['Tags'] = true;

    if (move_uploaded_file($ImageTemp, "../img/$Image")) {
    } else  $Errors['Image'] = true;

    if (!isset($Errors)) {
        $Query = "INSERT INTO post(CategoryId, Title, Author, Image, Content, Tag, Status, DateCreated) ";
        $Query .= "VALUES ($CategoryId, '$Title', '$Author', '$Image', '$Content', '$Tags', '$Status', now())";

        $SubmitPost = $connection->query($Query);
        if ($SubmitPost) {
            echo '<p class="text-success">Post submitted.</p>';
        }
        QueryTest($SubmitPost);
    }
} ?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title">
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
                <option value="<?= $Id; ?>"><?= $Title; ?></option>
            <? } ?>
        </select>
        <? IsInsertPostError('Category', "Choose category."); ?>
    </div>

    <div class="form-group">
        <label for="title">Author</label>
        <input type="text" class="form-control" name="author">
        <? IsInsertPostError('Author', "Enter author name."); ?>
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="">
            <option value="draft">Draft</option>
            <option value="published">Publish</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image">
        <? IsInsertPostError('Image', "Image couldn't be uploaded."); ?>
    </div>

    <div class="form-group">
        <label for="tags">Tags</label>
        <input type="text" class="form-control" name="tags">
        <? IsInsertPostError('Tags', "Enter tag(s), seperated by \" , \"."); ?>
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control mytextarea" name="content" id="" cols="30" rows="10"></textarea>
        <? IsInsertPostError('Content', "Enter some text."); ?>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>