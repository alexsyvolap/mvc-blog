<!-- Modal Error -->
<div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="errorCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLongTitle"><?php print \App\Lang::getRu()['posts']['modal']['error'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Произошла ошибка при запросе к серверу!
                <div class="error-description">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?php print \App\Lang::getRu()['posts']['action']['close'] ?></button>
            </div>
        </div>
    </div>
</div>