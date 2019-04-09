<?php require dirname(__DIR__) . '/layouts/header.php' ?>

<p>
    <a href="/news/create" class="btn btn-success">
        <?php print \App\Lang::getRu()['posts']['action']['createPost'] ?>
    </a>
</p>

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

<?php require dirname(__DIR__) . '/layouts/footer.php' ?>
