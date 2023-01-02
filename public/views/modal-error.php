<?php defined( 'ABSPATH' ) or die( 'I can\'t do anything alone! Sorry!' );
$modal = 'error';
?><div class="modal fade" id="modal-<?=$modal?>" tabindex="-1" role="dialog" aria-labelledby="modal-<?=$modal?>-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="<?php esc_html_e( 'Close', 'ns-airport-transfers' ); ?>"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal-error-title"><?php esc_html_e( 'Error', 'ns-airport-transfers' ); ?></h4>
      </div>
      <div class="modal-body">
        <div class="box box-danger">
          <div class="box-body">
            <div class="row">
              <div class="col-xs-12">
                <div id="modal-<?=$modal?>-message" class="error offset-top center"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="cancel" class="btn btn-default" data-dismiss="modal"><?php esc_html_e( 'Close', 'ns-airport-transfers' ); ?></button>
      </div>
    </div>
  </div>
</div>
