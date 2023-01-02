<?php defined( 'ABSPATH' ) or die( 'I can\'t do anything alone! Sorry!' ); ?>

<form id="ns-airport-transfer-form" action="<?=get_permalink()?>" class="form-horizontal" method="post" accept-charset="utf-8">
<noscript><?php esc_html_e( 'Javascript must be enabled!', 'ns-airport-transfers' ); ?></noscript><br><br>
<input type="hidden" id="resort" value="<?=$params['resort']?>">
<input type="hidden" id="time_format" value="<?=$params['time-format']?>">

  <h4 class="text-success"><?php esc_html_e( 'Information about you', 'ns-airport-transfers' ); ?></h4>

  <div class="form-group">
    <label class="col-sm-4 col-xs-12 control-label"><?php esc_html_e( 'Your name', 'ns-airport-transfers' ); ?><span class="text-danger">*</span></label>
      <div class="col-sm-8 col-xs-12">
        <input type="text" id="name" class="form-control" value="" placeholder="">
      </div>
  </div>
  <div class="clear"><br></div>
  <div class="form-group">
      <label class="col-sm-4 col-xs-12 control-label"><?php esc_html_e( 'Email address', 'ns-airport-transfers' ); ?><span class="text-danger">*</span></label>
      <div class="col-sm-8 col-xs-12">
        <input type="text" id="email" class="form-control" value="" placeholder="">
        <span class="explanation">(<?php esc_html_e( 'On this Email you will recieve confirmation', 'ns-airport-transfers' ); ?>)</span>
      </div>
  </div>
  <div class="clear"></div>
  <div class="form-group">
      <label class="col-sm-4 col-xs-12 control-label"><?php esc_html_e( 'Mobile', 'ns-airport-transfers' ); ?><span class="text-danger">*</span></label>
      <div class="col-sm-8 col-xs-12">
        <input type="text" id="phone" class="form-control" value="" placeholder="">
        <span class="explanation">(<?php esc_html_e( 'It\'s mandatory to input your phone number', 'ns-airport-transfers' ); ?>)</span>
      </div>
  </div>
  <div class="clear"></div>
  <div class="form-group">
      <label class="col-sm-4 col-xs-12 control-label"><?php esc_html_e( 'I would like to', 'ns-airport-transfers' ); ?>:<span class="text-danger">*</span></label>
      <div class="col-sm-8 col-xs-12">
        <input type="radio" name="like_to" value="<?php esc_html_e( 'Make reservation', 'ns-airport-transfers' ); ?>" checked> <?php esc_html_e( 'Make reservation', 'ns-airport-transfers' ); ?><br>
        <input type="radio" name="like_to" value="<?php esc_html_e( 'Request more information', 'ns-airport-transfers' ); ?>"> <?php esc_html_e( 'Request more information', 'ns-airport-transfers' ); ?>
      </div>
  </div><hr>
  <div class="clear"></div>
  <div class="form-group">
      <label class="col-sm-4 col-xs-12 control-label"><?php esc_html_e( 'Transfer type', 'ns-airport-transfers' ); ?><span class="text-danger">*</span></label>
      <div class="col-sm-8 col-xs-12">
        <select id="transfer_type" class="form-control">
          <option value="two_way"><?php esc_html_e( 'Two way', 'ns-airport-transfers' ); ?></option>
          <option value="from_airport"><?php esc_html_e( 'One way', 'ns-airport-transfers' ); ?> (<?php esc_html_e( 'From airport', 'ns-airport-transfers' ); ?>)</option>
          <option value="to_airport"><?php esc_html_e( 'One way', 'ns-airport-transfers' ); ?> (<?php esc_html_e( 'To airport', 'ns-airport-transfers' ); ?>)</option>
        </select>
      </div>
  </div>
  <div class="clear"></div><br>
  <div class="form-group">
      <label class="col-md-4 col-sm-4 col-xs-12 control-label"><?php esc_html_e( 'No. of adults', 'ns-airport-transfers' ); ?><span class="text-danger">*</span></label>
      <div class="col-md-2 col-sm-2 col-xs-4">
        <input type="text" id="adults" class="form-control" value="" placeholder="">
      </div>

      <label class="col-md-3 col-sm-4 col-xs-12 control-label"><?php esc_html_e( 'No. of children', 'ns-airport-transfers' ); ?><span class="text-danger">*</span></label>
      <div class="col-md-2 col-sm-2 col-xs-4">
        <input type="text" id="children" class="form-control" value="" placeholder="">
      </div>
  </div>
  <div class="clear"></div><br>
  <div class="form-group">
      <label class="col-md-4 col-sm-4 col-xs-12 control-label"><?php esc_html_e( 'No. of koffers', 'ns-airport-transfers' ); ?><span class="text-danger">*</span></label>
      <div class="col-md-2 col-sm-2 col-xs-4">
        <input type="text" id="koffers" class="form-control" value="" placeholder="">
      </div>

      <?php if(strtolower($params['resort'])==='winter') : ?>
      <label class="col-md-3 col-sm-4 col-xs-12 control-label"><?php esc_html_e( 'No. of ski/snowboards', 'ns-airport-transfers' ); ?><span class="text-danger">*</span></label>
      <div class="col-md-2 col-sm-2 col-xs-4">
        <input type="text" id="ski" class="form-control" value="" placeholder="">
      </div>
      <?php endif; ?>
  </div>
  <div class="clear"></div><hr>

  <div id="arrival">
    <h4><span class="text-success"><?php esc_html_e( 'After arrival', 'ns-airport-transfers' ); ?></span> <span class="small">(<?php esc_html_e( 'From airport', 'ns-airport-transfers' ); ?>)</span></h4>

    <div class="form-group">
        <label class="col-sm-4 col-xs-12 control-label"><?php esc_html_e( 'Date of arrival', 'ns-airport-transfers' ); ?><span class="text-danger">*</span></label>
        <div class="col-sm-3 col-xs-4">
          <input type="text" id="arrival_date" value="" class="date form-control" placeholder="">
        </div>
    </div>
    <div class="clear"></div><br>
    <div class="form-group">
        <label class="col-sm-4 col-xs-12 control-label"><?php esc_html_e( 'Time of arrival', 'ns-airport-transfers' ); ?><span class="text-danger">*</span></label>
        <div class="col-sm-3 col-xs-4">
          <select id="arrival_hour" class="form-control">
            <option value="-"><?php esc_html_e( 'Hour', 'ns-airport-transfers' ); ?></option>
            <?php foreach ($hours as $hour) : ?>
            <option value="<?=$hour?>"><?=$hour?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-sm-3 col-xs-4">
          <select id="arrival_minutes" class="form-control">
            <option value="-"><?php esc_html_e( 'Min', 'ns-airport-transfers' ); ?></option>
            <?php foreach ($minutes as $minute) : ?>
            <option value="<?=$minute?>"><?=$minute?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-sm-2 col-xs-4">
          <?php if($am_pm!==FALSE) : ?>
          <select id="arrival_us_time" class="form-control">
            <?=$am_pm?>
          </select>
          <?php endif; ?>
        </div>
    </div>
    <div class="clear"></div><br>
    <div class="form-group">
        <label class="col-sm-4 col-xs-12 control-label"><?php esc_html_e( 'Airport', 'ns-airport-transfers' ); ?><span class="text-danger">*</span></label>
        <div class="col-sm-6 col-xs-12">
          <select id="arrival_airport" class="form-control">
            <option value="-"><?php esc_html_e( 'select', 'ns-airport-transfers' ); ?></option>
            <?php foreach ($options as $option) : ?>
            <option value="<?=$option?>"><?=$option?></option>
            <?php endforeach; ?>
          </select>
        </div>
    </div>
    <div class="clear"></div><br>
    <div class="form-group">
        <label class="col-sm-4 col-xs-12 control-label"><?php esc_html_e( 'Flight number', 'ns-airport-transfers' ); ?><span class="text-danger">*</span></label>
        <div class="col-sm-6 col-xs-12">
          <input type="text" class="form-control" id="arrival_flight" value="" placeholder="">
        </div>
    </div>
    <div class="clear"></div><br>
  </div>

  <div id="departure">
    <h4><span class="text-success"><?php esc_html_e( 'Leaving', 'ns-airport-transfers' ); ?></span> <span class="small">(<?php esc_html_e( 'To airport', 'ns-airport-transfers' ); ?>)</span></h4>

    <div class="form-group">
        <label class="col-sm-4 col-xs-12 control-label"><?php esc_html_e( 'Date of departure', 'ns-airport-transfers' ); ?><span class="text-danger">*</span></label>
        <div class="col-sm-3 col-xs-4">
          <input type="text" id="out_date" value="" class="date form-control" placeholder="">
        </div>
    </div>
    <div class="clear"></div><br>
    <div class="form-group">
        <label class="col-sm-4 col-xs-12 control-label"><?php esc_html_e( 'Time of departure', 'ns-airport-transfers' ); ?><span class="text-danger">*</span></label>
        <div class="col-sm-3 col-xs-4">
          <select id="out_hour" class="form-control">
            <option value="-"><?php esc_html_e( 'Hour', 'ns-airport-transfers' ); ?></option>
            <?php foreach ($hours as $hour) : ?>
            <option value="<?=$hour?>"><?=$hour?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-sm-3 col-xs-4">
          <select id="out_minutes" class="form-control">
            <option value="-"><?php esc_html_e( 'Min', 'ns-airport-transfers' ); ?></option>
            <?php foreach ($minutes as $minute) : ?>
            <option value="<?=$minute?>"><?=$minute?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-sm-2 col-xs-4">
          <?php if($am_pm!==FALSE) : ?>
          <select id="out_us_time" class="form-control">
            <?=$am_pm?>
          </select>
          <?php endif; ?>
        </div>
    </div>
    <div class="clear"></div><br>
    <div class="form-group">
        <label class="col-sm-4 col-xs-12 control-label"><?php esc_html_e( 'Airport', 'ns-airport-transfers' ); ?><span class="text-danger">*</span></label>
        <div class="col-sm-6 col-xs-12">
          <select id="out_airport" class="form-control">
            <option value="-"><?php esc_html_e( 'select', 'ns-airport-transfers' ); ?></option>
            <?php foreach ($options as $option) : ?>
            <option value="<?=$option?>"><?=$option?></option>
            <?php endforeach; ?>
          </select>
        </div>
    </div>
    <div class="clear"></div><br>
    <div class="form-group">
        <label class="col-sm-4 col-xs-12 control-label"><?php esc_html_e( 'Flight number', 'ns-airport-transfers' ); ?><span class="text-danger">*</span></label>
        <div class="col-sm-6 col-xs-12">
          <input type="text" id="out_flight" class="form-control" value="" placeholder="">
        </div>
    </div>
    <div class="clear"></div><br>
  </div>

  <div class="clear"></div><hr>

  <h4 class="text-success"><?php esc_html_e( 'Address in', 'ns-airport-transfers' ); ?> <?php esc_html_e( get_option('ns-airport-transfers-country'))?></h4>

  <div class="clear"></div>

  <div class="form-group">
    <label class="col-md-4 col-sm-12 col-xs-12"><?php esc_html_e( 'Address of hotel/accommodation', 'ns-airport-transfers' ); ?>: <span class="text-danger">*</span></label>
    <div class="col-md-8 col-sm-12 col-xs-12">
      <textarea id="adress" class="form-control" rows="2" placeholder=""></textarea>
    </div>
  </div>

  <div class="clear"></div><br>

  <div class="form-group">
    <label class="col-md-4 col-sm-12 col-xs-12"><?php esc_html_e( 'Remarks/instructions', 'ns-airport-transfers' ); ?>:</label>
    <div class="col-md-8 col-sm-12 col-xs-12">
      <textarea id="instructions" class="form-control" rows="2" placeholder=""></textarea>
    </div>
  </div>
  <br><br>
  <div id="submit" class="btn btn-default"><?php esc_html_e( 'Send', 'ns-airport-transfers' ); ?></div>

</form>

<?php if($params['show-contacts']==='1') : ?>
<div class="clear"></div><br>
<i><?php
    printf(
        esc_html__( 'If you need transfer from airport to another destination, wich is not specified please call us at %s or send an e-mail to %s' ),
        get_option( 'ns-airport-transfers-contact-phone' ),
        get_option( 'ns-airport-transfers-contact-email' )
    ); ?></i>
<?php endif; ?>
