<?php
if ( ! class_exists( 'Event' ) ) {
	class Event {
		protected $plugin_name;
		protected $version;

		public function __construct() {
			if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
				$this->version = PLUGIN_NAME_VERSION;
			} else {
				$this->version = '1.0.0';
			}
			/***
			 * Required Advanced Custom Field plugin
			 * Requires Date Field to be seet with field name schedule_date
			 */
			$this->plugin_name = 'event-plugin';
			add_action( 'init', array( $this, 'create_event_post' ) );
			add_shortcode( 'cm_event', array( $this, 'event_shortcode' ) );
			add_filter( 'manage_edit-events_columns', array( $this, 'event_column_head' ) );
			add_action( 'manage_posts_custom_column', array( $this, 'event_column_content' ), 10, 2 );
			add_action( 'wp_enqueue_scripts', array( $this, 'script_enqueue' ), 100 );
		}

		public function script_enqueue() {
			wp_enqueue_script( 'custom-script', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/custom.js', array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'lightbox-script', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/glightbox.min.js' );
			wp_enqueue_style( 'lightbox-style', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/glightbox.min.css' );
		}

		public function event_column_head( $columns ) {
			$columns = array(
				"cb"                       => "<input type='checkbox' />",
				"title"                    => "Title",
				"taxonomy-events_category" => 'Categories',
				'shortcodes'               => 'shortcode',
				"date"                     => "Date",
			);

			return $columns;
		}

		public function event_column_content( $column, $post_id ) {
			if ( $column == 'shortcodes' ) {
				$id = get_the_terms( $post_id, 'events_category' ); ?>
                <textarea style="resize: none;" rows="2" cols="20" readonly="readonly">
                            [cm_event <?php echo ( isset( $id ) && ! empty( $id ) ) ? "cat=" . $id[0]->term_id : ""; ?>]
                        </textarea>
				<?php
			}
		}

		public function event_shortcode( $atts ) {
			ob_start();
			include( plugin_dir_path( __FILE__ ) . 'shortcode-content.php' );

			return ob_get_clean();
		}

		public function create_event_post() {
			require_once plugin_dir_path( __FILE__ ) . 'custom-post-type.php';
			require_once plugin_dir_path( __FILE__ ) . 'custom-taxonomy.php';
		}

		public function get_plugin_name() {
			return $this->plugin_name;
		}

		public function get_version() {
			return $this->version;
		}
	}

	$event_obj = new Event();
}
?>