<?php require dirname(__DIR__) . '/layouts/header.php' ?>
<?php require dirname(__DIR__) . '/partials/modals/editPost.php' ?>
<?php require dirname(__DIR__) . '/partials/modals/deletePost.php' ?>
<?php require dirname(__DIR__) . '/partials/modals/error.php' ?>

<div class="card mb-2 post" data-id="<?php print $post['id'] ?>">
    <div class="card-header">
        <span id="title" class="mr-2">
            <?php print $post['title'] ?>
        </span>
        <span class="float-right">
            <i class="fa fa-image mr-2 add-image-post" data-toggle="modal" data-target="#addImagePost"></i>
            <i class="fa fa-edit mr-2 edit-post" data-toggle="modal" data-target="#editPost"></i>
            <i class="fa fa-trash delete-post" data-toggle="modal" data-target="#deletePost"></i>
        </span>
        <?php require dirname(__DIR__) . '/partials/status.php' ?>
    </div>
    <div class="card-body">
        <p id="content">
            <?php print $post['content'] ?>
        </p>
        <?php require dirname(__DIR__) . '/partials/tags.php' ?>
    </div>
</div>


<div class="">
    <div class="card-header mb-2 commentSection">
    <span id="commentTitle" class="mr-2">
        <?php print \App\Lang::getRu()['posts']['field']['comments'] ?>:
    </span>
        <span id="commentCount"><?php print \App\Models\Post::getPostCommentCount($post['id']) ?></span>
    </div>
    <div class=" commentBody">
        <?php require dirname(__DIR__) . '/partials/comments.php' ?>
    </div>
    <?php if($post['status'] != \App\Models\Post::STATUS_CLOSED) { ?>
        <hr>
        <?php require dirname(__DIR__) . '/partials/commentForm.php' ?>
    <?php } ?>
</div>


<?php require dirname(__DIR__) . '/layouts/footer.php' ?>
