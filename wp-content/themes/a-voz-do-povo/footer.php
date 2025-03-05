<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package A_voz_do_povo
 */
	$footer_text = get_post(108);

?>

<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="col-12 footer_logo">
        <?php the_custom_logo(); ?>
      </div>
      <div class="col-12">
        <nav class="footer_nav">
          <ul class="list-unstyled">
            <li>
              <a href="<?php echo esc_url(home_url('/sobre-nos/')); ?>">
                SOBRE NÓS
              </a>
            </li>
            <li>
              <a href="<?php echo esc_url(home_url('/fale-conosco/')); ?>">
                FALE CONOSCO
              </a>
            </li>
            <li>
              <a href="<?php echo esc_url(home_url('/fale-conosco/')); ?>">
                ANUNCIE AQUI
              </a>
            </li>
            <li class="socials">
              <?php
                $args = [
                  'post_type'      => 'service_channel',
                  'post_status'    => 'publish',
                  'posts_per_page' => -1, 
                ];

                $query = new WP_Query($args);
              ?>
              <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : ?>
                  <?php
                    $query->the_post();
                    $title = get_the_title();
                    $content = get_field('content');
                  ?>

                  <a href="<?= $content['link']['url']; ?>" id="<?= $content['link']['url']; ?>" target="_blank">
                    <img src="<?= $content['icon']; ?>" aria-hidden="true">
                  </a>
                  
                <?php endwhile; ?>
              <?php endif; wp_reset_postdata(); ?>
            </li>
          </ul>
        </nav>
      </div>
      <?php if($footer_text) : ?>
        <div class="col-12 text-lg-center">
          <?= apply_filters('the_content', $footer_text->post_content); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</footer>
<!-- Adicionando jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Adicionando jQuery Mask Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>

<?php wp_footer(); ?>

</body>
</html>
