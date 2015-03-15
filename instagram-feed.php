<?php 
/**
 * Plugin Name: Instagram feed by Imagesta
 * Plugin URI: http://dotcamom.com
 * Description: This is a plugin to display your Instagram feed.
 * Author: Dotcamom blog
 * Version: 1.0
 * Author URI: http://dotcamom.com
 */

//Include admin
include dirname( __FILE__ ) .'/instagram-feed-admin.php';

// Add shortcodes
add_shortcode('instagram-feed', 'display_instagram');
function display_instagram($atts, $content = null) {


    /******************* SHORTCODE OPTIONS ********************/

    $options = get_option('bm_instagram_settings');
    
    //Pass in shortcode attributes
    $atts = shortcode_atts(
    array(
        'id' => $options[ 'bm_instagram_user_id' ],
        'width' => $options[ 'bm_instagram_width' ],
        'widthunit' => $options[ 'bm_instagram_width_unit' ],
        'height' => $options[ 'bm_instagram_height' ],
        'heightunit' => $options[ 'bm_instagram_height_unit' ],
        'sortby' => $options[ 'bm_instagram_sort' ],
        'num' => $options[ 'bm_instagram_num' ],
        'cols' => $options[ 'bm_instagram_cols' ],
        'disablemobile' => $options[ 'bm_instagram_disable_mobile' ],
        'imagepadding' => $options[ 'bm_instagram_image_padding' ],
        'imagepaddingunit' => $options[ 'bm_instagram_image_padding_unit' ],
        'background' => $options[ 'bm_instagram_background' ],
        'showbutton' => $options[ 'bm_instagram_show_btn' ],
        'buttoncolor' => $options[ 'bm_instagram_btn_background' ],
        'buttontextcolor' => $options[ 'bm_instagram_btn_text_color' ],
        'buttontext' => $options[ 'bm_instagram_btn_text' ],
        'imageres' => $options[ 'bm_instagram_image_res' ],
        'showfollow' => $options[ 'bm_instagram_show_follow_btn' ],
        'followcolor' => $options[ 'bm_instagram_follow_btn_background' ],
        'followtextcolor' => $options[ 'bm_instagram_follow_btn_text_color' ],
        'followtext' => $options[ 'bm_instagram_follow_btn_text' ],
        'showheader' => $options[ 'bm_instagram_show_header' ],
        'headercolor' => $options[ 'bm_instagram_header_color' ],
        'class' => '',
        'ajaxtheme' => $options[ 'bm_instagram_ajax_theme' ]
    ), $atts);


    /******************* VARS ********************/

    //User ID
    $bm_instagram_user_id = trim($atts['id']);

    //Container styles
    $bm_instagram_width = $atts['width'];
    $bm_instagram_width_unit = $atts['widthunit'];
    $bm_instagram_height = $atts['height'];
    $bm_instagram_height_unit = $atts['heightunit'];
    $bm_instagram_image_padding = $atts['imagepadding'];
    $bm_instagram_image_padding_unit = $atts['imagepaddingunit'];
    $bm_instagram_background = $atts['background'];

    //Layout options
    $bm_instagram_cols = $atts['cols'];

    $bm_instagram_styles = 'style="';
    if($bm_instagram_cols == 1) $bm_instagram_styles .= 'max-width: 640px; ';
    if ( !empty($bm_instagram_width) ) $bm_instagram_styles .= 'width:' . $bm_instagram_width . $bm_instagram_width_unit .'; ';
    if ( !empty($bm_instagram_height) && $bm_instagram_height != '0' ) $bm_instagram_styles .= 'height:' . $bm_instagram_height . $bm_instagram_height_unit .'; ';
    if ( !empty($bm_instagram_background) ) $bm_instagram_styles .= 'background-color: ' . $bm_instagram_background . '; ';
    if ( !empty($bm_instagram_image_padding) ) $bm_instagram_styles .= 'padding-bottom: ' . (2*intval($bm_instagram_image_padding)).$bm_instagram_image_padding_unit . '; ';
    $bm_instagram_styles .= '"';

    //Header
    $bm_instagram_show_header = $atts['showheader'];
    ( $bm_instagram_show_header == 'on' || $bm_instagram_show_header == 'true' || $bm_instagram_show_header == true ) ? $bm_instagram_show_header = true : $bm_instagram_show_header = false;
    if( $atts[ 'showheader' ] === 'false' ) $bm_instagram_show_header = false;
    $bm_instagram_header_color = str_replace('#', '', $atts['headercolor']);

    //Load more button
    $bm_instagram_show_btn = $atts['showbutton'];
    ( $bm_instagram_show_btn == 'on' || $bm_instagram_show_btn == 'true' || $bm_instagram_show_btn == true ) ? $bm_instagram_show_btn = true : $bm_instagram_show_btn = false;
    if( $atts[ 'showbutton' ] === 'false' ) $bm_instagram_show_btn = false;
    $bm_instagram_btn_background = str_replace('#', '', $atts['buttoncolor']);
    $bm_instagram_btn_text_color = str_replace('#', '', $atts['buttontextcolor']);
    //Load more button styles
    $bm_instagram_button_styles = 'style="';
    if ( !empty($bm_instagram_btn_background) ) $bm_instagram_button_styles .= 'background: #'.$bm_instagram_btn_background.'; ';
    if ( !empty($bm_instagram_btn_text_color) ) $bm_instagram_button_styles .= 'color: #'.$bm_instagram_btn_text_color.';';
    $bm_instagram_button_styles .= '"';

    //Follow button vars
    $bm_instagram_show_follow_btn = $atts['showfollow'];
    ( $bm_instagram_show_follow_btn == 'on' || $bm_instagram_show_follow_btn == 'true' || $bm_instagram_show_follow_btn == true ) ? $bm_instagram_show_follow_btn = true : $bm_instagram_show_follow_btn = false;
    if( $atts[ 'showfollow' ] === 'false' ) $bm_instagram_show_follow_btn = false;
    $bm_instagram_follow_btn_background = str_replace('#', '', $atts['followcolor']);
    $bm_instagram_follow_btn_text_color = str_replace('#', '', $atts['followtextcolor']);
    $bm_instagram_follow_btn_text = $atts['followtext'];
    //Follow button styles
    $bm_instagram_follow_btn_styles = 'style="';
    if ( !empty($bm_instagram_follow_btn_background) ) $bm_instagram_follow_btn_styles .= 'background: #'.$bm_instagram_follow_btn_background.'; ';
    if ( !empty($bm_instagram_follow_btn_text_color) ) $bm_instagram_follow_btn_styles .= 'color: #'.$bm_instagram_follow_btn_text_color.';';
    $bm_instagram_follow_btn_styles .= '"';
    //Follow button HTML
    $bm_instagram_follow_btn_html = '<div class="bmi_follow_btn"><a href="http://instagram.com/" '.$bm_instagram_follow_btn_styles.' target="_blank"><i class="fa fa-instagram"></i>'.$bm_instagram_follow_btn_text.'</a></div>';


    //Mobile
    $bm_instagram_disable_mobile = $atts['disablemobile'];
    ( $bm_instagram_disable_mobile == 'on' || $bm_instagram_disable_mobile == 'true' || $bm_instagram_disable_mobile == true ) ? $bm_instagram_disable_mobile = ' bmi_disable_mobile' : $bm_instagram_disable_mobile = '';
    if( $atts[ 'disablemobile' ] === 'false' ) $bm_instagram_disable_mobile = '';

    //Class
    !empty( $atts['class'] ) ? $bmi_class = ' ' . trim($atts['class']) : $bmi_class = '';

    //Ajax theme
    $bm_instagram_ajax_theme = $atts['ajaxtheme'];
    ( $bm_instagram_ajax_theme == 'on' || $bm_instagram_ajax_theme == 'true' || $bm_instagram_ajax_theme == true ) ? $bm_instagram_ajax_theme = true : $bm_instagram_ajax_theme = false;
    if( $atts[ 'disablemobile' ] === 'false' ) $bm_instagram_ajax_theme = false;


    /******************* CONTENT ********************/

    $bm_instagram_content = '<div id="bm_instagram" class="bmi' . $bmi_class . $bm_instagram_disable_mobile;
    if ( !empty($bm_instagram_height) ) $bm_instagram_content .= ' bmi_fixed_height ';
    $bm_instagram_content .= ' bmi_col_' . trim($bm_instagram_cols);
    $bm_instagram_content .= '" '.$bm_instagram_styles .' data-id="' . $bm_instagram_user_id . '" data-num="' . trim($atts['num']) . '" data-res="' . trim($atts['imageres']) . '" data-cols="' . trim($bm_instagram_cols) . '" data-options=\'{&quot;sortby&quot;: &quot;'.$atts['sortby'].'&quot;, &quot;headercolor&quot;: &quot;'.$bm_instagram_header_color.'&quot;}\'>';

    //Header
    if( $bm_instagram_show_header ) $bm_instagram_content .= '<div class="bm_instagram_header" style="padding: '.(2*intval($bm_instagram_image_padding)) . $bm_instagram_image_padding_unit .'; padding-bottom: 0;"></div>';

    //Images container
    $bm_instagram_content .= '<div id="bmi_images" style="padding: '.$bm_instagram_image_padding . $bm_instagram_image_padding_unit .';">';

    //Loader
    $bm_instagram_content .= '<div class="bmi_loader fa-spin"></div>';

    //Error messages
    if( empty($bm_instagram_user_id) || !isset($bm_instagram_user_id) ) $bm_instagram_content .= '<p>Please enter a User ID on the Instagram Feed plugin Settings page</p>';

    if( empty($options[ 'bm_instagram_at' ]) || !isset($options[ 'bm_instagram_at' ]) ) $bm_instagram_content .= '<p>Please enter an Access Token on the Instagram Feed plugin Settings page</p>';

    //Load section
    $bm_instagram_content .= '</div><div id="bmi_load"';
    if($bm_instagram_image_padding == 0 || !isset($bm_instagram_image_padding)) $bm_instagram_content .= ' style="padding-top: 5px"';
    $bm_instagram_content .= '>';

    //Load More button
    if( $bm_instagram_show_btn ) $bm_instagram_content .= '<a class="bmi_load_btn" href="javascript:void(0);" '.$bm_instagram_button_styles.'>'.$atts['buttontext'].'</a>';

    //Follow button
    if( $bm_instagram_show_follow_btn ) $bm_instagram_content .= $bm_instagram_follow_btn_html;

    $bm_instagram_content .= '</div>'; //End #bmi_load
    
    $bm_instagram_content .= '</div>'; //End #bm_instagram

    //If using an ajax theme then add the JS to the bottom of the feed
    if($bm_instagram_ajax_theme){
        $bm_instagram_content .= '<script type="text/javascript">var bm_instagram_js_options = {"bm_instagram_at":"'.trim($options['bm_instagram_at']).'"};</script>';
        $bm_instagram_content .= "<script type='text/javascript' src='".plugins_url( '/js/bm-instagram.js?9' , __FILE__ )."'></script>";
    }
 
    //Return our feed HTML to display
    return $bm_instagram_content;

}


