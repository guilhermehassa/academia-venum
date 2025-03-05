<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package A_voz_do_povo
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="header">
	<div class="header_first">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center text-lg-end">
					<?php
						date_default_timezone_set('America/Cuiaba');
						$dataHoraAtual = date('Y-m-d\TH:i:s');
							
					?>
					Cuiabá, <span id="timeNow"><?= $dataHoraAtual; ?></span> 
				</div>
			</div>
		</div>
	</div>
	<div class="header_main">
		<div class="container">
			<div class="row">
				<div class="col-6">
					<h1 title="<?=get_bloginfo('name');?>" class="header_logo">
						<?php the_custom_logo(); ?>
					</h1>
				</div>
			</div>
		</div>
	</div>

	<div class="d-flex justify-content-end header_toggle">
		<button id="toggle-menu" class="d-lg-none">
			<?=  file_get_contents(get_template_directory().'/img/toggle_menu.svg')  ?>
		</button>
	</div>

	<div class="header_nav">
		<div class="container">
			<form action="<?php echo esc_url(home_url('/pesquisa/')); ?>" id="search-form">
				<input type="text" name="pesquisa" id="search-input" placeholder="Digite sua busca...">
				<button type="submit">
					<?= file_get_contents(get_template_directory() . '/img/searchicon.svg') ?>
				</button>
			</form>
			<nav>
				<ul class="list-unstyled">
					<?php
						$terms = get_terms([
							'taxonomy'   => 'editoria',
							'hide_empty' => true, // Exibe apenas categorias que possuem posts
						]);
					?>
					<?php if (!empty($terms) && !is_wp_error($terms)) : ?>
						<?php foreach ($terms as $term) : ?>
							<li>
								<a href="<?php echo get_term_link($term); ?>">
									<?php echo esc_html($term->name); ?>
								</a>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</nav>
			<nav class="header_nav__more">
				<ul class="list-unstyled">
					<li>
						<a href="<?php echo esc_url(home_url('/sobre-nos/')); ?>">
							SOBRE NÓS
						</a>
					</li>
					<li>
						<a href="<?php echo esc_url(home_url('/fale-conosco/')); ?>">
							FALE CONOSCO
						</a>
					</li>
					<li>
						<a href="<?php echo esc_url(home_url('/fale-conosco/')); ?>">
							ANUNCIE AQUI
						</a>
					</li>
					<li class="socials">
						<?php
							$args = [
								'post_type'      => 'service_channel',
								'post_status'    => 'publish',
								'posts_per_page' => -1, 
							];

							$query = new WP_Query($args);
						?>
						<?php if ($query->have_posts()) : ?>
							<?php while ($query->have_posts()) : ?>
								<?php
									$query->the_post();
									$title = get_the_title();
									$content = get_field('content');
								?>

								<a href="<?= $content['link']['url']; ?>" id="<?= $content['link']['url']; ?>" target="_blank">
									<img src="<?= $content['icon']; ?>" aria-hidden="true">
								</a>
								
							<?php endwhile; ?>
						<?php endif; wp_reset_postdata(); ?>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</header>