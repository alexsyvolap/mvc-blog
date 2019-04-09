<?php require dirname(__DIR__) . '/layouts/header.php' ?>

<div class="card mb-2" data-id="<?php print $post['id'] ?>">
    <div class="card-header">
        <span id="title" class="mr-2">
            <?php print $post['title'] ?>
        </span>
        <span class="float-right">
            <i class="fa fa-edit mr-2"></i>
            <i class="fa fa-trash"></i>
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

<div class="card">
    <div class="card-header">
        <span id="commentTitle" class="mr-2">
            <?php print \App\Lang::getRu()['posts']['field']['comments'] ?>
        </span>
    </div>
    <div class="card-body">
        <?php require dirname(__DIR__) . '/partials/commentForm.php' ?>
        <hr>
    </div>
</div>

<?php require dirname(__DIR__) . '/layouts/footer.php' ?>