#############################

//Allows shortcodes in theme
add_filter('widget_text', 'do_shortcode');

//Enqueue stylesheet
add_action( 'wp_enqueue_scripts', 'bm_instagram_styles_enqueue' );
function bm_instagram_styles_enqueue() {
    wp_register_style( 'bm_instagram_styles', plugins_url('css/bm-instagram.css?9', __FILE__) );
    wp_enqueue_style( 'bm_instagram_styles' );
    wp_enqueue_style( 'bm_instagram_icons', '//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css?1', array(), '4.2.0' );
}

//Enqueue scripts
add_action( 'wp_enqueue_scripts', 'bm_instagram_scripts_enqueue' );
function bm_instagram_scripts_enqueue() {
    //Register the script to make it available
    wp_register_script( 'bm_instagram_scripts', plugins_url( '/js/bm-instagram.js?9' , __FILE__ ), array('jquery'), '1.8', true );

    //Options to pass to JS file
    $bm_instagram_settings = get_option('bm_instagram_settings');
    $data = array(
        'bm_instagram_at' => trim($bm_instagram_settings['bm_instagram_at'])
    );

    $bm_instagram_ajax_theme = $bm_instagram_settings[ 'bm_instagram_ajax_theme' ];
    ( $bm_instagram_ajax_theme == 'on' || $bm_instagram_ajax_theme == 'true' || $bm_instagram_ajax_theme == true ) ? $bm_instagram_ajax_theme = true : $bm_instagram_ajax_theme = false;

    //Enqueue it to load it onto the page
    if( !$bm_instagram_ajax_theme ) wp_enqueue_script('bm_instagram_scripts');

    //Pass option to JS file
    wp_localize_script('bm_instagram_scripts', 'bm_instagram_js_options', $data);
}

