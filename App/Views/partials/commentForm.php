<form method="POST" action='/news/<?php print $post['id']?>/comment'>

    <div class="row justify-content-center mb-2">
        <div class="col-md-6">
            <label for="mail"><?php print \App\Lang::getRu()['posts']['field']['mail'] ?></label>
            <input id="mail" type="email" name="mail" class="form-control">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <label for="comment"><?php print \App\Lang::getRu()['posts']['field']['comment'] ?></label>
            <textarea id="comment" name="comment" class="form-control"></textarea>
        </div>
    </div>
    <div class="row offset-md-3 mt-2">
        <button type="submit" class="btn btn-success"><?php print \App\Lang::getRu()['posts']['action']['send'] ?></button>
    </div>

</form>