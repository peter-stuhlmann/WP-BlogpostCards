<?php 

function wppc_theme_settings() {
	add_submenu_page(
		'options-general.php',                 // parent slug
		__('WP Post Cards settings', 'wp-post-cards'), // page title
		__('WP Post Cards', 'wp-post-cards'),  // menu title
		'manage_options',                      // capability
		'wppc-settings',                       // menu slug
		'wppc_settings_page'                   // callback function to be called when rendering the page
	);
	add_action('admin_init', 'wppc_settings_init');
}
add_action('admin_menu', 'wppc_theme_settings');

function wppc_settings_init() {
	add_settings_section(
		'wppc-settings-section',               // id
		'',                                    // title
		'',                                    // callback function
		'wppc-settings'                        // page
    );
 
    // Button text
    register_setting(
		'wppc-settings',                       // option group
        'button-text',                         // option name
        ''                                     // args
    );
    add_settings_field(
		'button-text',                         // id
		__('Button text', 'wp-post-cards'),    // title
		'wppc_form_button_text',               // callback function
		'wppc-settings',                       // page
        'wppc-settings-section',               // section
        ''                                     // args
    );
}

function wppc_form_button_text() {
    $buttonText = esc_attr(get_option('button-text', '')); ?>
    <input class="wppc-input" type="text" name="button-text" placeholder="Read article" value="<?php echo $buttonText; ?>" />
    <?php
}

function wppc_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('WP Post Cards Settings', 'wp-post-cards'); ?></h1>
        <form method="POST" action="options.php">
            <?php settings_fields('wppc-settings');?>
            <?php do_settings_sections('wppc-settings')?>
            <?php submit_button(
                null,                          // text
                'primary',                     // type
                'submit',                      // name
                true,                          // wrap
                null                           // other attributes
            )?>
        </form>
    </div>
<?php
}