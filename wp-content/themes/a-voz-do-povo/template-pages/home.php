<?php
/*
Template Name: Home
*/

get_header();

$content = get_field('content');
?>

<main id="home">
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
    <div class="row">
      <div class="col-12 col-lg-8">
        <div class="row">
          <div class="col-12 mb-3">
            <section class="homeHero">
              <div class="swiper homeHero_swiper">
                <div class="swiper-wrapper">
                  <?php foreach ($content['highlight_notices'] as $key => $noticeId) : ?>
                    <div class="swiper-slide homeHero_post">
                      <?php
                        $imagem = get_the_post_thumbnail_url($noticeId, 'full'); // Obtém a imagem destacada
                        if (!$imagem) {
                          $imagem = get_template_directory_uri() . '/img/default_notice.jpg'; // Imagem padrão
                        }                        
                      ?>
                      <a href="<?= get_permalink($noticeId); ?>">
                        <img src="<?= esc_url($imagem); ?>" aria-hidden="true">
                        <div class="homeHero_post__content">
                          <span class="homeHero_post__category">
                            <?= wp_get_post_terms($noticeId, 'editoria')[0]->name; ?>
                          </span>
                          <h3 class="homeHero_post__title">
                            <?= get_the_title($noticeId); ?>
                          </h3>
                        </div>
                      </a>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </section>
          </div>
          <div class="col-12 mb-3 d-lg-none">
            <?php include get_template_directory() . '/publi/square.php'; ?>
          </div>
          <div class="col-12 mb-3 d-lg-none">
            <h2 class="h4 mb-3">
              ÚLTIMAS NOTÍCIAS
            </h2>
            <section class="lastNews">
              <?php
                $lasNewsArgs = [
                  'post_type'      => 'noticia', // Define o CPT
                  'posts_per_page' => 12, // Limita a 12 posts
                  'orderby'        => 'date', // Ordena por data de publicação
                  'order'          => 'DESC', // Do mais recente para o mais antigo
                ];
                
                $lastNewsQuery = new WP_Query($lasNewsArgs);
                $countLastNews = 1;
              ?>
              <?php while ($lastNewsQuery->have_posts()) : $lastNewsQuery->the_post(); ?>  
                <?php include get_template_directory() . '/inc/lastnews_item.php'; ?>
                <?php if ($countLastNews % 3 == 0) : ?>
                  <?php include get_template_directory() . '/publi/small.php'; ?>
                <?php endif; ?>
                <?php $countLastNews++; ?>
                
              <?php endwhile; ?>
              
            </section>
          </div>

          <?php $categorieCounter = 1; ?>
          <?php if($content['highlighted_categories']) : ?>
            <?php foreach ($content['highlighted_categories'] as $key => $categorieID) : ?>
              <?php 
                $isOdd = false;
                if ($categorieCounter % 2 != 0) { $isOdd = true;}
                $categorie = get_term($categorieID, 'editoria');
                
                $args = array(
                  'post_type'      => 'noticia', // Nome do CPT
                  'posts_per_page' => 5,         // Número de notícias a recuperar
                  'tax_query'      => array(
                    array(
                      'taxonomy' => 'editoria',
                      'field'    => 'term_id',
                      'terms'    => $categorieID,
                    ),
                  ),
                  'orderby'        => 'date',
                  'order'          => 'DESC',
                );
                
                $query = new WP_Query($args);

                $noticeCounter = 0;
              ?>
              <div class="col-12 col-lg-6 <?php if($isOdd){echo 'mt-lg-2';} ?>">
                <?php if(!$isOdd) : ?>
                  <div class="d-none d-lg-block">
                    <?php include get_template_directory() . '/publi/square.php'; ?>
                  </div>
                <?php endif; ?>
                <h2 class="h4 text-uppercase">
                  <?= $categorie->name; ?>
                </h2>
                <?php if ($query->have_posts()) : ?>
                  <section class="editorialList">
                    <?php while ($query->have_posts()) : ?>
                      <?php $query->the_post(); ?>
                      <?php if($noticeCounter == 0) : ?>
                        <?php include get_template_directory() . '/inc/editorialList_first.php'; ?>
                      <?php else : ?>
                        <?php include get_template_directory() . '/inc/editorialList_small.php'; ?>
                      <?php endif; ?>
                      <?php $noticeCounter++; ?>
                    <?php endwhile; ?>
  
                    <a href="<?= get_term_link($categorieID, 'editoria'); ?>" class="main_button text-uppercase">VEJA MAIS SOBRE <?= $categorie->name; ?></a>
                    
                    <?php
                      if($isOdd){
                        include get_template_directory() . '/publi/small.php';
                      }
                      else{
                        echo '<div class="d-lg-none">';
                          include get_template_directory() . '/publi/square.php';
                        echo '</div>';
                      }
                    ?>
  
                  </section>
                <?php endif; ?>
              </div>

              <?php $categorieCounter++; ?>
            <?php endforeach; ?>
          <?php endif; ?>



          <div class="col-12 d-lg-none">
            <h2>FALE CONOSCO</h2>
            <div class="customForm">
              <?= do_shortcode('[contact-form-7 id="33c6086" title="Contact form 1"]'); ?>
            </div>
          </div>
        </div>
      </div>
      <!-- ASIDE IN LARGE SCREEN -->
      <div class="col-12 col-lg-4 d-none d-lg-block">
        <h2 class="h4 mb-3">
          ÚLTIMAS NOTÍCIAS
        </h2>
        <section class="lastNews">
          <?php
            $lasNewsArgs = [
              'post_type'      => 'noticia', // Define o CPT
              'posts_per_page' => 12, // Limita a 12 posts
              'orderby'        => 'date', // Ordena por data de publicação
              'order'          => 'DESC', // Do mais recente para o mais antigo
            ];
            
            $lastNewsQuery = new WP_Query($lasNewsArgs);
            $countLastNews = 1;
          ?>
          <?php while ($lastNewsQuery->have_posts()) : $lastNewsQuery->the_post(); ?>  
            <?php include get_template_directory() . '/inc/lastnews_item.php'; ?>
            <?php if ($countLastNews % 3 == 0) : ?>
              <?php include get_template_directory() . '/publi/small.php'; ?>
            <?php endif; ?>
            <?php $countLastNews++; ?>
            
          <?php endwhile; ?>
          
        </section>
        <div class="d-none d-lg-block">
          <h2>FALE CONOSCO</h2>
            <div class="customForm">
              <?= do_shortcode('[contact-form-7 id="33c6086" title="Contact form 1"]'); ?>
            </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include get_template_directory() . '/publi/popup.php'; ?>

<?php
get_footer();
