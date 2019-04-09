<span id="commentsCount">
    <?php print_r(\App\Lang::getRu()['posts']['field']['commentsCount']
        . ': ' . \App\Models\Post::getPostCommentCount($post['id'])) ?>
</span>