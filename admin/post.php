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

                <? if (isset($_GET['source'])) {
                    $Source = $_GET['source'];
                } else $Source = '';
                switch ($Source) {
                    case 'add_post':
                        include 'include/post_add.php';
                        break;
                    case 'edit_post':
                        include 'include/post_edit.php';
                        break;
                    default:
                        include 'include/post_view_all.php';
                } ?>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<!-- TinyMCE -->
<!-- <script src="https://cdn.tiny.cloud/1/pm5bfzs2qoq5p6jejf8v20nosmy3gq95sglvefbn85jy4k92/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.mytextarea',
        plugins: 'link',
        force_br_newlines: true,
        force_p_newlines: false,
        gecko_spellcheck: true,
        remove_linebreaks: false
    });
</script> -->
<? include 'include/footer.php';
