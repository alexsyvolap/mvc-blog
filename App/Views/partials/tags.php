<span id="tags">
    <?php print \App\Lang::getRu()['posts']['field']['tags'] . ': ' ?>
    <?php foreach(\App\Helper::getTags($post['tags']) as $tag) { ?>
        <a href="#">
            <?php print $tag ?>
        </a>
    <?php } ?>
</span>