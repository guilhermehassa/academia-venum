<?php
  get_header();
?>

<main class="notice">
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
        <h1 class="mb-3">
          <?php the_title(); ?>
        </h1>
        <div class="notice_image mb-3">
          <?php
            if (has_post_thumbnail()) {
              the_post_thumbnail('full', ['class' => 'img-fluid', 'alt' => get_the_title()]);
            } else {
              echo '<img class="img-fluid" src="' . get_template_directory_uri() . '/img/default_notice.jpg" alt="Imagem padrão">';
            }

            $terms = get_the_terms(get_the_ID(), 'editoria');
            
            if ($terms && !is_wp_error($terms)) {
              echo '<span>' . esc_html($terms[0]->name) . '</span>';
            }
          ?>
        </div>
        <div class="col-12 col-lg-4 notice_info">
          <p>
            POR: <span><?= get_the_author(); ?></span>
          </p>
          <p>
            POSTADO EM: <span><?= get_the_date('d/m/Y'); ?></span>
          </p>
        </div>
        <div class="col-12 col-lg-8 notice_share">
          <p>COMPARTILHE:</p>

          <?php
            $post_title = get_the_title(); // Obtém o título da notícia
            $post_url = get_permalink(); // Obtém a URL da notícia

            // Mensagem personalizada antes do título
            $custom_message = 'Veja no Diário Cuiabano: ' . $post_title;

            // Links de compartilhamento
            $whatsapp_link = 'https://api.whatsapp.com/send?text=' . urlencode($custom_message . ' ' . $post_url);
            $facebook_link = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($post_url);
            $telegram_link = 'https://t.me/share/url?url=' . urlencode($post_url) . '&text=' . urlencode($custom_message);
            $email_link = 'mailto:?subject=' . urlencode($custom_message) . '&body=' . urlencode($custom_message . ' ' . $post_url);
          ?>

          <a href="<?= esc_url($whatsapp_link); ?>" target="_blank">
              <img src="<?= get_template_directory_uri(); ?>/img/socials/whatsapp.svg" aria-hidden="true">
          </a>

          <a href="<?= esc_url($facebook_link); ?>" target="_blank">
              <img src="<?= get_template_directory_uri(); ?>/img/socials/facebook.svg" aria-hidden="true">
          </a>

          <a href="#" onclick="copyToClipboard('<?= esc_url($post_url); ?>')" title="Copiar link para Instagram">
              <img src="<?= get_template_directory_uri(); ?>/img/socials/instagram.svg" aria-hidden="true">
          </a>

          <a href="<?= esc_url($telegram_link); ?>" target="_blank">
              <img src="<?= get_template_directory_uri(); ?>/img/socials/telegram.svg" aria-hidden="true">
          </a>

          <a href="<?= esc_url($email_link); ?>">
              <img src="<?= get_template_directory_uri(); ?>/img/socials/email.svg" aria-hidden="true">
          </a>
        </div>

        <div class="col-12 mt-3 notice_content">
          <?= the_content(); ?>
        </div>
      </div>
      <div class="col-12 my-3 col-lg-4">
        <h2 class="h4 mb-3">
          VEJA TAMBÉM
        </h2>
        <section class="lastNews">
          <?php
            // Obtém a editoria (termo da taxonomia "editoria") do post atual
            $terms = get_the_terms(get_the_ID(), 'editoria');

            if ($terms && !is_wp_error($terms)) {
              $editoria_slug = $terms[0]->slug; // Pega o primeiro termo encontrado
              // Query para buscar posts do CPT 'noticia' que pertençam à mesma editoria
              $args = [
                'post_type'      => 'noticia',
                'posts_per_page' => 16, // Limita a 16 posts
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
                'tax_query'      => [
                  [
                    'taxonomy' => 'editoria',
                    'field'    => 'slug',
                    'terms'    => $editoria_slug, // Filtra pela mesma editoria
                  ],
                ],
                'post__not_in'   => [get_the_ID()], // Exclui o post atual
              ];

              $related_news = new WP_Query($args);

              if ($related_news->have_posts()) :
                $count = 0; // Contador de itens exibidos
                $total_posts = $related_news->found_posts; // Total de posts encontrados


                while ($related_news->have_posts()) : $related_news->the_post();
                  include get_template_directory() . '/inc/lastnews_item.php';
                  $count++;
                  if ($count % 3 == 0) {
                    include get_template_directory() . '/publi/small.php';
                  }
                endwhile;
                if ($count < 3) {
                  include get_template_directory() . '/publi/small.php';
                }
                wp_reset_postdata(); // Reseta os dados do loop
              else :
                echo '<p>Nenhuma notícia relacionada encontrada.</p>';
              endif;
            }
          ?>
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


<script>
function copyToClipboard(text) {
  navigator.clipboard.writeText(text).then(() => {
    alert('Link copiado! Agora você pode colá-lo no Instagram.');
  }).catch(err => {
    console.error('Erro ao copiar:', err);
  });
}
</script>

<?php //include get_template_directory() . '/publi/popup.php'; ?>

<?php
get_footer();
