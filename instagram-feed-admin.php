<?php

function bm_instagram_menu() {
    add_menu_page(
        'Instagram by Imagesta',
        'Instagram by Imagesta',
        'manage_options',
        'bm-instagram-feed',
        'bm_instagram_settings_page'
    );
}
add_action('admin_menu', 'bm_instagram_menu');

function bm_instagram_settings_page() {

    //Hidden fields
    $bm_instagram_settings_hidden_field = 'bm_instagram_settings_hidden_field';
    $bm_instagram_configure_hidden_field = 'bm_instagram_configure_hidden_field';
    $bm_instagram_customize_hidden_field = 'bm_instagram_customize_hidden_field';

    //Declare defaults
    $bm_instagram_settings_defaults = array(
        'bm_instagram_at'                   => '',
        'bm_instagram_user_id'              => '',
        'bm_instagram_preserve_settings'    => '',
        'bm_instagram_ajax_theme'           => false,
        'bm_instagram_width'                => '100',
        'bm_instagram_width_unit'           => '%',
        'bm_instagram_height'               => '',
        'bm_instagram_num'                  => '20',
        'bm_instagram_height_unit'          => '',
        'bm_instagram_cols'                 => '4',
        'bm_instagram_disable_mobile'       => false,
        'bm_instagram_image_padding'        => '5',
        'bm_instagram_image_padding_unit'   => 'px',
        'bm_instagram_sort'                 => 'none',
        'bm_instagram_background'           => '',
        'bm_instagram_show_btn'             => true,
        'bm_instagram_btn_background'       => '',
        'bm_instagram_btn_text_color'       => '',
        'bm_instagram_btn_text'             => 'Load More...',
        'bm_instagram_image_res'            => 'auto',
        //Header
        'bm_instagram_show_header'          => true,
        'bm_instagram_header_color'         => '',
        //Follow button
        'bm_instagram_show_follow_btn'      => true,
        'bm_instagram_follow_btn_background' => '',
        'bm_instagram_follow_btn_text_color' => '',
        'bm_instagram_follow_btn_text'      => 'Follow on Instagram',
        //Misc
        'bm_instagram_custom_css'           => '',
        'bm_instagram_custom_js'            => ''
    );
    //Save defaults in an array
    $options = wp_parse_args(get_option('bm_instagram_settings'), $bm_instagram_settings_defaults);
    update_option( 'bm_instagram_settings', $options );

    //Set the page variables
    $bm_instagram_at = $options[ 'bm_instagram_at' ];
    $bm_instagram_user_id = $options[ 'bm_instagram_user_id' ];
    $bm_instagram_preserve_settings = $options[ 'bm_instagram_preserve_settings' ];
    $bm_instagram_ajax_theme = $options[ 'bm_instagram_ajax_theme' ];
    $bm_instagram_width = $options[ 'bm_instagram_width' ];
    $bm_instagram_width_unit = $options[ 'bm_instagram_width_unit' ];
    $bm_instagram_height = $options[ 'bm_instagram_height' ];
    $bm_instagram_height_unit = $options[ 'bm_instagram_height_unit' ];
    $bm_instagram_num = $options[ 'bm_instagram_num' ];
    $bm_instagram_cols = $options[ 'bm_instagram_cols' ];
    $bm_instagram_disable_mobile = $options[ 'bm_instagram_disable_mobile' ];
    $bm_instagram_image_padding = $options[ 'bm_instagram_image_padding' ];
    $bm_instagram_image_padding_unit = $options[ 'bm_instagram_image_padding_unit' ];
    $bm_instagram_sort = $options[ 'bm_instagram_sort' ];
    $bm_instagram_background = $options[ 'bm_instagram_background' ];
    $bm_instagram_show_btn = $options[ 'bm_instagram_show_btn' ];
    $bm_instagram_btn_background = $options[ 'bm_instagram_btn_background' ];
    $bm_instagram_btn_text_color = $options[ 'bm_instagram_btn_text_color' ];
    $bm_instagram_btn_text = $options[ 'bm_instagram_btn_text' ];
    $bm_instagram_image_res = $options[ 'bm_instagram_image_res' ];
    //Header
    $bm_instagram_show_header = $options[ 'bm_instagram_show_header' ];
    $bm_instagram_header_color = $options[ 'bm_instagram_header_color' ];
    //Follow button
    $bm_instagram_show_follow_btn = $options[ 'bm_instagram_show_follow_btn' ];
    $bm_instagram_follow_btn_background = $options[ 'bm_instagram_follow_btn_background' ];
    $bm_instagram_follow_btn_text_color = $options[ 'bm_instagram_follow_btn_text_color' ];
    $bm_instagram_follow_btn_text = $options[ 'bm_instagram_follow_btn_text' ];
    //Misc
    $bm_instagram_custom_css = $options[ 'bm_instagram_custom_css' ];
    $bm_instagram_custom_js = $options[ 'bm_instagram_custom_js' ];

    // See if the user has posted us some information. If they did, this hidden field will be set to 'Y'.
    if( isset($_POST[ $bm_instagram_settings_hidden_field ]) && $_POST[ $bm_instagram_settings_hidden_field ] == 'Y' ) {

        if( isset($_POST[ $bm_instagram_configure_hidden_field ]) && $_POST[ $bm_instagram_configure_hidden_field ] == 'Y' ) {
            $bm_instagram_at = $_POST[ 'bm_instagram_at' ];
            $bm_instagram_user_id = $_POST[ 'bm_instagram_user_id' ];
            isset($_POST[ 'bm_instagram_preserve_settings' ]) ? $bm_instagram_preserve_settings = $_POST[ 'bm_instagram_preserve_settings' ] : $bm_instagram_preserve_settings = '';
            isset($_POST[ 'bm_instagram_ajax_theme' ]) ? $bm_instagram_ajax_theme = $_POST[ 'bm_instagram_ajax_theme' ] : $bm_instagram_ajax_theme = '';

            $options[ 'bm_instagram_at' ] = $bm_instagram_at;
            $options[ 'bm_instagram_user_id' ] = $bm_instagram_user_id;
            $options[ 'bm_instagram_preserve_settings' ] = $bm_instagram_preserve_settings;
            $options[ 'bm_instagram_ajax_theme' ] = $bm_instagram_ajax_theme;
        } //End config tab post

        if( isset($_POST[ $bm_instagram_customize_hidden_field ]) && $_POST[ $bm_instagram_customize_hidden_field ] == 'Y' ) {
            $bm_instagram_width = $_POST[ 'bm_instagram_width' ];
            $bm_instagram_width_unit = $_POST[ 'bm_instagram_width_unit' ];
            $bm_instagram_height = $_POST[ 'bm_instagram_height' ];
            $bm_instagram_height_unit = $_POST[ 'bm_instagram_height_unit' ];
            $bm_instagram_num = $_POST[ 'bm_instagram_num' ];
            $bm_instagram_cols = $_POST[ 'bm_instagram_cols' ];
            isset($_POST[ 'bm_instagram_disable_mobile' ]) ? $bm_instagram_disable_mobile = $_POST[ 'bm_instagram_disable_mobile' ] : $bm_instagram_disable_mobile = '';

            $bm_instagram_image_padding = $_POST[ 'bm_instagram_image_padding' ];
            $bm_instagram_image_padding_unit = $_POST[ 'bm_instagram_image_padding_unit' ];
            $bm_instagram_sort = $_POST[ 'bm_instagram_sort' ];
            $bm_instagram_background = $_POST[ 'bm_instagram_background' ];
            isset($_POST[ 'bm_instagram_show_btn' ]) ? $bm_instagram_show_btn = $_POST[ 'bm_instagram_show_btn' ] : $bm_instagram_show_btn = '';
            $bm_instagram_btn_background = $_POST[ 'bm_instagram_btn_background' ];
            $bm_instagram_btn_text_color = $_POST[ 'bm_instagram_btn_text_color' ];
            $bm_instagram_btn_text = $_POST[ 'bm_instagram_btn_text' ];
            $bm_instagram_image_res = $_POST[ 'bm_instagram_image_res' ];
            //Header
            isset($_POST[ 'bm_instagram_show_header' ]) ? $bm_instagram_show_header = $_POST[ 'bm_instagram_show_header' ] : $bm_instagram_show_header = '';
            $bm_instagram_header_color = $_POST[ 'bm_instagram_header_color' ];
            //Follow button
            isset($_POST[ 'bm_instagram_show_follow_btn' ]) ? $bm_instagram_show_follow_btn = $_POST[ 'bm_instagram_show_follow_btn' ] : $bm_instagram_show_follow_btn = '';
            $bm_instagram_follow_btn_background = $_POST[ 'bm_instagram_follow_btn_background' ];
            $bm_instagram_follow_btn_text_color = $_POST[ 'bm_instagram_follow_btn_text_color' ];
            $bm_instagram_follow_btn_text = $_POST[ 'bm_instagram_follow_btn_text' ];
            //Misc
            $bm_instagram_custom_css = $_POST[ 'bm_instagram_custom_css' ];
            $bm_instagram_custom_js = $_POST[ 'bm_instagram_custom_js' ];

            $options[ 'bm_instagram_width' ] = $bm_instagram_width;
            $options[ 'bm_instagram_width_unit' ] = $bm_instagram_width_unit;
            $options[ 'bm_instagram_height' ] = $bm_instagram_height;
            $options[ 'bm_instagram_height_unit' ] = $bm_instagram_height_unit;
            $options[ 'bm_instagram_num' ] = $bm_instagram_num;
            $options[ 'bm_instagram_cols' ] = $bm_instagram_cols;
            $options[ 'bm_instagram_disable_mobile' ] = $bm_instagram_disable_mobile;
            $options[ 'bm_instagram_image_padding' ] = $bm_instagram_image_padding;
            $options[ 'bm_instagram_image_padding_unit' ] = $bm_instagram_image_padding_unit;
            $options[ 'bm_instagram_sort' ] = $bm_instagram_sort;
            $options[ 'bm_instagram_background' ] = $bm_instagram_background;
            $options[ 'bm_instagram_show_btn' ] = $bm_instagram_show_btn;
            $options[ 'bm_instagram_btn_background' ] = $bm_instagram_btn_background;
            $options[ 'bm_instagram_btn_text_color' ] = $bm_instagram_btn_text_color;
            $options[ 'bm_instagram_btn_text' ] = $bm_instagram_btn_text;
            $options[ 'bm_instagram_image_res' ] = $bm_instagram_image_res;
            //Header
            $options[ 'bm_instagram_show_header' ] = $bm_instagram_show_header;
            $options[ 'bm_instagram_header_color' ] = $bm_instagram_header_color;
            //Follow button
            $options[ 'bm_instagram_show_follow_btn' ] = $bm_instagram_show_follow_btn;
            $options[ 'bm_instagram_follow_btn_background' ] = $bm_instagram_follow_btn_background;
            $options[ 'bm_instagram_follow_btn_text_color' ] = $bm_instagram_follow_btn_text_color;
            $options[ 'bm_instagram_follow_btn_text' ] = $bm_instagram_follow_btn_text;
            //Misc
            $options[ 'bm_instagram_custom_css' ] = $bm_instagram_custom_css;
            $options[ 'bm_instagram_custom_js' ] = $bm_instagram_custom_js;
            
        } //End customize tab post
        
        //Save the settings to the settings array
        update_option( 'bm_instagram_settings', $options );

    ?>
    <div class="updated"><p><strong><?php _e('Settings saved.', 'instagram-feed' ); ?></strong></p></div>
    <?php } ?>


    <div id="bmi_admin" class="wrap">

        <div id="header">
            <h2><?php _e('Instagram by Imagesta'); ?></h2>
        </div>
    
        <form name="form1" method="post" action="">
            <input type="hidden" name="<?php echo $bm_instagram_settings_hidden_field; ?>" value="Y">

            <?php $bmi_active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'configure'; ?>
            <h2 class="nav-tab-wrapper">
                <a href="?page=bm-instagram-feed&amp;tab=configure" class="nav-tab <?php echo $bmi_active_tab == 'configure' ? 'nav-tab-active' : ''; ?>"><?php _e('1. Configure'); ?></a>
                <a href="?page=bm-instagram-feed&amp;tab=customize" class="nav-tab <?php echo $bmi_active_tab == 'customize' ? 'nav-tab-active' : ''; ?>"><?php _e('2. Customize'); ?></a>
                <a href="?page=bm-instagram-feed&amp;tab=display" class="nav-tab <?php echo $bmi_active_tab == 'display' ? 'nav-tab-active' : ''; ?>"><?php _e('3. Display Your Feed'); ?></a>
            </h2>

            <?php if( $bmi_active_tab == 'configure' ) { //Start Configure tab ?>
            <input type="hidden" name="<?php echo $bm_instagram_configure_hidden_field; ?>" value="Y">

            <table class="form-table">
                <tbody>
                    <h3><?php _e('Configure'); ?></h3>

                    <div id="bmi_config">
                        <a href="https://instagram.com/oauth/authorize/?client_id=0b4049ec482648618883ec169b0fbba3&redirect_uri=http://localhost?return_uri=<?php echo admin_url('admin.php?page=bm-instagram-feed'); ?>&response_type=token" class="bmi_admin_btn"><?php _e('| Get my Access Token'); ?></a>
                    </div>
                    
                    <tr valign="top">
                        <th scope="row"><label><?php _e('Access Token'); ?></label></th>
                        <td>
                            <input name="bm_instagram_at" id="bm_instagram_at" type="text" value="<?php esc_attr_e( $bm_instagram_at ); ?>" size="60" placeholder="Click the button to get your Access Token" />
                            &nbsp;<a class="bmi_tooltip_link" href="JavaScript:void(0);"><?php _e("Help me with this."); ?></a>
                            <p class="bmi_tooltip"><?php _e("In order to display your photos you need an Access Token from Instagram.<br /> To get yours, click '<strong>Instagram | Get my Access Token</strong>'<br /><br /> If you're not already signed in your Instagram account, then '<strong>Instagram | Get my Access Token</strong>' will open the Instagram login page.<br /> Log on Instagram to make the next step available.<br /><br /> '<strong>Instagram | Get my Access Token</strong>' will open a localhost webpage.<br /> Look in the address bar, and copy the digits that show after <strong>access_token=</strong><br /> The digits are your Access Token.<br />Paste those digits into the Access Token text box."); ?></p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label><?php _e('Show Photos From:'); ?>
                        
                        </label></th>
                        <td>
                            <span>
                                <?php $bm_instagram_type = 'user'; ?>
                                <input type="radio" name="bm_instagram_type" id="bm_instagram_type_user" value="user" <?php if($bm_instagram_type == "user") echo "checked"; ?> />
                                <label class="bmi_radio_label" for="bm_instagram_type_user">User ID(s):</label>
                                <input name="bm_instagram_user_id" id="bm_instagram_user_id" type="text" value="<?php esc_attr_e( $bm_instagram_user_id ); ?>" size="25" />
                                &nbsp;<a class="bmi_tooltip_link" href="JavaScript:void(0);"><?php _e("Help me with this."); ?></a>
                                <p class="bmi_tooltip"><?php _e("These are the IDs of the Instagram accounts that you want to display photos from.<br /> To get your ID, use <a href='http://www.otzberg.net/iguserid/' target='_blank'>this website</a>.<br /> You can also separate multiple IDs with commas."); ?></p><br />
                            </span>

                    <tr>
                        <th class="bump-left"><label for="bm_instagram_preserve_settings" class="bump-left"><?php _e("Preserve settings when plugin is removed"); ?></label></th>
                        <td>
                            <input name="bm_instagram_preserve_settings" type="checkbox" id="bm_instagram_preserve_settings" <?php if($bm_instagram_preserve_settings == true) echo "checked"; ?> />
                            <label for="bm_instagram_preserve_settings"><?php _e('Yes'); ?></label>
                            <a class="bmi_tooltip_link" href="JavaScript:void(0);"><?php _e('What does this mean?'); ?></a>
                            <p class="bmi_tooltip"><?php _e('When removing the plugin your settings are automatically erased.<br /> Checking this box will prevent any settings from being deleted.<br /> This means that you can uninstall and reinstall the plugin without losing your settings.'); ?></p>
                        </td>
                    </tr>

                    <tr>
                        <th class="bump-left"><label for="bm_instagram_ajax_theme" class="bump-left"><?php _e("Are you using an Ajax powered theme?"); ?></label></th>
                        <td>
                            <input name="bm_instagram_ajax_theme" type="checkbox" id="bm_instagram_ajax_theme" <?php if($bm_instagram_ajax_theme == true) echo "checked"; ?> />
                            <label for="bm_instagram_ajax_theme"><?php _e('Yes'); ?></label>
                            <a class="bmi_tooltip_link" href="JavaScript:void(0);"><?php _e('What does this mean?'); ?></a>
                            <p class="bmi_tooltip"><?php _e("If your WordPress theme uses Ajax, and your page doesn't refresh, then check this setting.<br /> If you're not sure then please check with the theme author."); ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <?php submit_button(); ?>
        </form>

        <p><?php _e('Next Step: <a href="?page=bm-instagram-feed&tab=customize">Customize your Feed</a>'); ?></p>


    <?php } // End Configure tab ?>


    <?php if( $bmi_active_tab == 'customize' ) { //Start Customize tab ?>
    <input type="hidden" name="<?php echo $bm_instagram_customize_hidden_field; ?>" value="Y">

        <h3><?php _e('Customize'); ?></h3>

        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Width of Feed'); ?></label></th>
                    <td>
                        <input name="bm_instagram_width" type="text" value="<?php esc_attr_e( $bm_instagram_width ); ?>" size="4" />
                        <select name="bm_instagram_width_unit">
                            <option value="px" <?php if($bm_instagram_width_unit == "px") echo 'selected="selected"' ?> ><?php _e('px'); ?></option>
                            <option value="%" <?php if($bm_instagram_width_unit == "%") echo 'selected="selected"' ?> ><?php _e('%'); ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Height of Feed'); ?></label></th>
                    <td>
                        <input name="bm_instagram_height" type="text" value="<?php esc_attr_e( $bm_instagram_height ); ?>" size="4" />
                        <select name="bm_instagram_height_unit">
                            <option value="px" <?php if($bm_instagram_height_unit == "px") echo 'selected="selected"' ?> ><?php _e('px'); ?></option>
                            <option value="%" <?php if($bm_instagram_height_unit == "%") echo 'selected="selected"' ?> ><?php _e('%'); ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Background Color'); ?></label></th>
                    <td>
                        <input name="bm_instagram_background" type="text" value="<?php esc_attr_e( $bm_instagram_background ); ?>" class="bmi_colorpick" />
                    </td>
                </tr>
            </tbody>
        </table>

        <?php submit_button(); ?>

        <hr />
        <h3><?php _e('Photos'); ?></h3>

        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Sort Photos By'); ?></label></th>
                    <td>
                        <select name="bm_instagram_sort">
                            <option value="none" <?php if($bm_instagram_sort == "none") echo 'selected="selected"' ?> ><?php _e('Newest to oldest'); ?></option>
                            <!-- <option value="most-recent" <?php if($bm_instagram_sort == "most-recent") echo 'selected="selected"' ?> ><?php _e('Newest to Oldest'); ?></option>
                            <option value="least-recent" <?php if($bm_instagram_sort == "least-recent") echo 'selected="selected"' ?> ><?php _e('Oldest to newest'); ?></option>
                            <option value="most-liked" <?php if($bm_instagram_sort == "most-liked") echo 'selected="selected"' ?> ><?php _e('Most liked first'); ?></option>
                            <option value="least-liked" <?php if($bm_instagram_sort == "least-liked") echo 'selected="selected"' ?> ><?php _e('Least liked first'); ?></option>
                            <option value="most-commented" <?php if($bm_instagram_sort == "most-commented") echo 'selected="selected"' ?> ><?php _e('Most commented first'); ?></option>
                            <option value="least-commented" <?php if($bm_instagram_sort == "least-commented") echo 'selected="selected"' ?> ><?php _e('Least commented first'); ?></option> -->
                            <option value="random" <?php if($bm_instagram_sort == "random") echo 'selected="selected"' ?> ><?php _e('Random'); ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Number of Photos'); ?></label></th>
                    <td>
                        <input name="bm_instagram_num" type="text" value="<?php esc_attr_e( $bm_instagram_num ); ?>" size="4" />
                        <span class="bmi_note"><?php _e('Number of photos to show initially. Maximum of 33.'); ?></span>
                        &nbsp;<a class="bmi_tooltip_link" href="JavaScript:void(0);"><?php _e("Using multiple IDs or hashtags?"); ?></a>
                            <p class="bmi_tooltip"><?php _e("This is the number of photos which will be displayed from each ID."); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Number of Columns'); ?></label></th>
                    <td>

                        <select name="bm_instagram_cols">
                            <option value="1" <?php if($bm_instagram_cols == "1") echo 'selected="selected"' ?> ><?php _e('1'); ?></option>
                            <option value="2" <?php if($bm_instagram_cols == "2") echo 'selected="selected"' ?> ><?php _e('2'); ?></option>
                            <option value="3" <?php if($bm_instagram_cols == "3") echo 'selected="selected"' ?> ><?php _e('3'); ?></option>
                            <option value="4" <?php if($bm_instagram_cols == "4") echo 'selected="selected"' ?> ><?php _e('4'); ?></option>
                            <option value="5" <?php if($bm_instagram_cols == "5") echo 'selected="selected"' ?> ><?php _e('5'); ?></option>
                            <option value="6" <?php if($bm_instagram_cols == "6") echo 'selected="selected"' ?> ><?php _e('6'); ?></option>
                            <option value="7" <?php if($bm_instagram_cols == "7") echo 'selected="selected"' ?> ><?php _e('7'); ?></option>
                            <option value="8" <?php if($bm_instagram_cols == "8") echo 'selected="selected"' ?> ><?php _e('8'); ?></option>
                            <option value="9" <?php if($bm_instagram_cols == "9") echo 'selected="selected"' ?> ><?php _e('9'); ?></option>
                            <option value="10" <?php if($bm_instagram_cols == "10") echo 'selected="selected"' ?> ><?php _e('10'); ?></option>
                        </select>

                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Image Resolution'); ?></label></th>
                    <td>

                        <select name="bm_instagram_image_res">
                            <option value="auto" <?php if($bm_instagram_image_res == "auto") echo 'selected="selected"' ?> ><?php _e('Auto-detect (recommended)'); ?></option>
                            <option value="thumb" <?php if($bm_instagram_image_res == "thumb") echo 'selected="selected"' ?> ><?php _e('Thumbnail (150x150)'); ?></option>
                            <option value="medium" <?php if($bm_instagram_image_res == "medium") echo 'selected="selected"' ?> ><?php _e('Medium (306x306)'); ?></option>
                            <option value="full" <?php if($bm_instagram_image_res == "full") echo 'selected="selected"' ?> ><?php _e('Full size (640x640)'); ?></option>
                        </select>

                        &nbsp;<a class="bmi_tooltip_link" href="JavaScript:void(0);"><?php _e("What does Auto-detect mean?"); ?></a>
                            <p class="bmi_tooltip"><?php _e("Auto-detect means that the plugin sets the image resolution based on the size of your feed."); ?></p>

                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Padding around Images'); ?></label></th>
                    <td>
                        <input name="bm_instagram_image_padding" type="text" value="<?php esc_attr_e( $bm_instagram_image_padding ); ?>" size="4" />
                        <select name="bm_instagram_image_padding_unit">
                            <option value="px" <?php if($bm_instagram_image_padding_unit == "px") echo 'selected="selected"' ?> ><?php _e('px'); ?></option>
                            <option value="%" <?php if($bm_instagram_image_padding_unit == "%") echo 'selected="selected"' ?> ><?php _e('%'); ?></option>
                        </select>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label><?php _e("Disable mobile layout"); ?></label></th>
                    <td>
                        <input type="checkbox" name="bm_instagram_disable_mobile" id="bm_instagram_disable_mobile" <?php if($bm_instagram_disable_mobile == true) echo 'checked="checked"' ?> />
                        &nbsp;<a class="bmi_tooltip_link" href="JavaScript:void(0);"><?php _e("What does this mean?"); ?></a>
                            <p class="bmi_tooltip"><?php _e("For mobile devices the layout changes to use fewer columns.<br /> Checking this setting disables the mobile layout."); ?></p>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php submit_button(); ?>

        <hr />
        <h3><?php _e("Header"); ?></h3>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label><?php _e("Show the Header"); ?></label></th>
                    <td>
                        <input type="checkbox" name="bm_instagram_show_header" id="bm_instagram_show_header" <?php if($bm_instagram_show_header == true) echo 'checked="checked"' ?> />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Header Text Color'); ?></label></th>
                    <td>
                        <input name="bm_instagram_header_color" type="text" value="<?php esc_attr_e( $bm_instagram_header_color ); ?>" class="bmi_colorpick" />
                    </td>
                </tr>
            </tbody>
        </table>

        <hr />
        <h3><?php _e("'Load More' Button"); ?></h3>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label><?php _e("Show the 'Load More' button"); ?></label></th>
                    <td>
                        <input type="checkbox" name="bm_instagram_show_btn" id="bm_instagram_show_btn" <?php if($bm_instagram_show_btn == true) echo 'checked="checked"' ?> />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Button Background Color'); ?></label></th>
                    <td>
                        <input name="bm_instagram_btn_background" type="text" value="<?php esc_attr_e( $bm_instagram_btn_background ); ?>" class="bmi_colorpick" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Button Text Color'); ?></label></th>
                    <td>
                        <input name="bm_instagram_btn_text_color" type="text" value="<?php esc_attr_e( $bm_instagram_btn_text_color ); ?>" class="bmi_colorpick" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Button Text'); ?></label></th>
                    <td>
                        <input name="bm_instagram_btn_text" type="text" value="<?php esc_attr_e( $bm_instagram_btn_text ); ?>" size="20" />
                    </td>
                </tr>
            </tbody>
        </table>

        <?php submit_button(); ?>

        <hr />
        <h3><?php _e("'Follow on Instagram' Button"); ?></h3>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label><?php _e("Show the Follow button"); ?></label></th>
                    <td>
                        <input type="checkbox" name="bm_instagram_show_follow_btn" id="bm_instagram_show_follow_btn" <?php if($bm_instagram_show_follow_btn == true) echo 'checked="checked"' ?> />
                    </td>
                </tr>

                <!-- <tr valign="top">
                    <th scope="row"><label><?php _e("Button Position"); ?></label></th>
                    <td>
                        <select name="bm_instagram_follow_btn_position">
                            <option value="top" <?php if($bm_instagram_follow_btn_position == "top") echo 'selected="selected"' ?> ><?php _e('Top'); ?></option>
                            <option value="bottom" <?php if($bm_instagram_follow_btn_position == "bottom") echo 'selected="selected"' ?> ><?php _e('Bottom'); ?></option>
                        </select>
                    </td>
                </tr> -->

                <tr valign="top">
                    <th scope="row"><label><?php _e('Button Background Color'); ?></label></th>
                    <td>
                        <input name="bm_instagram_follow_btn_background" type="text" value="<?php esc_attr_e( $bm_instagram_follow_btn_background ); ?>" class="bmi_colorpick" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Button Text Color'); ?></label></th>
                    <td>
                        <input name="bm_instagram_follow_btn_text_color" type="text" value="<?php esc_attr_e( $bm_instagram_follow_btn_text_color ); ?>" class="bmi_colorpick" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Button Text'); ?></label></th>
                    <td>
                        <input name="bm_instagram_follow_btn_text" type="text" value="<?php esc_attr_e( $bm_instagram_follow_btn_text ); ?>" size="30" />
                    </td>
                </tr>
            </tbody>
        </table>

        <?php submit_button(); ?>

        <hr />
        <h3><?php _e('Misc'); ?></h3>

        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <td style="padding-bottom: 0;">
                    <?php _e('<strong style="font-size: 15px;">Custom CSS</strong><br />Enter your own custom CSS in the box below'); ?>
                    </td>
                </tr>
                <tr valign="top">
                    <td>
                        <textarea name="bm_instagram_custom_css" id="bm_instagram_custom_css" style="width: 70%;" rows="7"><?php esc_attr_e( stripslashes($bm_instagram_custom_css) ); ?></textarea>
                    </td>
                </tr>
                <tr valign="top">
                    <td style="padding-bottom: 0;">
                    <?php _e('<strong style="font-size: 15px;">Custom JavaScript</strong><br />Enter your own custom JavaScript/jQuery in the box below'); ?>
                    </td>
                </tr>
                <tr valign="top">
                    <td>
                        <textarea name="bm_instagram_custom_js" id="bm_instagram_custom_js" style="width: 70%;" rows="7"><?php esc_attr_e( stripslashes($bm_instagram_custom_js) ); ?></textarea>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php submit_button(); ?>

    </form>

    <p><?php _e('Next Step: <a href="?page=bm-instagram-feed&tab=display">Display your Feed</a>'); ?></p>

    <?php } //End Customize tab ?>


    <?php if( $bmi_active_tab == 'display' ) { //Start Display tab ?>

        <h3><?php _e('Display your Feed'); ?></h3>
        <p><?php _e("Copy and paste the following shortcode directly into the page, post or widget where you would like the feed to show up:"); ?></p>
        <input type="text" value="[instagram-feed]" size="16" readonly="readonly" style="text-align: center;" onclick="this.focus();this.select()" title="<?php _e('To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac).'); ?>" />

        <p><?php _e("If you would like to display multiple feeds then you can set different settings directly in the shortcode like so:"); ?>
        <code>[instagram-feed num=9 cols=3]</code></p>
        <p>You can display as many different feeds as you like, on either the same page or on different pages, by just using the shortcode options below. For example:<br />
        <code>[instagram-feed]</code><br />
        <code>[instagram-feed id="1515219736"]</code><br />
        <code>[instagram-feed id="1515219736,1331941790" num=4 cols=4 showfollow=false]</code>
        </p>
        <p><?php _e("See the table below for a full list of available shortcode options:"); ?></p>


        <table class="bmi_shortcode_table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e('Shortcode option'); ?></th>
                    <th scope="row"><?php _e('Description'); ?></th>
                    <th scope="row"><?php _e('Example'); ?></th>
                </tr>

                <tr class="bmi_table_header"><td colspan=3><?php _e("Configure Options"); ?></td></tr>
                <tr>
                    <td>id</td>
                    <td><?php _e('An Instagram User ID. Separate multiple IDs by commas.'); ?></td>
                    <td><code>[instagram-feed id="1234567"]</code></td>
                </tr>
                <tr class="bmi_table_header"><td colspan=3><?php _e("Customize Options"); ?></td></tr>
                <tr>
                    <td>width</td>
                    <td><?php _e("The width of your feed. Any number."); ?></td>
                    <td><code>[instagram-feed width=50]</code></td>
                </tr>
                <tr>
                    <td>widthunit</td>
                    <td><?php _e("The unit of the width. 'px' or '%'"); ?></td>
                    <td><code>[instagram-feed widthunit=%]</code></td>
                </tr>
                <tr>
                    <td>height</td>
                    <td><?php _e("The height of your feed. Any number."); ?></td>
                    <td><code>[instagram-feed height=250]</code></td>
                </tr>
                <tr>
                    <td>heightunit</td>
                    <td><?php _e("The unit of the height. 'px' or '%'"); ?></td>
                    <td><code>[instagram-feed heightunit=px]</code></td>
                </tr>
                <tr>
                    <td>background</td>
                    <td><?php _e("The background color of the feed. Any hex color code."); ?></td>
                    <td><code>[instagram-feed background=#ffff00]</code></td>
                </tr>
                <tr>
                    <td>class</td>
                    <td><?php _e("Add a CSS class to the feed container"); ?></td>
                    <td><code>[instagram-feed class=feedOne]</code></td>
                </tr>

                <tr class="bmi_table_header"><td colspan=3><?php _e("Photos Options"); ?></td></tr>
                <tr>
                    <td>sortby</td>
                    <td><?php _e("Sort the posts by Newest to Oldest (none) or Random (random)"); ?></td>
                    <td><code>[instagram-feed sortby=random]</code></td>
                </tr>
                <tr>
                    <td>num</td>
                    <td><?php _e("The number of photos to display initially. Maximum is 33."); ?></td>
                    <td><code>[instagram-feed num=10]</code></td>
                </tr>
                <tr>
                    <td>cols</td>
                    <td><?php _e("The number of columns in your feed. 1 - 10."); ?></td>
                    <td><code>[instagram-feed cols=5]</code></td>
                </tr>
                <tr>
                    <td>imageres</td>
                    <td><?php _e("The resolution/size of the photos. 'auto', full', 'medium' or 'thumb'."); ?></td>
                    <td><code>[instagram-feed imageres=full]</code></td>
                </tr>
                <tr>
                    <td>imagepadding</td>
                    <td><?php _e("The spacing around your photos"); ?></td>
                    <td><code>[instagram-feed imagepadding=10]</code></td>
                </tr>
                <tr>
                    <td>imagepaddingunit</td>
                    <td><?php _e("The unit of the padding. 'px' or '%'"); ?></td>
                    <td><code>[instagram-feed imagepaddingunit=px]</code></td>
                </tr>
                <tr>
                    <td>disablemobile</td>
                    <td><?php _e("Disable the mobile layout. 'true' or 'false'."); ?></td>
                    <td><code>[instagram-feed disablemobile=true]</code></td>
                </tr>

                <tr class="bmi_table_header"><td colspan=3><?php _e("Header Options"); ?></td></tr>
                <tr>
                    <td>showheader</td>
                    <td><?php _e("Whether to show the feed Header. 'true' or 'false'."); ?></td>
                    <td><code>[instagram-feed showheader=false]</code></td>
                </tr>
                <tr>
                    <td>headercolor</td>
                    <td><?php _e("The color of the Header text. Any hex color code."); ?></td>
                    <td><code>[instagram-feed headercolor=#333]</code></td>
                </tr>
                
                <tr class="bmi_table_header"><td colspan=3><?php _e("'Load More' Button Options"); ?></td></tr>
                <tr>
                    <td>showbutton</td>
                    <td><?php _e("Whether to show the 'Load More' button. 'true' or 'false'."); ?></td>
                    <td><code>[instagram-feed showbutton=false]</code></td>
                </tr>
                <tr>
                    <td>buttoncolor</td>
                    <td><?php _e("The background color of the button. Any hex color code."); ?></td>
                    <td><code>[instagram-feed buttoncolor=#000]</code></td>
                </tr>
                <tr>
                    <td>buttontextcolor</td>
                    <td><?php _e("The text color of the button. Any hex color code."); ?></td>
                    <td><code>[instagram-feed buttontextcolor=#fff]</code></td>
                </tr>
                <tr>
                    <td>buttontext</td>
                    <td><?php _e("The text used for the button."); ?></td>
                    <td><code>[instagram-feed buttontext="Load More Photos"]</code></td>
                </tr>

                <tr class="bmi_table_header"><td colspan=3><?php _e("'Follow on Instagram' Button Options"); ?></td></tr>
                <tr>
                    <td>showfollow</td>
                    <td><?php _e("Whether to show the 'Follow on Instagram' button. 'true' or 'false'."); ?></td>
                    <td><code>[instagram-feed showfollow=true]</code></td>
                </tr>
                <tr>
                    <td>followcolor</td>
                    <td><?php _e("The background color of the button. Any hex color code."); ?></td>
                    <td><code>[instagram-feed followcolor=#ff0000]</code></td>
                </tr>
                <tr>
                    <td>followtextcolor</td>
                    <td><?php _e("The text color of the button. Any hex color code."); ?></td>
                    <td><code>[instagram-feed followtextcolor=#fff]</code></td>
                </tr>
                <tr>
                    <td>followtext</td>
                    <td><?php _e("The text used for the button."); ?></td>
                    <td><code>[instagram-feed followtext="Follow me"]</code></td>
                </tr>

            </tbody>
        </table>


    <?php } //End Display tab ?>


<!-- end #bmi_admin -->

<?php } //End Settings page

function bm_instagram_admin_style() {
        wp_register_style( 'bm_instagram_admin_css', plugin_dir_url( __FILE__ ) . 'css/bm-instagram-admin.css?2', false, '1.0.0' );
        wp_enqueue_style( 'bm_instagram_admin_css' );
        wp_enqueue_style( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'bm_instagram_admin_style' );

function bm_instagram_admin_scripts() {
    wp_enqueue_script( 'bm_instagram_admin_js', plugin_dir_url( __FILE__ ) . 'js/bm-instagram-admin.js?2' );
    if( !wp_script_is('jquery-ui-draggable') ) { 
        wp_enqueue_script(
            array(
            'jquery',
            'jquery-ui-core',
            'jquery-ui-draggable'
            )
        );
    }
    wp_enqueue_script(
        array(
        'hoverIntent',
        'wp-color-picker'
        )
    );
}
add_action( 'admin_enqueue_scripts', 'bm_instagram_admin_scripts' );

// Add a Settings link to the plugin on the Plugins page
$bmi_plugin_file = 'instagram-feed/instagram-feed.php';
add_filter( "plugin_action_links_{$bmi_plugin_file}", 'bmi_add_settings_link', 10, 2 );
 
//modify the link by unshifting the array
function bmi_add_settings_link( $links, $file ) {
    $bmi_settings_link = '<a href="' . admin_url( 'admin.php?page=bm-instagram-feed' ) . '">' . __( 'Settings', 'bm-instagram-feed' ) . '</a>';
    array_unshift( $links, $bmi_settings_link );
 
    return $links;
}

?>
