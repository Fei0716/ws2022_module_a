<?php
/*
    Plugin Name: Post Calendar(E11)
    Author: Fei
*/
class PostCalendar{
    public function __construct(){
        add_action('wp_dashboard_setup' , array($this, 'add_dashboard_widget'));
        add_action('admin_enqueue_scripts' , array($this, 'enqueue_scripts'));
    }
    public function add_dashboard_widget(){
        wp_add_dashboard_widget(
            'post_calendar_widget', 
            'Post Calendar',
            array($this, 'render_dashboard_widget')
        );
    }
    public function enqueue_scripts(){
        wp_enqueue_style('post-calendar-css', plugin_dir_url(__FILE__) .'post-calendar.css');
    }
    public function render_dashboard_widget() {
        // Get the current month and year
        $current_month = date('n');
        $current_year = date('Y');

        // Get the first day of the current month
        $first_day_of_month = mktime(0, 0, 0, $current_month, 1, $current_year);

        // Get the number of days in the current month
        $days_in_month = date('t', $first_day_of_month);

        // Start rendering the calendar
        echo '<table class="post-calendar">';
        echo '<tr><th colspan="7">' . date('F Y', $first_day_of_month) . '</th></tr>';
        echo '<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>';
        echo '<tr>';

        // Fill in empty cells for days before the first day of the month
        $first_day_of_week = date('w', $first_day_of_month); // 0 (Sun) to 6 (Sat)
        for ($i = 0; $i < $first_day_of_week; $i++) {
            echo '<td class="empty"></td>';
        }

        // Loop through each day of the month
        for ($day = 1; $day <= $days_in_month; $day++) {
            $timestamp = mktime(0, 0, 0, $current_month, $day, $current_year);
            $post_count = $this->get_post_count($timestamp);

            // Check if there are posts published on this day
            if ($post_count > 0) {
                $hover_text = $this->get_post_dates($timestamp);
                echo '<td class="has-posts" title="' . esc_attr($hover_text) . '">' . $day . '</td>';
            } else {
                echo '<td>' . $day . '</td>';
            }

            // Start a new row if it's the last day of the week
            if (($first_day_of_week + $day) % 7 === 0) {
                echo '</tr><tr>';
            }
        }

        // Fill in empty cells for days after the last day of the month
        $last_day_of_week = date('w', $timestamp); // 0 (Sun) to 6 (Sat)
        for ($i = $last_day_of_week + 1; $i < 7; $i++) {
            echo '<td class="empty"></td>';
        }

        echo '</tr>';
        echo '</table>';
    }

    // Function to get the number of posts published on a specific day
    private function get_post_count($timestamp) {
        global $wpdb;
        $date = date('Y-m-d', $timestamp);
        $query = "SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_type = 'post' AND post_status = 'publish' AND DATE(post_date) = '$date'";
        return $wpdb->get_var($query);
    }

    // Function to get the dates of posts published on a specific day
    private function get_post_dates($timestamp) {
        global $wpdb;
        $date = date('Y-m-d', $timestamp);
        $query = "SELECT post_date FROM {$wpdb->posts} WHERE post_type = 'post' AND post_status = 'publish' AND DATE(post_date) = '$date'";
        $results = $wpdb->get_results($query);
        $dates = array();
        foreach ($results as $result) {
            $dates[] = date('h:i A', strtotime($result->post_date));
        }
        return implode(', ', $dates);
    }
}
new PostCalendar();
