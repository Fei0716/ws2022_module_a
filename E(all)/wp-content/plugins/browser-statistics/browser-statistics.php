<?php
/*
    Plugin Name: Browser Statistics(E6)
    Author: Fei
    Description:Displays statistics from the browsers that accessed your homepage
*/

class BrowserStatistics{
    private $table_name; 

    public function __construct(){
        // create table
        global $wpdb;
        $this->table_name = $wpdb->prefix.'browser_statistics';
        register_activation_hook( __FILE__, array($this , 'create_db_table') );
        // insert into database when user is switching page 
        add_action( 'wp', array($this , 'get_browser_statistics') );
        // add menu item to dashboard
        add_action('admin_menu' , array($this , 'add_menu_item') );
    }
    public function create_db_table(){
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS $this->table_name(
            id bigint(10) PRIMARY KEY AUTO_INCREMENT,
            browser_name varchar(255) NOT NULL,
            hit int(12) NOT NULL
        )$charset_collate;";
        require_once ABSPATH. 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }
    public function get_browser_statistics(){
        // check whether user is at home page or not
        if(is_home()){
            global $wpdb;
            // check for browser name
            $browser_name = $this->get_browser_name($_SERVER['HTTP_USER_AGENT']);
            $wpdb->query(
                $wpdb->prepare(
                    "INSERT INTO $this->table_name (browser_name, hit) VALUES (%s, %d);",
                    $browser_name,
                    1
                )
            );
        }
    }
    public function get_browser_name($server){
        $browser_name = ''; 
        if(str_contains( $server, 'Firefox' )){
            $browser_name = 'Firefox';
        }else if(str_contains( $server, 'Edg' )){
            $browser_name = 'Edge';
        }else if(str_contains( $server, 'Chrome' )){
            $browser_name = 'Chrome';
        }else{
            $browser_name = 'Other';
        }
        return $browser_name;
    }
    public function add_menu_item(){
        add_menu_page( 'Browser Statistics', 'Browser Statistics', 'manage_options', 'browser_statistics', array($this, 'setting_page'), 'dashicons-chart-pie');
    }
    public function setting_page(){
        global $wpdb;
        $statistic = $wpdb->get_results("SELECT SUM(hit) as sum, browser_name FROM $this->table_name GROUP BY browser_name;");
        $totalHits = 0;
        $chrome = 0;
        $edge = 0;
        $firefox = 0;
        $other = 0;
        foreach($statistic as $stat){
            $totalHits += intval($stat->sum);
            switch($stat->browser_name){
                case 'Chrome':
                    $chrome = $stat->sum;
                    break;
                case 'Edge':
                    $edge = $stat->sum;
                    break;
                case 'Firefox':
                    $firefox = $stat->sum;
                    break;
                case 'Other':
                    $other = $stat->sum;
                    break;
                default:break;
            }
        }
        ?>
            <h1>Browser Statistics(for 4 browsers: Chrome, Firefox, Edge, and Other)</h1>
            <ol>
                <li style="display:flex; align-items:center;"><span style="display:block;background-color:red;height:40px;width:40px;"></span>Chrome, <?=$chrome?> hits</li>
                <li style="display:flex; align-items:center;"><span style="display:block;background-color:blue;height:40px;width:40px;"></span>Edge, <?=$edge?> hits</li>
                <li style="display:flex; align-items:center;"><span style="display:block;background-color:orange;height:40px;width:40px;"></span>Firefox, <?=$firefox?> hits</li>
                <li style="display:flex; align-items:center;"><span style="display:block;background-color:green;height:40px;width:40px;"></span>Other, <?=$other?> hits</li>
            </ol>
            <div class="browser-chart"
            style="
                width: 400px;
                height: 400px;
                border-radius: 50%;
                background-image: conic-gradient(
                    red <?=$chrome/$totalHits * 100?>%, 
                    blue <?=$chrome/$totalHits * 100?>% <?=$edge/$totalHits * 100 + $chrome/$totalHits * 100?>%, 
                    orange <?=$edge/$totalHits * 100?>% <?=$firefox/$totalHits * 100 + $edge/$totalHits * 100 + $chrome/$totalHits * 100?>%, 
                    green <?=$firefox/$totalHits * 100?>% 100%
                    );
            "
            >

            </div>

        <?php
    }
}
new BrowserStatistics();