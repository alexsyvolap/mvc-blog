<!-- Modal Create -->
<div class="modal fade" id="createPost" tabindex="-1" role="dialog" aria-labelledby="createPostCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostModalLongTitle"><?php print \App\Lang::getRu()['posts']['modal']['createPost'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createPostForm" method="POST" action="" enctype="multipart/form-data">

                    <div class="row justify-content-center mb-2">
                        <div class="col-md-12">
                            <label for="title"><?php print \App\Lang::getRu()['posts']['field']['title'] ?></label>
                            <input id="title" type="text" name="title" class="form-control">
                        </div>
                    </div>
                    <div class="row justify-content-center mb-2">
                        <div class="col-md-12">
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
                        <div class="col-md-12">
                            <label for="content"><?php print \App\Lang::getRu()['posts']['field']['content'] ?></label>
                            <textarea id="content" name="content" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-2">
                        <div class="col-md-12">
                            <label for="tags"><?php print \App\Lang::getRu()['posts']['field']['tags'] ?></label>
                            <input id="tags" type="text" name="tags" class="form-control">
                        </div>
                    </div>

                    <div class="mt-2">
                        <button id="sendPost" type="button" class="btn btn-success"><?php print \App\Lang::getRu()['posts']['action']['create'] ?></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php print \App\Lang::getRu()['posts']['action']['close'] ?></button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>