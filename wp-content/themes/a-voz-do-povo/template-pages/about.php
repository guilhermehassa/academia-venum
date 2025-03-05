<?php
/*
Template Name: Sobre Nós
*/

get_header();
?>

<main>
  <div class="container">
    <div class="row">
      <div class="col-12 my-3">
        <h1 class="text-uppercase text-center">
          <?php the_title(); ?>
        </h1>
      </div>
      <div class="col-12 col-lg-8 mx-auto mb-3">
        <?php the_content(); ?>
      </div>
      <div class="col-12 col-lg-6 mx-auto mb-3">
        <?php include get_template_directory() . '/inc/serviceChannel-list.php'; ?>
      </div>
    </div>
  </div>
</main>

<?php
get_footer();
