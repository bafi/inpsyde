<?php
declare( strict_types=1 );

get_header();
$config = get_option('inpsyde_configuration');
$canDoRequest = false;
if (is_array($config) && isset($config['url']) && ! empty($config['url'])) {
    $canDoRequest = true;
}
?>

  <div id="user-container" style="margin-left: 20%; margin-right: 20%">
      <?php if ($canDoRequest) : ?>
        <user-table url="<?php echo esc_attr($config['url']) ?>"></user-table>
      <?php endif; ?>
  </div>

<?php get_footer(); ?>