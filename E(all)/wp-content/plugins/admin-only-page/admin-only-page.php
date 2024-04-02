<?php
/*
    Plugin Name: Admin Only Page (E10)
    Author: Fei
*/
class AdminOnlyPage{
    public function __construct(){
        register_activation_hook(__FILE__, array($this,'create_about_page'));
        add_action('admin_menu' , array($this, 'add_menu_item'));
        //template_redirect: This action hook is fired just before WordPress determines which template page to load.
        add_action('template_redirect' , array($this, 'restrict_about_page'));
    }
    public function add_menu_item(){
        $aboutPage = get_posts([
            'post_title' => 'About',
            'post_type' => 'page',
        ]); 
        if (!empty($aboutPage)) {
            $aboutPage = $aboutPage[0]; // Get the first "About" page found
            $aboutPageID = $aboutPage->ID;
    
            add_menu_page(
                'About',
                'About',
                'manage_options',
                'post.php?post=' . $aboutPageID . '&action=edit',
                '',
                'dashicons-info',
                2
            );
        }
    }

    public function create_about_page(){
        $about_page = array(
            'post_title' => 'About',
            'post_content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'post_status' => 'publish',
            'post_author' => 1,
            'post_type' => 'page',
        );

        wp_insert_post($about_page);
    }

    public function restrict_about_page(){
        if(is_page('about')){
            if(!current_user_can( 'manage_options' )){
                wp_redirect(home_url());
                exit;
            }
        }
    }
}
new AdminOnlyPage();