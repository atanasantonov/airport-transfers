<?php defined( 'ABSPATH' ) or die( 'I can\'t do anything alone! Sorry!' ); ?>

<div class="wrap">
<h1>Airport Transfers</h1>
<p class="description"><span class="dashicons dashicons-admin-settings"></span> <?php esc_html_e('Styling and functionality settings','ns-airport-transfers'); ?>.</p>

<form method="post" action="options.php">
  <?php settings_fields( self::$settings ); ?>
  <?php do_settings_sections( self::$settings ); ?>

  <table class="form-table">

    <tr>
      <th scope="row"><?php esc_html_e('Admin email/emails','ns-airport-transfers'); ?></th>
      <td>
        <input type="text" name="ns-airport-transfers-admin-email" value="<?php echo esc_attr( get_option('ns-airport-transfers-admin-email') ); ?>" class="large-text" />
        <p class="description"><?php esc_html_e('Email/emails for delivery. Comma separated if more than one (admin1@example.com, admin2@example.com, ...)','ns-airport-transfers'); ?></p>
      <br><hr></td>
    </tr>

    <tr>
      <th scope="row"><?php esc_html_e('Contact email','ns-airport-transfers'); ?></th>
      <td>
        <input type="text" name="ns-airport-transfers-contact-email" value="<?php echo esc_attr( get_option('ns-airport-transfers-contact-email') ); ?>" class="large-text" />
        <p class="description"><?php esc_html_e('Contact email.','ns-airport-transfers'); ?></p>
      <br><hr></td>
    </tr>

    <tr>
      <th scope="row"><?php esc_html_e('Contact phone/phones','ns-airport-transfers'); ?></th>
      <td>
        <input type="text" name="ns-airport-transfers-contact-phone" value="<?php echo esc_attr( get_option('ns-airport-transfers-contact-phone') ); ?>" class="large-text" />
        <p class="description"><?php esc_html_e('Contact phone/phones.','ns-airport-transfers'); ?></p>
      <br><hr></td>
    </tr>

    <tr>
      <th scope="row"><?php esc_html_e('Default destination country','ns-airport-transfers'); ?></th>
      <td>
        <input type="text" name="ns-airport-transfers-country" value="<?php echo esc_attr( get_option('ns-airport-transfers-country') ); ?>" />
        <p class="description"><?php esc_html_e('Set the country (also can be set in the shortcode [airport-transfers-form country="Earthsea"])','ns-airport-transfers'); ?></p>
      </td>
    </tr>

    <tr>
      <th scope="row"><?php esc_html_e('Resort type','ns-airport-transfers'); ?></th>
      <td>
        <select name="ns-airport-transfers-resort">
        <?php $options = array(
              'summer' => 'Summer',
              'winter' => 'Winter'
          ); ?>
        <?php $format = esc_attr( get_option('ns-airport-transfers-resort')); ?>
        <?php foreach ($options as $value => $name) : ?>
          <?php $selected = ($format===$value) ? ' selected="selected"' : ''; ?>
          <option value="<?php echo $value; ?>"<?php echo $selected; ?>><?php esc_html_e($name,'ns-airport-transfers'); ?></option>
        <?php endforeach; ?>
        </select>
        <p class="description"><?php esc_html_e('Select default resort type (also can be set in the shortcode [airport-transfers-form resort="summer/winter"])','ns-airport-transfers'); ?></p>
      </td>
    </tr>

    <tr>
      <th scope="row"><?php esc_html_e('Time format','ns-airport-transfers'); ?></th>
      <td>
        <select name="ns-airport-transfers-time-format">
        <?php $options = array('12','24'); ?>
        <?php $format = esc_attr( get_option('ns-airport-transfers-time-format')); ?>
        <?php foreach ($options as $option) : ?>
          <?php $selected = ($format===$option) ? ' selected="selected"' : ''; ?>
          <option value="<?php echo $option; ?>"<?php echo $selected; ?>><?php echo $option; ?> <?php esc_html_e('Hours','ns-airport-transfers'); ?></option>
        <?php endforeach; ?>
        </select>
        <p class="description"><?php esc_html_e('Select default time-format (also can be set in the shortcode [airport-transfers-form time-format="24"])','ns-airport-transfers'); ?></p>
      </td>
    </tr>
  </table>
  <?php submit_button(); ?>
</form>
</div>
