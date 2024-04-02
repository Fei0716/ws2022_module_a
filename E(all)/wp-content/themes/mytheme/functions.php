<?php

add_action('wp_enqueue_scripts' , 'enqueue_scripts');
function enqueue_scripts() {
    wp_enqueue_style( 'fontawesome-css', get_stylesheet_directory_uri()."/fontawesome-free-6.1.2-web/css/all.css" ,array() , '6.1.2');
    wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri()."/bootstrap-5.1.3-dist/css/bootstrap.css" ,array() , '5.1.3');
}
// to get data of movies from database and filter movies based on search query if there is one
function get_movies($search_query = ''){
    global $wpdb;
    if(!empty($search_query)){
        return $wpdb->get_results("SELECT * FROM wp_movies
         WHERE title LIKE '%$search_query%'
         ORDER BY popularity DESC");
    }
    return $wpdb->get_results("SELECT * FROM wp_movies ORDER BY popularity DESC");;
}

?>