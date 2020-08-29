<?php

class wp_tarot_kickstarters extends WP_Widget {

	// Constructor to Create Widget
	function __construct() {
		parent::__construct(
			'my_tarot_kickstarters',
			__('Tarot Kickstarters', 'wpggr_domain'),
			array('description' => __('A widget to display 12 active Tarot related Kickstarters', 'wpggr_domain'))
		);
	}


	// Create Widget Front End Display
	public function widget($args, $instance) {

		$title = apply_filters('widget_title', $instance['title']);

		echo $args['before_widget'];

		if(!empty($title)){
			echo $args['before_title'] . $title . $args['after_title'];
		}

		echo $this->showRepos();

		echo $args['after_widget'];

	}

	// Create Widget Backend Form
	public function form( $instance ) {

		if(isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = __('Tarot Kickstarters', 'wpggr_domain');
		} ?>

		<p>
			<label
				for="<?php echo $this->get_field_id('title'); ?>">
				<?php _e('Title', 'wpggr_domain');  ?>
			</label>
			<input type="text"
			       class="widefat"
			       id="<?php echo $this->get_field_id('title'); ?>"
			       name="<?php echo $this->get_field_name('title'); ?>"
			       value="<?php echo esc_html($title)?>">
		</p>


	<?php }

	// Create Widget Value Update Method
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		return $instance;
	}

	public function showRepos() {
		$url ='https://www.kickstarter.com/projects/search.json?search=&term=tarot';
		$response = wp_remote_get($url);

		if( is_wp_error( $response ) ) {
			return false; // Bail early
		}

		$body = wp_remote_retrieve_body($response);
		$decks = json_decode($body, true);

		if(empty($decks->message)) {

			// Build Output
			$output = '<ul class="tarot-list">';

			foreach ( $decks['projects'] as $deck ) {

				$output .= '<li class="tarot-li">';

                $output .= '<div class="tarot-image"><img src="' . $deck['photo']['little']. '" /></div>';
				$output .= '<div class="tarot-title">' . $deck['name'] . '</div>';
                $output .= '<div class="tarot-desc">' . $deck['blurb']. '</div>';
				$output .= '<a class="tarot-link" target="_blank" href="' . $deck['urls']['web']['project'] . '">View On Kickstarter</a>';

				$output .= '</li>';
			}

			$output .= '</ul>';

			return $output;
		} else {
			return "I'm sorry there was a problem. Please try again later.";
		}

	}
}