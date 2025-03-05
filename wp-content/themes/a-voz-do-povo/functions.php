<?php
/**
 * A voz do povo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package A_voz_do_povo
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function a_voz_do_povo_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on A voz do povo, use a find and replace
		* to change 'a-voz-do-povo' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'a-voz-do-povo', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'a-voz-do-povo' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'a_voz_do_povo_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'a_voz_do_povo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function a_voz_do_povo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'a_voz_do_povo_content_width', 640 );
}
add_action( 'after_setup_theme', 'a_voz_do_povo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function a_voz_do_povo_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'a-voz-do-povo' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'a-voz-do-povo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'a_voz_do_povo_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function a_voz_do_povo_scripts() {
	wp_enqueue_style( 'a-voz-do-povo-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri().'/css/styles.css', array(), _S_VERSION );
	wp_enqueue_style( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array() );
	
	wp_style_add_data( 'a-voz-do-povo-style', 'rtl', 'replace' );

	wp_enqueue_script( 'a-voz-do-povo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'a_voz_do_povo_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function allow_svg_upload($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'allow_svg_upload');

function ocultar_menu_posts() {
	remove_menu_page('edit.php'); // Remove "Posts" do menu
}
add_action('admin_menu', 'ocultar_menu_posts');

function inserir_publicidade_no_conteudo($content) {
	if (is_singular('noticia')) { // Aplica apenas ao CPT 'noticia'
		$pattern = '/(<p>.*?<\/p>|<h[1-6]>.*?<\/h[1-6]>|<ul>.*?<\/ul>|<ol>.*?<\/ol>)/i'; // Expressão regular para identificar blocos de texto
		preg_match_all($pattern, $content, $matches); // Separa os blocos de conteúdo

		$total_blocos = count($matches[0]);
		$new_content = '';  

		// Garante que a cada chamada tenhamos publicidades diferentes
		$publicidades_exibidas = [];

		foreach ($matches[0] as $index => $block) {
			$new_content .= $block;  

			if (($index + 1) % 3 == 0) { // Insere a cada 3 blocos
				$publicidade = gerar_publicidade($publicidades_exibidas);
				if (!empty($publicidade)) {
					$new_content .= $publicidade;
					$publicidades_exibidas[] = $publicidade; // Adiciona ao array para evitar repetição
				}
			}
		}

		// Se não houver blocos suficientes para exibir ao menos uma publicidade, garante uma no final
		if ($total_blocos < 3) {
			$publicidade = gerar_publicidade($publicidades_exibidas);
			if (!empty($publicidade)) {
				$new_content .= $publicidade;
			}
		}

		return $new_content;
	}
	return $content;
}
add_filter('the_content', 'inserir_publicidade_no_conteudo');
/**
 * Função para buscar uma publicidade pequena ou quadrada.
 */
function gerar_publicidade() {
	$theme_path = get_template_directory() . '/publi/'; // Caminho da pasta dentro do tema
	$options = ['small.php', 'square.php']; // Arquivos disponíveis
	$file = $theme_path . $options[array_rand($options)]; // Escolhe um aleatório

	if (file_exists($file)) {
		ob_start();
		include $file; // Inclui o arquivo correspondente
		return ob_get_clean();
	}
	return ''; // Retorna vazio se o arquivo não existir
}