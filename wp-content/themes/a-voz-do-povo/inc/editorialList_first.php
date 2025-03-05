<a href="<?php the_permalink(); ?>">
  <article class="editorialList_item-first mb-3">
    <?php if (has_post_thumbnail()) : ?>
      <?php the_post_thumbnail('medium', ['class' => 'mb-1 img-fluid', 'alt' => get_the_title()]); ?>
    <?php else : ?>
      <img class="mb-1 img-fluid" src="<?= get_template_directory_uri(); ?>/img/default_notice.jpg" alt="Imagem padrão">
    <?php endif; ?>

    <h2 class="h5"><?php the_title(); ?></h2>

    <p><?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?></p>
  </article>
</a>