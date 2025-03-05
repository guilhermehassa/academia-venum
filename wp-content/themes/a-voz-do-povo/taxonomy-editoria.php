<?php
  get_header();
?>

<main class="editorial">
  <div class="container">
    <div class="row py-3 d-none d-lg-flex">
      <!-- BANNER -->
      <div class="col-8">
        <?php include get_template_directory() . '/publi/large.php'; ?>
      </div>
      <div class="col-4">
        <?php include get_template_directory() . '/publi/small.php'; ?>
      </div>
    </div>
    <!-- ROW DO DESKTOP, COM 2 COLUNAS -->
    <div class="row">
      <div class="col-12 col-lg-8">
        <!-- ROW DE CONTEÚDO PRINCIPAL -->
        <div class="row">
          <div class="col-12 my-3">
            <h1 class="text-uppercase text-center text-lg-start">
              <?php single_term_title(); ?>
            </h1>
          </div>
          <div class="col-12 editorialList editorialList-taxonomy">
            <?php $current_term = get_queried_object();  ?>
            <?php if ($current_term && !is_wp_error($current_term)) : ?>
              <?php 
                $args = [
                  'post_type'      => 'noticia',
                  'posts_per_page' => -1, // Todos os posts
                  'post_status'    => 'publish',
                  'orderby'        => 'date',
                  'order'          => 'DESC',
                  'tax_query'      => [
                    [
                      'taxonomy' => 'editoria',
                      'field'    => 'term_id',
                      'terms'    => $current_term->term_id, // Filtra pela editoria atual
                    ],
                  ],
                ];

                $news = new WP_Query($args);
              ?>

              <?php if ($news->have_posts()) : ?>
                <?php $newsCounter=0; ?>
                <?php while ($news->have_posts()) : ?>
                  <?php $news->the_post(); ?>
                  <?php if($newsCounter==0): ?>
                    <?php include get_template_directory() . '/inc/editorialList_first.php'; ?>
                  <?php else: ?>
                    <?php include get_template_directory() . '/inc/editorialList_small.php'; ?>
                  <?php endif; ?>
                  <?php if ($newsCounter == 0 || ($newsCounter % 3 == 0)) : ?>
                    <div class="mb-3">
                      <?php include get_template_directory() . '/publi/square.php'; ?>
                    </div>
                  <?php endif; ?>
                  <?php $newsCounter++; ?>
                <?php endwhile; ?>
              <?php endif; ?>
            <?php endif; ?>

          </div>
          <div class="col-12 text-center">
            <button class="main_button">
              MAIS NOTÍCIAS
            </button>
          </div>
        </div>
      </div>
      <div class="col-12 my-3 col-lg-4">
        <h2 class="h1 mb-3">VEJA TAMBÉM</h2>
        <?php $current_term = get_queried_object(); ?>
        <?php if ($current_term && !is_wp_error($current_term)) : ?>
          <?php 
            $args = [
              'taxonomy'   => 'editoria',
              'exclude'    => [$current_term->term_id], // Exclui a editoria atual
              'orderby'    => 'name',
              'order'      => 'ASC',
              'number'     => 5, // Limita a 5 editorias
            ];

            $editorias = get_terms($args);
          ?>

          <?php if($editorias) : ?>
            <?php foreach ($editorias as $editoria) : ?>
              <h3 class="h2">
                <?= $editoria->name; ?>
              </h3>
    
              <?php
                $news_args = [
                  'post_type'      => 'noticia',
                  'posts_per_page' => 4, // Limita a 4 notícias por editoria
                  'post_status'    => 'publish',
                  'orderby'        => 'date',
                  'order'          => 'DESC',
                  'tax_query'      => [
                    [
                      'taxonomy' => 'editoria',
                      'field'    => 'term_id',
                      'terms'    => $editoria->term_id, // Filtra pela editoria
                    ],
                  ],
                ];

                $related_news = new WP_Query($news_args);
              ?>

              <?php if ($related_news->have_posts()) : ?>
                <div class="editorial_relateds mb-3">
                  <?php while ($related_news->have_posts()) : ?>
                    <?php $related_news->the_post(); ?>
                    <a class="editorial_relateds__item" href="<?php the_permalink(); ?>">
                      <span>></span>
                      <span>
                        <?php the_title(); ?>
                      </span>
                    </a>
                    <?php wp_reset_postdata(); ?>
                  <?php endwhile; ?>
                  <a href="<?= get_term_link($editoria); ?>" class="main_button mb-0">
                    VEJA MAIS SOBRE <?= $editoria->name; ?>
                  </a>
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
    
            <?php include get_template_directory() . '/publi/small.php'; ?>
    
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</main>

<?php //include get_template_directory() . '/publi/popup.php'; ?>

<?php
get_footer();
