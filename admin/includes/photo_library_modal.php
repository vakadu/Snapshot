<?php require_once "init.php"; ?>

<?php $photos = Photo::find_all(); ?>

<!-- Modal -->
<div id="photo-library" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Gallery System Library</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-9">
                    <div class="thumbnail row">

                        <?php foreach ($photos as $photo) : ?>

                        <div class="col-xs-2">
                            <a role="checkbox" aria-checked="false" tabindex="0" id="" href="#"
                               class="thumbnail">
                                <img src="<?php echo $photo ->picture_path(); ?>"
                                     class="modal_thumbnails img-responsive" data="">
                            </a>
                            <div class="photo-id hidden"></div>
                        </div>

                        <?php endforeach; ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div id="modal_sidebar"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="set_user_image" type="button" class="btn btn-success" disabled="true"
                        data-dismiss="modal">Apply</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>