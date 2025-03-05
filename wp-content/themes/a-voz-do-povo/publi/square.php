<?php
$publiArgs = array(
  'post_type'      => 'publicidade', // Substitua pelo seu CPT
  'posts_per_page' => 1, // Apenas um resultado
  'orderby'        => 'rand', // Ordenação aleatória
  'post_status'    => 'publish', // Apenas posts publicados
  'meta_query'     => array(
    array(
      'key'     => 'active-square', // Nome do campo ACF
      'value'   => '1', // Verifica se está ativo (true)
      'compare' => '='
    )
  )
);

$publi = new WP_Query($publiArgs);
?>

<?php if ($publi->have_posts()) : while ($publi->have_posts()) : $publi->the_post(); ?>
  <?php
    $link  = get_field('link-square'); 
    $image = get_field('image-square'); 
  ?>
  <div class="publi publi-square">
    <?php if (!empty($link)) : ?>
      <a href="<?= esc_url($link); ?>" target="_blank" rel="noopener">
        <img src="<?= esc_url($image); ?>" alt="<?= esc_attr(get_the_title()); ?>">
      </a>
    <?php else : ?>
      <div>
        <img src="<?= esc_url($image); ?>" alt="<?= esc_attr(get_the_title()); ?>">
      </div>
    <?php endif; ?>
    <span>PUBLICIDADE</span>
  </div>
<?php endwhile; endif; wp_reset_postdata(); ?>
