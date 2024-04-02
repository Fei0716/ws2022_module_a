<?php

/*
    Plugin Name: Custom Logo(E1)
    Author: Fei
    Description: Change wordpress logo on login screen and dashboard to a custom logo
*/

class CustomLogo{
    private $table_name;
    public function __construct(){
        global $wpdb;
        $this->table_name = $wpdb->prefix.'custom_logo';
        // upon activating this plugin
        register_activation_hook( __FILE__, array($this , 'create_db_table'));
        // add menu items to  Appearance->Themes->Customizer->Site Identity-> Change Logo.
        add_action('customize_register', array($this, 'register_custom_logo_menu'));
        // save the logo into database
        add_action('customize_save_after' , array($this, 'save_custom_logo'));
        // display the logo in login screen
        add_action('login_enqueue_scripts' , array($this, 'display_custom_logo_at_login'));
        add_action('admin_head' , array($this, 'display_custom_logo_at_dashboard'));
    }
    public function create_db_table(){
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS $this->table_name(
                id bigint(10) PRIMARY KEY AUTO_INCREMENT,
                logo varchar(255) NOT NULL
            )$charset_collate;";
        
        require_once ABSPATH."wp-admin/includes/upgrade.php";
        dbDelta($sql);
    }
    public function register_custom_logo_menu($wp_customize) {
        // Add custom logo control to the "Site Identity" section
        $wp_customize->add_setting('custom_logo_upload');
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'custom_logo_upload', array(
            'label' => __('Upload Custom Logo', 'text_domain'),
            'section' => 'title_tagline', // This targets the "Site Identity" section
            'settings' => 'custom_logo_upload',
        )));
    }
    public function save_custom_logo() {
        // Check if 'customized' data is set in $_POST
        if(isset($_POST['customized'])) {
            // Decode the JSON string to retrieve the customized data
            $customized_data = json_decode(stripslashes($_POST['customized']), true);
            
            // Check if the 'custom_logo_upload' key exists in the decoded data
            if(isset($customized_data['custom_logo_upload'])) {
                // Retrieve the URL from the 'custom_logo_upload' key
                $logo_url = esc_url_raw($customized_data['custom_logo_upload']);
                // Proceed with further processing (e.g., saving to the database)
                global $wpdb;
                // Clear existing data from the table
                $wpdb->query("TRUNCATE TABLE $this->table_name");
                // Insert the new logo URL into the database
                $wpdb->insert($this->table_name, array('logo' => $logo_url));
            }
        }
    }
    
    
    function display_custom_logo_at_login(){
        global $wpdb;
        $logo_url = $wpdb->get_var("SELECT logo FROM $this->table_name");
        if ($logo_url) {
            echo '<style type="text/css">.login h1 a { background-image:url(' . esc_url($logo_url) . ')!important; }</style>';
        }
    }
    function display_custom_logo_at_dashboard(){
        global $wpdb;
        $logo_url = $wpdb->get_var("SELECT logo FROM $this->table_name");
        if ($logo_url) {
            echo '
                <style type="text/css">
                    #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
                        background-image: url('.$logo_url.') !important;
                        background-position: 0 0;
                        background-size: 18px 18px;
                        background-repeat: no-repeat;
                        color:rgba(0, 0, 0, 0);
                    }
                    #wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
                        background-position: 0 0;
                    }
                </style>
            ';
            }
        }
    
}
new CustomLogo();