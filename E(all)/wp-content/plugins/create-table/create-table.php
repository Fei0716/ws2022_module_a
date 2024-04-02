<?php

/*
    Plugin Name: Create Table(E9)
    Author: Fei
    Description: create table myplugin_data upon plugin activation and drop it from database after deactivation.
*/

class CreateTable{
    private $table_name;

    function __construct(){
        global $wpdb;
        $this->table_name = $wpdb->prefix.'myplugin_data';

        register_activation_hook( __FILE__, array($this,'create_table') );
        register_deactivation_hook( __FILE__, array($this,'drop_table') );
    }

    function create_table(){
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS $this->table_name(
                id bigint(10) PRIMARY KEY AUTO_INCREMENT
            )$charset_collate;";
        require_once ABSPATH.'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }

    function drop_table(){
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS $this->table_name");
    }


}
new CreateTable();