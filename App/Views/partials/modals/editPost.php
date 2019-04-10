<!-- Modal Create -->
<div class="modal fade" id="editPost" tabindex="-1" role="dialog" aria-labelledby="editPostCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPostModalLongTitle"><?php print \App\Lang::getRu()['posts']['modal']['editPost'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editPostForm" method="POST" action="">

                    <div class="row justify-content-center mb-2">
                        <div class="col-md-12">
                            <label for="titleModal"><?php print \App\Lang::getRu()['posts']['field']['title'] ?></label>
                            <input id="titleModal" type="text" name="titleModal" class="form-control" value="<?php print $post['title'] ?>">
                        </div>
                    </div>
                    <div class="row justify-content-center mb-2">
                        <div class="col-md-12">
                            <label for="statusModal"><?php print \App\Lang::getRu()['posts']['field']['status'] ?></label>
                            <select id="statusModal" name="statusModal" class="form-control">
                                <?php foreach (\App\Models\Post::getStatuses() as $status) { ?>
                                    <option value="<?php print $status['value'] ?>" <?php if($status['value'] == $post['status'] ? print ' selected ' : print '') ?>>
                                        <?php print $status['lang'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-2">
                        <div class="col-md-12">
                            <label for="contentModal"><?php print \App\Lang::getRu()['posts']['field']['content'] ?></label>
                            <textarea id="contentModal" name="contentModal" class="form-control"><?php print $post['content'] ?></textarea>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-2">
                        <div class="col-md-12">
                            <label for="tagsModal"><?php print \App\Lang::getRu()['posts']['field']['tags'] ?></label>
                            <input id="tagsModal" type="text" name="tagsModal" class="form-control" value="<?php print $post['tags'] ?>">
                        </div>
                    </div>

                    <div class="mt-2">
                        <button id="editPostButton" type="button" class="btn btn-primary"><?php print \App\Lang::getRu()['posts']['action']['edit'] ?></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php print \App\Lang::getRu()['posts']['action']['close'] ?></button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>