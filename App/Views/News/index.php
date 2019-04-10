<?php require dirname(__DIR__) . '/layouts/header.php' ?>
<?php require dirname(__DIR__) . '/partials/modals/error.php' ?>

<p>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createPost">
        <?php print \App\Lang::getRu()['posts']['action']['createPost'] ?>
    </button>
    <?php require dirname(__DIR__) . '/partials/modals/createPost.php' ?>
</p>

<div class="posts">
    <?php foreach ($posts as $post) { ?>
        <div class="card mb-2" data-id="<?php print $post['id'] ?>">
            <div class="card-header">
                <span id="title" class="mr-2">
                    <a href="<?php print '/news/' . $post['id'] ?>">
                        <?php print $post['title'] ?>
                    </a>
                </span>
                <?php require dirname(__DIR__) . '/partials/status.php' ?>
            </div>
            <div class="card-body">
                <p id="content">
                    <?php print $post['content'] ?>
                </p>
                <?php require dirname(__DIR__) . '/partials/tags.php' ?>
                <br>
                <?php require dirname(__DIR__) . '/partials/commentCount.php' ?>
            </div>
        </div>
    <?php } ?>
</div>

<?php require dirname(__DIR__) . '/layouts/footer.php' ?>
