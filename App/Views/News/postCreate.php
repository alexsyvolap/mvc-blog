<?php require dirname(__DIR__) . '/layouts/header.php' ?>

<form method="POST" action="">

    <div class="row justify-content-center mb-2">
        <div class="col-md-6">
            <label for="title"><?php print \App\Lang::getRu()['posts']['field']['title'] ?></label>
            <input id="title" type="text" name="title" class="form-control">
        </div>
    </div>
    <div class="row justify-content-center mb-2">
        <div class="col-md-6">
            <label for="status"><?php print \App\Lang::getRu()['posts']['field']['status'] ?></label>
            <select id="status" name="status" class="form-control">
                <option></option>
                <?php foreach (\App\Models\Post::getStatuses() as $status) { ?>
                    <option value="<?php print $status['value'] ?>"><?php print $status['lang'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="row justify-content-center mb-2">
        <div class="col-md-6">
            <label for="content"><?php print \App\Lang::getRu()['posts']['field']['content'] ?></label>
            <textarea id="content" name="content" class="form-control"></textarea>
        </div>
    </div>
    <div class="row justify-content-center mb-2">
        <div class="col-md-6">
            <label for="tags"><?php print \App\Lang::getRu()['posts']['field']['tags'] ?></label>
            <input id="tags" type="text" name="tags" class="form-control">
        </div>
    </div>
    <div class="row offset-md-3 mt-2">
        <button type="submit" class="btn btn-success"><?php print \App\Lang::getRu()['posts']['action']['create'] ?></button>
    </div>

</form>

<?php require dirname(__DIR__) . '/layouts/footer.php' ?>
