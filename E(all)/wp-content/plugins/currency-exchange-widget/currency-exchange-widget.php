<?php
/*
    Plugin Name: Currency Exchange Widget(E3)
    Author: Fei
    Description: plugin to create a currency exchange widget
*/
class CurrencyExchangeWidget{
    public function __construct(){
        add_action('widgets_init' , function(){
            register_widget('CurrencyExchange');
        });
    }
}
new CurrencyExchangeWidget();

// widget class
class CurrencyExchange extends WP_Widget{
    public function __construct(){
        parent::__construct(
            'currency_exchange',
            'Currency_Exchange',
            array(
                'description' => __('A widget for exchanging currency from usd','text_domain'),
            )
        );
    }
    public function widget($args, $instance){
        $jsonPath = plugin_dir_url( __FILE__).'usd.json';
        $exchangeRates = json_decode(file_get_contents($jsonPath) , true);
        echo $args['before_widget'];
        $title = apply_filters( 'widget_title', $instance['title'] );
        if(isset($title)){
            echo $args['before_title'];
            ?>
                <h1><?=$title ?></h1>
            <?php
            echo $args['after_title'];
        }
        // Display exchange rates if available
        if (!empty($exchangeRates)) {
            echo '<ul>';
            foreach ($exchangeRates as $currency) {
                echo '<li>' . $currency['name'] . '('.$currency['code'].'): ' . $currency['rate'] . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>' . __('Exchange Rate Data Unavailable', 'text_domain') . '</p>';
        }
        echo $args['after_widget'];

    }

    public function form($instance){
        if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = __( 'New title', 'text_domain' );
		}

        ?>
            <div>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </div>
        <?php
    }

    public function update($new_instance , $old_instance){
        $instance = array();
        $instance['title'] = isset($new_instance['title'])?$new_instance['title']:$old_instance['title'];

        return $instance;
    }

}