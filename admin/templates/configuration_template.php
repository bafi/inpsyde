<?php
declare( strict_types=1 );
?>
<div class="wrap">
  <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
  <p>
    <?php settings_errors('inpsyde-configuration'); ?>
  </p>
  <form method="post" action="<?php echo esc_html(admin_url('options.php')); ?>">
      <?php
      // This prints out all hidden setting fields
        settings_fields('inpsyde-configuration');
        do_settings_sections('inpsyde-configuration');
        submit_button();
        ?>
  </form>
</div>
