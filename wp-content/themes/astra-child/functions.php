<?php

define( 'LIL_PATH', trailingslashit( get_stylesheet_directory() ) );

if ( ! function_exists( 'mn_astra_child_enqueue_styles' ) ) {
	/**
	 * Enqueue styles
	 */
	function mn_astra_child_enqueue_styles() {
		/**
		 * The `get_template_directory_uri()` grab the parent theme full path uri.
		 * The `get_stylesheet_directory_uri()` grab the full URI of our child theme.
		 */
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
	}
}

add_action( 'wp_enqueue_scripts', 'mn_astra_child_enqueue_styles' );

if ( ! function_exists( 'mn_define_block' ) ) {
	/**
	 * Define custom block
	 */
	function mn_define_block() {
		// Check if function exists.
		if ( function_exists( 'acf_register_block' ) ) {
			// Register a ACF fun facts block.
			acf_register_block(
				array(
					'name'            => 'fun-facts',
					'title'           => __( 'Fun Facts' ),
					'description'     => __( 'A custom fun facts block.' ),
					'render_callback' => 'mn_render_fun_facts_block',
					'category'        => 'layout',
					'icon'            => 'nametag',
					'keywords'        => array( 'fun', 'facts', 'profiles', 'acf' ),
				)
			);
		}
	}
}

add_action( 'acf/init', 'mn_define_block' );

if ( ! function_exists( 'mn_render_fun_facts_block' ) ) {
	/**
	 * Render block for fun facts
	 */
	function mn_render_fun_facts_block( $block ) {
		// Convert name ("acf/fun-facts") into path friendly slug ("fun-facts").
		$slug = str_replace( 'acf/', '', $block['name'] );

		if ( file_exists( LIL_PATH . "template-parts/block/content-{$slug}.php" ) ) {
			include LIL_PATH . "template-parts/block/content-{$slug}.php";
		}
	}
}

if ( ! function_exists( 'mn_child_nav_menu_args' ) ) {
	/**
	 *  Display different menus to logged-in users
	 */
	function mn_child_nav_menu_args( $args = '' ) {

		if ( is_user_logged_in() ) {
			$args['menu'] = 'Logged In';
		} else {
			$args['menu'] = 'Primary Menu';
		}

		return $args;
	}
}

add_filter( 'wp_nav_menu_args', 'mn_child_nav_menu_args' );
