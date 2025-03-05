<a href="<?php the_permalink(); ?>">
  <article class="editorialList_item-small mb-3">
    <div class="row align-items-center">
      <div class="col-3 col-lg-2">
        <?php if (has_post_thumbnail()) : ?>
          <?php the_post_thumbnail('thumbnail', ['class' => 'img-fluid', 'alt' => get_the_title()]); ?>
        <?php else : ?>
          <img class="img-fluid" src="<?= get_template_directory_uri(); ?>/img/default_notice.jpg" alt="Imagem padrão">
        <?php endif; ?>
      </div>
      <div class="col-9 col-lg-10">
        <h2><?php the_title(); ?></h2>
      </div>
      <div class="col-12">
        <p><?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?></p>
      </div>
    </div>
  </article>
</a>