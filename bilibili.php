<?php
/*
Plugin Name: Card for Bilibili
Description: This plugin can transform links of bilibili to an information card.
Author: Texas
Version: 1.3
Author URI: http://texas.penguin-logistics.cn
*/
//API Powered by KAAAsS(https://blog.kaaass.net/)

add_action( 'wp_enqueue_scripts', function() {
	$version = '1.3';
	wp_enqueue_style( "card-for-bilibili-css", plugins_url( "card-for-bilibili.css?v=$version" , __FILE__ ), array(), $version, 'all' );
	wp_enqueue_script( "card-for-bilibili-js", plugins_url( "card-for-bilibili.js?v=$version" , __FILE__ ), array(), $version, true );
} );
add_action( 'template_redirect', function() {
	$av = intval( get_query_var( 'av' ) );
	if ($av) {
		include plugin_dir_path( __FILE__ ) . 'av.php';
		die;
	}
} );
add_action( 'init', function() {
	add_rewrite_rule( '^bilibili/av([0-9]+)/?', 'index.php?av=$matches[1]', 'top' );
} );
add_filter( 'query_vars', function( $query_vars ) {
	$query_vars[] = 'av';
    return $query_vars;
} );