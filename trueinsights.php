<?php 
/*
Plugin Name: TrueInsights - Narrative Insights
Plugin URI:  https://trueinsights.co
Description: The best narrative insights plugin for Wordpress. See how visitors use your website with help of easy to understand narrative insights.
Version:     1.4.0
Author:      TrueInsights
License:     GPL2 etc
License URI: https://www.trueinsights.co/terms-of-use
*/

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

register_activation_hook(__FILE__, function (){	
	 $trueinsight_page = admin_url( 'admin.php?page=TrueInsights' );
	 wp_redirect( $trueinsight_page );
});

add_action( 'wp_enqueue_scripts', function(){
	$get_snippet = get_option( 'TrueInsights_api_response' );
	if ( $get_snippet ) {
		$script_url = "https://trueinsights.co/sdk/{$get_snippet->api_key}/init.embed.js";
		wp_enqueue_script( 'trueinsights', $script_url, [], time() );
	}
});

add_action( 'admin_enqueue_scripts', function(){
	wp_enqueue_style( 'trueinsights', plugins_url( '/assets/css/style.css', __FILE__ ), '', time(), 'all' );
});

add_action( 'activated_plugin', function ( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
    	delete_option('TrueInsights_api_response');
    	$trueinsight_page = admin_url( 'admin.php?page=TrueInsights' );
        exit( wp_redirect( $trueinsight_page ) );
    }
});

add_action( 'init', function(){
	add_menu_page( "TrueInsights", "TrueInsights", 'manage_options', "TrueInsights", 'trueinsights_menu_content', '  https://trueinsights.co/images/v2/favicon-96x96.png', 76 );
});

function trueinsights_menu_content(){
	if( isset( $_POST['trueinsight-email-input'] ) ){
		$admin_mail = sanitize_email( $_POST['trueinsight-email-input'] );
		update_option( 'TrueInsights_admin_email', $admin_mail );
		$admin 		= get_user_by( 'email', $admin_mail );
		$admin_name = $admin ? $admin->data->display_name : $admin_mail;
		$remote_url = "https://portalapi.trueinsights.co/integrations/wordpress/register";
		$data 		= [
			'admin_name' 	=> $admin_name,
			'admin_email' 	=> $admin_mail,
			'site_url' 		=> get_bloginfo( 'url' ),
			'site_name' 	=> get_bloginfo( 'name' ),
		];

		$response = wp_remote_post( $remote_url, array(
		    'method'      => 'POST',
		    'headers'     => [
		    	'Content-Type' 	=> 'application/json',
		    	"Authorization" => "Basic cHJvZF91c2VyX2FjY2VzczpiNjUzMzcwMjMzNmQ0ZGIyODdiMGI0YzgyYTkxYWM0OA=="
		    ],
		    'body'        => json_encode($data),
		    )
		);

		$response = wp_remote_retrieve_body( $response );
		$response = json_decode( $response );

		if ( $response->response_objects ) {
			update_option( 'TrueInsights_api_response', $response->response_objects );
		}
	}	
	$get_snippet = get_option( 'TrueInsights_api_response' );
	$admin_mail = '';
	if ( $get_snippet ) {
		$admin_mail = get_option( 'TrueInsights_admin_email' );
		include dirname( __FILE__ ) . '/views/confirmation.php';
	}else{
		include dirname( __FILE__ ) . '/views/activation-form.php';
	}
}


add_action( 'admin_footer_text',function( $text ){
	if( get_current_screen()->parent_base != 'TrueInsights' ) return $text;

	return sprintf( __( 'If you like <strong>%1$s</strong>, please <a href="%2$s" target="_blank">leave us a %3$s rating</a> on WordPress.org! It\'d motivate and inspire us to make the plugin even better!', 'woolementor' ), 'TrueInsights', "https://wordpress.org/support/plugin/trueinsights/reviews/?filter=5#new-post", '⭐⭐⭐⭐⭐' );
});