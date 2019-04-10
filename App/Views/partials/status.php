<?php if($post['status'] == \App\Models\Post::STATUS_NEW) { ?>
    <span id="status" class="badge badge-primary">
        <?php print \App\Lang::getRu()['posts']['status']['new'] ?>
    </span>
<?php } elseif ($post['status'] == \App\Models\Post::STATUS_OPEN) { ?>
    <span id="status" class="badge badge-success">
        <?php print \App\Lang::getRu()['posts']['status']['open'] ?>
    </span>
<?php } elseif ($post['status'] == \App\Models\Post::STATUS_CLOSED) { ?>
    <span id="status" class="badge badge-danger">
        <?php print \App\Lang::getRu()['posts']['status']['closed'] ?>
    </span>
<?php } ?>