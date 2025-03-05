<article class="row lastNews_item mb-3">
  <div class="col-3 lastNews_item__image">
    <?php 
      if (has_post_thumbnail()) : 
        the_post_thumbnail('medium', ['class' => 'img-fluid', 'alt' => get_the_title()]);
      else : 
    ?>
      <img src="<?= get_template_directory_uri(); ?>/img/default_notice.jpg" alt="Imagem padrão">
    <?php endif; ?>
  </div>
  <div class="col-9 lastNews_item__content">
    <header>
      <h2><?php the_title(); ?></h2>
    </header>
    <footer>
      <a href="<?php the_permalink(); ?>" class="main_button">
        SAIBA MAIS
      </a>
    </footer>
  </div>
</article>