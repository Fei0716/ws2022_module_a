<?php 
/*
    Plugin Name: Calendar(E7)
    Author: Fei
*/ 
class Calendar{
    public function __construct(){
        // add menu items
        add_action('admin_menu' ,array($this,'create_menu_item'));
        // enqueue scripts
        add_action('admin_enqueue_scripts',array($this,'enqueue_scripts'));
        add_action('wp_enqueue_scripts',array($this,'enqueue_scripts'));
        // create shortcode
        add_shortcode( 'calendar', array($this,'create_shortcode') );
    }
    public function create_menu_item(){
        add_menu_page( 'Calendar', 'Calendar', 'manage_options', 'calendar', array($this, 'setting_page'), 'dashicons-calendar-alt');
    }
    public function setting_page(){
        ?>
            <h1>Calendar</h1>
            <h2>Shortcode: [calendar]</h2>
        <?php
    }
    public function enqueue_scripts(){
        wp_enqueue_script('calendar-js' , plugin_dir_url(__FILE__).'calendar.js', array('jquery') , 1.0);
        wp_enqueue_style('calendar-css' , plugin_dir_url(__FILE__).'calendar.css');
    }
    public function create_shortcode(){
        $output = "
            <h2 class='calendar-title'>Calendar</h2>
                <div class='calendar'>
                    <div class='calendar-header'>
                        <btn id='btn-calendar-back'>Prev</btn>
                        <div id='calendar-header-data'>Feb 2024</div>
                        <btn id='btn-calendar-next'>Next</btn>
                    </div>
                    <table class='calendar-body'>
                        <tr>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                            <th>Saturday</th>
                            <th>Sunday</th>
                        </tr>

                    </table>
                </div>
        ";
        return $output;
    }
}
new Calendar();