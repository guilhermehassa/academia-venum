<?php
  $args = [
    'post_type'      => 'service_channel',
    'post_status'    => 'publish',
    'posts_per_page' => -1, 
  ];

  $query = new WP_Query($args);

?>

<div class="serviceChannel-list">
  <?php if ($query->have_posts()) : ?>
    <?php while ($query->have_posts()) : ?>
      <?php
        $query->the_post();
        $title = get_the_title();
        $content = get_field('content'); // Obtém o campo "content" do ACF
      ?>

      <a href="<?= $content['link']['url']; ?>" class="serviceChannel-item">
        <img src="<?= $content['icon']; ?>" aria-hidden="true">
        <span>
          <?= $content['link']['title']; ?>
        </span>
      </a>
      
    <?php endwhile; ?>
  <?php endif; wp_reset_postdata(); ?>
</div>