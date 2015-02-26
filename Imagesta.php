<?php

/*
Plugin Name: Imagesta
Plugin URI: https://github.com/dotcablogger/Imagesta
Description: To view in your WordPress.org website the Instagram photos from your Instagram account.
Version: 1.0
Author: Dotcamom Blog
Author URI: http://www.dotcamom.com
License: GNU GENERAL PUBLIC LICENSE, Version 3, 29 June 2007 (GPL v3.0)
*/

	// fix SSL request error
	add_action( 'http_request_args', 'no_ssl_http_request_args', 10, 2 );
	function no_ssl_http_request_args( $args, $url ) {
		$args['sslverify'] = false;
		return $args;
	}

	// register shortcode
	add_shortcode( 'Imagesta', 'Imagesta_embed_shortcode' );
	
	// define shortcode
  function Imagesta_embed_shortcode( $atts, $content = null ) {
		// define main output
		$str    = "";
		// get remote data
		$result = wp_remote_get( "https://api.instagram.com/v1/users/self/media/recent/?access_token=1515219736.625293a.5b650c4e9cf14c6fa70783e3b6554cd9" );
		
		if( is_wp_error( $result ) ) {
			// error handling
			$error_message = $result->get_error_message();
			$str           = "Something went wrong: $error_message";
		} else {
			// processing further
			$result    = json_decode($result['body']);
			$main_data = array();
			$n         = 0;
			
			// get username and actual thumbnail
			foreach ($result->data as $d) {
				$main_data[ $n ]['user']      = $d->user->username;
				$main_data[ $n ]['thumbnail'] = $d->images->thumbnail->url;
				$n++;
			}

			// create main string, pictures embedded in links
			foreach ($main_data as $data) {
				$str .= '<a target="_blank" href="https://instagram.com/oauth/authorize/?client_id=625293aacf064085804c474e3641924f&redirect_uri=https://instagram.com/accounts/login/&response_type=token'.'"><img src="'.$data['thumbnail'].'" alt="'.$data['user'].' pictures"></a>';
			}
		}

		return $str;
	}
	
?>
