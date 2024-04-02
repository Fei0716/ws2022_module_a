<?php
/*
    Plugin Name: Color or Image Plugin for Login Screen (E4)
    Author: Fei
*/
class LoginColorImage{
    public $table_name;
    public function __construct(){
        // create a table upon activation
        global $wpdb;
        $this->table_name= $wpdb->prefix.'login_color_image';
        register_activation_hook(__FILE__, array($this,'create_db_table') );
        // enqueue scripts
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        // add menu item to dashboard
        add_action('admin_menu' , array($this, 'create_menu_item'));
        // insert image or color to database
        add_action('admin_post_insert_image_color' , array($this, 'insert_image_color'));

        add_action('login_enqueue_scripts', array($this, 'change_login_screen'));
    }

    public function create_db_table(){
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS $this->table_name(
            id bigint(10) PRIMARY KEY AUTO_INCREMENT,
            image varchar(255),
            color varchar(40)
        )$charset_collate;";
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }
    public function enqueue_scripts(){
        // for color picker
        wp_enqueue_style( 'wp-color-picker' );
        //for media libary
        wp_enqueue_media();

        wp_enqueue_script('custom-login-color-image-js' , plugin_dir_url( __FILE__).'js/color-image-for-login-screen.js' , array('wp-color-picker','jquery'));
        wp_enqueue_style('custom-login-color-image-js' , plugin_dir_url( __FILE__).'css/color-image-for-login-screen.css');

    }
    public function create_menu_item(){
        add_menu_page('Color/Image For Login Screen' , 'Color/Image For Login Screen' ,'manage_options' ,'color_image_for_login_screen' , array($this, 'setting_page') ,'dashicons-editor-video');
    }
    public function setting_page(){
        ?>

            <h1 class="mt-3">Color/Image for login screen</h1>
            <form action="<?=esc_url(admin_url('admin-post.php')) ?>" method="post" id="form-color-image">
                        <!-- create custom hook -->
                <input type="hidden" name="action" value="insert_image_color">
                <div class="mt-3" for="option">Choose color or image(only one)</div>
                <div class="mt-3">
                    <label for="color_option">Color: </label>
                    <input type="radio" name="option" value="color" id="color_option" checked>
                    <label for="image">Image: </label>
                    <input type="radio" name="option" value="image" id="image_option">
                </div>
                <div id="color-group" class="mt-3">
                    <label for="color">Pick a color</label>
                    <input type="text" name="color" id="color">
                </div>
                <div id="image-group" class="mt-3">
                    <label for="image">Upload Image</label>
                    <input type="text" name="image" id="image" disabled>
                    <button type="button" id="btn-upload" disabled>Upload</button>
                </div>

                <button type="submit" class="button button-secondary">Submit</button>
            </form>
        <?php
    }
    public function insert_image_color(){
        global $wpdb;
        $wpdb->query("TRUNCATE TABLE $this->table_name");
        $upload_dir = wp_upload_dir();
        $option = $_POST['option'];
        if($option == 'image' && isset($_POST['image'])){
            $image_path = $upload_dir['url'].'/'.$_POST['image'];
            $wpdb->query(
                $wpdb->prepare(
                    "INSERT INTO $this->table_name(image, color)
                    VALUES(%s,null);",
                    $image_path
                )
            );
        }else if($option == 'color' && isset($_POST['color'])){
            $wpdb->query(
                $wpdb->prepare(
                    "INSERT INTO $this->table_name (image, color)
                    VALUES (null, %s);",
                    $_POST['color']
                )
            );
        }
        wp_redirect( admin_url( 'admin.php?page=color_image_for_login_screen' ) );
    }
    public function change_login_screen(){
        global $wpdb;
        $row = $wpdb->get_row("SELECT * FROM $this->table_name;");
        ?>
            <style type="text/css"> 
                body{
                    <?php
                        if(isset($row->image)){
                            echo "background-image: url(".$row->image.")!important;";
                        }else{
                            echo "background-color: ".$row->color."!important;";

                        }
                    ?>
                }
            </style>
        <?php
    }
}
new LoginColorImage();