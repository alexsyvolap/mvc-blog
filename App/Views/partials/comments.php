<?php foreach ($comments as $comment) { ?>
    <div class="card mb-2" data-id="<?php print $comment['id'] ?>">
        <div class="card-header">
            <?php print $comment['email'] ?>
        </div>
        <div class="card-body">
            <?php print $comment['content'] ?>
        </div>
    </div>
<?php } ?>