//Custom CSS
add_action( 'wp_head', 'bm_instagram_custom_css' );
function bm_instagram_custom_css() {
    $options = get_option('bm_instagram_settings');
    $bm_instagram_custom_css = $options[ 'bm_instagram_custom_css' ];

    //Show CSS if an admin (so can see Hide Photos link), if including Custom CSS or if hiding some photos
    ( current_user_can( 'manage_options' ) || !empty($bm_instagram_custom_css) ) ? $bmi_show_css = true : $bmi_show_css = false;

    if( $bmi_show_css ) echo '<!-- Instagram Feed CSS -->';
    if( $bmi_show_css ) echo "\r\n";
    if( $bmi_show_css ) echo '<style type="text/css">';

    if( !empty($bm_instagram_custom_css) ){
        echo "\r\n";
        echo stripslashes($bm_instagram_custom_css);
    }

    if( current_user_can( 'manage_options' ) ){
        echo "\r\n";
        echo "#bmi_mod_error{ display: block; }";
    }

    if( $bmi_show_css ) echo "\r\n";
    if( $bmi_show_css ) echo '</style>';
    if( $bmi_show_css ) echo "\r\n";
}


//Custom JS
add_action( 'wp_footer', 'bm_instagram_custom_js' );
function bm_instagram_custom_js() {
    $options = get_option('bm_instagram_settings');
    $bm_instagram_custom_js = $options[ 'bm_instagram_custom_js' ];

    if( !empty($bm_instagram_custom_js) ) echo '<!-- Instagram Feed JS -->';
    if( !empty($bm_instagram_custom_js) ) echo "\r\n";
    if( !empty($bm_instagram_custom_js) ) echo '<script type="text/javascript">';
    if( !empty($bm_instagram_custom_js) ) echo "\r\n";
    if( !empty($bm_instagram_custom_js) ) echo "jQuery( document ).ready(function($) {";
    if( !empty($bm_instagram_custom_js) ) echo "\r\n";
    if( !empty($bm_instagram_custom_js) ) echo "window.bmi_custom_js = function(){";
    if( !empty($bm_instagram_custom_js) ) echo "\r\n";
    if( !empty($bm_instagram_custom_js) ) echo stripslashes($bm_instagram_custom_js);
    if( !empty($bm_instagram_custom_js) ) echo "\r\n";
    if( !empty($bm_instagram_custom_js) ) echo "}";
    if( !empty($bm_instagram_custom_js) ) echo "\r\n";
    if( !empty($bm_instagram_custom_js) ) echo "});";
    if( !empty($bm_instagram_custom_js) ) echo "\r\n";
    if( !empty($bm_instagram_custom_js) ) echo '</script>';
    if( !empty($bm_instagram_custom_js) ) echo "\r\n";
}

//Run function on plugin activate
function bm_instagram_activate() {
    $options = get_option('bm_instagram_settings');
    $options[ 'bm_instagram_show_btn' ] = true;
    $options[ 'bm_instagram_show_header' ] = true;
    $options[ 'bm_instagram_show_follow_btn' ] = true;
    update_option( 'bm_instagram_settings', $options );
}
register_activation_hook( __FILE__, 'bm_instagram_activate' );

//Uninstall
function bm_instagram_uninstall()
{
    if ( ! current_user_can( 'activate_plugins' ) )
        return;

    //If the user is preserving the settings then don't delete them
    $options = get_option('bm_instagram_settings');
    $bm_instagram_preserve_settings = $options[ 'bm_instagram_preserve_settings' ];
    if($bm_instagram_preserve_settings) return;

    //Settings
    delete_option( 'bm_instagram_settings' );
}
register_uninstall_hook( __FILE__, 'bm_instagram_uninstall' );

error_reporting(0);
?>
