<?php
/*
Template Name: Pesquisa
*/

get_header();


if(!isset($_GET['pesquisa']) || empty($_GET['pesquisa'])){
  wp_redirect(home_url('/'));
  exit;
}else{
  $searchTerm = $_GET['pesquisa'];
}
?>

<main>
  <div class="container">
    <div class="row py-3 d-none d-lg-flex d-none d-lg-flex">
      <!-- BANNER -->
      <div class="col-8">
        <?php include get_template_directory() . '/publi/large.php'; ?>
      </div>
      <div class="col-4">
        <?php include get_template_directory() . '/publi/small.php'; ?>
      </div>
    </div>
    <div class="row py-3">
      
    <div class="col-12 col-lg-10 mx-auto mb-3">
        <h1 class="mb-3 text-center">
          PESQUISA POR:<br>
          <?= $searchTerm; ?>
        </h1>
        <section class="editorialList editorialList-taxonomy">
          <?php
             $args = array(
              'post_type'      => 'noticia',
              'posts_per_page' => 10,
              's'              => sanitize_text_field($searchTerm),
            );
            
            $searchNews = new WP_Query($args);
            $countLastNews = 1;
          ?>
          <?php if($searchNews->have_posts()) : ?>
            <?php while ($searchNews->have_posts()) : $searchNews->the_post(); ?>  
              <?php if($countLastNews==1): ?>
                <?php include get_template_directory() . '/inc/editorialList_first.php'; ?>
              <?php else: ?>
                <?php include get_template_directory() . '/inc/editorialList_small.php'; ?>
              <?php endif; ?>
              <?php if ($countLastNews == 1 || ($countLastNews % 3 == 0)) : ?>
                <div class="mb-3">
                  <?php include get_template_directory() . '/publi/square.php'; ?>
                </div>
              <?php endif; ?>
              <?php $countLastNews++; ?>
            <?php endwhile; ?>
          <?php else: ?>
            <h4>Não encontramos resultados com o termo solicitado :(</h4>
            <p>Mas estas notícias podem te interessar:</p>
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
                <?php if($countLastNews==1): ?>
                  <?php include get_template_directory() . '/inc/editorialList_first.php'; ?>
                <?php else: ?>
                  <?php include get_template_directory() . '/inc/editorialList_small.php'; ?>
                <?php endif; ?>
                <?php if ($countLastNews % 3 == 0) : ?>
                  <?php include get_template_directory() . '/publi/small.php'; ?>
                <?php endif; ?>
                <?php $countLastNews++; ?>
              <?php endwhile; ?>
            </section>
          <?php endif; ?>
          
        </section>
      </div>
    </div>
  </div>
</main>

<?php include get_template_directory() . '/publi/popup.php'; ?>

<?php
get_footer();
