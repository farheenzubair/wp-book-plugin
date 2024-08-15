<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://http://farheenzubair.com
 * @since      1.0.0
 *
 * @package    Wp_Book_Plugin
 * @subpackage Wp_Book_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Book_Plugin
 * @subpackage Wp_Book_Plugin/admin
 * @author     Farheen Zubair <farheenzubair810@gmail.com>
 */
class Wp_Book_Plugin_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Book_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Book_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-book-plugin-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Book_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Book_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-book-plugin-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function register_widgets()
    {
        register_widget('WP_Book_Plugin_Books_Widget');
    }


	// Our custom post type function
function create_post_type() 
{
  
    register_post_type( 'Books',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Books' ),
                'singular_name' => __( 'Books' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'Books'),
            'show_in_rest' => true,
			'menu_icon' => 'dashicons-book',
        )
    );
}

	function custom_post_type() 
	{
  
		// Set UI labels for Custom Post Type
			$labels = array(
				'name'                => _x( 'Books', 'Post Type General Name', 'twentythirteen' ),
				'singular_name'       => _x( 'Books', 'Post Type Singular Name', 'twentythirteen' ),
				'menu_name'           => __( 'Books', 'twentythirteen' ),
				'parent_item_colon'   => __( 'Parent Books', 'twentythirteen' ),
				'all_items'           => __( 'All Books', 'twentythirteen' ),
				'view_item'           => __( 'View Books', 'twentythirteen' ),
				'add_new_item'        => __( 'Add New Books', 'twentythirteen' ),
				'add_new'             => __( 'Add New', 'twentythirteen' ),
				'edit_item'           => __( 'Edit Books', 'twentythirteen' ),
				'update_item'         => __( 'Update Books', 'twentythirteen' ),
				'search_items'        => __( 'Search Books', 'twentythirteen' ),
				'not_found'           => __( 'Not Found', 'twentythirteen' ),
				'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
			);
			  
		// Set other options for Custom Post Type
			  
			$args = array(
				'label'               => __( 'Books', 'twentythirteen' ),
				'description'         => __( 'Books news and reviews', 'twentythirteen' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => true,
				'show_in_admin_bar'   => true,
				'menu_position'       => 5,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'page',
				'show_in_rest'        => true,
				  
				// This is where we add taxonomies to our CPT
				'taxonomies'          => array( 'category' ),
			);
			  
			// Registering your Custom Post Type
			register_post_type( 'Books', $args );
		  
		}

		function create_custom_tags() {
  
			// Labels part for the GUI
			  
			  $labels = array(
				'name' => _x( 'Tags', 'taxonomy general name' ),
				'singular_name' => _x( 'Topic', 'taxonomy singular name' ),
				'search_items' =>  __( 'Search Tags' ),
				'popular_items' => __( 'Popular Tags' ),
				'all_items' => __( 'All Tags' ),
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => __( 'Edit Topic' ), 
				'update_item' => __( 'Update Topic' ),
				'add_new_item' => __( 'Add New Topic' ),
				'new_item_name' => __( 'New Topic Name' ),
				'separate_items_with_commas' => __( 'Separate Tags with commas' ),
				'add_or_remove_items' => __( 'Add or remove Tags' ),
				'choose_from_most_used' => __( 'Choose from the most used Tags' ),
				'menu_name' => __( 'Tags' ),
			  ); 
			  
			// Now register the non-hierarchical taxonomy like tag
			  
			  register_taxonomy('Tags','books',array(
				'hierarchical' => false,
				'labels' => $labels,
				'show_ui' => true,
				'show_in_rest' => true,
				'show_admin_column' => true,
				'update_count_callback' => '_update_post_term_count',
				'query_var' => true,
				'rewrite' => array( 'slug' => 'topic' ),
			  ));
			}
			

		// metabox 
		public function add_custom_meta_box() {
			add_meta_box(
				'book_meta_box',
				'Book Information',
				array( $this, 'custom_meta_box_html' ),
				'books'
			);
		}
	
		public function custom_meta_box_html($post) {
			$author_name = get_post_meta($post->ID, '_author_name', true);
			$price = get_post_meta($post->ID, '_price', true);
			$publisher = get_post_meta($post->ID, '_publisher', true);
			$year = get_post_meta($post->ID, '_year', true);
			$edition = get_post_meta($post->ID, '_edition', true);
			$url = get_post_meta($post->ID, '_url', true);
	
			wp_nonce_field('save_wp_book_plugin_meta_box', 'wp_book_plugin_nonce');
			?>
			<table class="form-table">
				<tr>
					<th><label for="author_name">Author Name</label></th>
					<td><input type="text" id="author_name" name="author_name" value="<?php echo esc_attr($author_name); ?>" class="regular-text"></td>
				</tr>
				<tr>
					<th><label for="price">Price</label></th>
					<td><input type="text" id="price" name="price" value="<?php echo esc_attr($price); ?>" class="regular-text"></td>
				</tr>
				<tr>
					<th><label for="publisher">Publisher</label></th>
					<td><input type="text" id="publisher" name="publisher" value="<?php echo esc_attr($publisher); ?>" class="regular-text"></td>
				</tr>
				<tr>
					<th><label for="year">Year</label></th>
					<td><input type="text" id="year" name="year" value="<?php echo esc_attr($year); ?>" class="regular-text"></td>
				</tr>
				<tr>
					<th><label for="edition">Edition</label></th>
					<td><input type="text" id="edition" name="edition" value="<?php echo esc_attr($edition); ?>" class="regular-text"></td>
				</tr>
				<tr>
					<th><label for="url">URL</label></th>
					<td><input type="text" id="url" name="url" value="<?php echo esc_attr($url); ?>" class="regular-text"></td>
				</tr>
			</table>
			<?php
		}
	
		public function save_meta_box($post_id) {
			if (!isset($_POST['wp_book_plugin_nonce'])) {
				return $post_id;
			}
			$nonce = $_POST['wp_book_plugin_nonce'];
	
			if (!wp_verify_nonce($nonce, 'save_wp_book_plugin_meta_box')) {
				return $post_id;
			}
	
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				return $post_id;
			}
	
			if ('books' == $_POST['post_type']) {
				if (!current_user_can('edit_post', $post_id)) {
					return $post_id;
				}
			}
	
			$fields = array('author_name', 'price', 'publisher', 'year', 'edition', 'url');
	
			foreach ($fields as $field) {
				$value = isset($_POST[$field]) ? sanitize_text_field($_POST[$field]) : '';
				update_post_meta($post_id, '_' . $field, $value);
			}
		}
	
		public function create_books_meta_table() {
			global $wpdb;
			$table_name = $wpdb->prefix . 'wp_books_meta';
			$charset_collate = $wpdb->get_charset_collate();
	
			$sql = "CREATE TABLE $table_name (
				id mediumint(9) NOT NULL AUTO_INCREMENT,
				post_id bigint(20) NOT NULL,
				meta_key varchar(255) NOT NULL,
				meta_value longtext NOT NULL,
				PRIMARY KEY  (id),
				KEY post_id (post_id),
				KEY meta_key (meta_key(191))
			) $charset_collate;";
	
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}
		

		public function add_admin_menu() {
			add_submenu_page(
				'edit.php?post_type=books',
				'Books Settings',
				'Settings',
				'manage_options',
				'books-settings',
				array( $this, 'display_settings_page' )
			);
		}
	
		public function register_settings() {
			register_setting( 'books_settings_group', 'books_currency' );
			register_setting( 'books_settings_group', 'books_per_page' );
	
			add_settings_section(
				'books_settings_section',
				'Books Settings',
				null,
				'books-settings'
			);
	
			add_settings_field(
				'books_currency',
				'Currency',
				array( $this, 'currency_field_callback' ),
				'books-settings',
				'books_settings_section'
			);
	
			add_settings_field(
				'books_per_page',
				'Number of Books per Page',
				array( $this, 'books_per_page_field_callback' ),
				'books-settings',
				'books_settings_section'
			);
		}
	
		public function currency_field_callback() {
			$currency = get_option( 'books_currency' );
			echo '<input type="text" name="books_currency" value="' . esc_attr( $currency ) . '" />';
		}
	
		public function books_per_page_field_callback() {
			$books_per_page = get_option( 'books_per_page' );
			echo '<input type="number" name="books_per_page" value="' . esc_attr( $books_per_page ) . '" />';
		}
	
		public function display_settings_page() {
			?>
			<div class="wrap">
				<h1>Books Settings</h1>
				<form method="post" action="options.php">
					<?php
					settings_fields( 'books_settings_group' );
					do_settings_sections( 'books-settings' );
					submit_button();
					?>
				</form>
			</div>
			<?php
		}


		
		
	//shortcodes
	public function register_shortcodes()
	{
		add_shortcode('book', array($this, 'wp_book_shortcodes'));
	}

	
	public function wp_book_shortcodes($atts) {
		$atts = shortcode_atts(
			array(
				'book_name' => '',
				'author_name' => '',
				'year' => '',
				'category' => '',
				'tag' => '',
				'publisher' => '',
			),
			$atts,
			'book'
		);
	
		$args = array(
			'post_type' => 'books',
			'posts_per_page' => -1,
			'meta_query' => array(
				'relation' => 'AND',
			),
			'tax_query' => array(
				'relation' => 'AND',
			),
		);
	
		if (!empty($atts['book_name'])) {
			$args['meta_query'][] = array(
				'key' => '_book_name',
				'value' => $atts['book_name'],
				'compare' => 'LIKE',
			);
		}
	
		if (!empty($atts['author_name'])) {
			$args['meta_query'][] = array(
				'key' => '_author_name',
				'value' => $atts['author_name'],
				'compare' => 'LIKE',
			);
		}
	
		if (!empty($atts['year'])) {
			$args['meta_query'][] = array(
				'key' => '_year',
				'value' => $atts['year'],
				'compare' => 'LIKE',
			);
		}
	
		if (!empty($atts['category'])) {
			$args['tax_query'][] = array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => $atts['category'],
			);
		}
	
		if (!empty($atts['tag'])) {
			$args['tax_query'][] = array(
				'taxonomy' => 'tags',
				'field' => 'slug',
				'terms' => $atts['tag'],
			);
		}
	
		if (!empty($atts['publisher'])) {
			$args['meta_query'][] = array(
				'key' => '_publisher',
				'value' => $atts['publisher'],
				'compare' => 'LIKE',
			);
		}
	
		$query = new WP_Query($args);
	
		$output = '<div class="wp-book-shortcode">';
		if ($query->have_posts()) {
			while ($query->have_posts()) {
				$query->the_post();
				$tags = get_the_terms(get_the_ID(), 'tags');
				$tag_list = '';
				if ($tags && !is_wp_error($tags)) {
					$tag_links = array();
					foreach ($tags as $tag) {
						$tag_links[] = '<a href="' . get_term_link($tag->term_id) . '">' . $tag->name . '</a>';
					}
					$tag_list = join(', ', $tag_links);
				}
	
				$output .= '<div class="book">';
				$output .= '<h2><strong>' . get_the_title() . '</strong></h2>';
				$output .= '<p><strong>' . __('Author:', 'wp-book') . '</strong> ' . get_post_meta(get_the_ID(), '_author_name', true) . '</p>';
				$output .= '<p><strong>' . __('Year:', 'wp-book') . '</strong> ' . get_post_meta(get_the_ID(), '_year', true) . '</p>';
				$output .= '<p><strong>' . __('Publisher:', 'wp-book') . '</strong> ' . get_post_meta(get_the_ID(), '_publisher', true) . '</p>';
				$output .= '<p><strong>' . __('Category:', 'wp-book') . '</strong> ' . get_the_category_list(', ') . '</p>';
				$output .= '<p><strong>' . __('Tags:', 'wp-book') . '</strong> ' . $tag_list . '</p>';
				$output .= '</div>';
			}
		} 
		else 
		{
			$output .= '<p>' . __('No books found', 'wp-book') . '</p>';
		}
		$output .= '</div>';
	
		wp_reset_postdata();
	
		return $output;
	}


	//register_dashboard_widget
	public function register_dashboard_widget() 
	{
		wp_add_dashboard_widget(
			'wp_book_top_categories_widget',
			__('Top 5 Book Categories', 'wp_book_plugin'),
			array($this, 'display_top_categories')
		);
	}
	
	public function display_top_categories() {
		$terms = get_terms(array(
			'taxonomy' => 'category',
			'orderby' => 'count',
			'order' => 'DESC',
			'number' => 5,
		));
	
		if (!empty($terms) && !is_wp_error($terms)) {
			echo '<ul>';
			foreach ($terms as $term) {
				echo '<li>' . esc_html($term->name) . ' (' . esc_html($term->count) . ')</li>';
			}
			echo '</ul>';
		} else {
			_e('No book categories found.', 'wp_book_plugin');
		}
	}

	}

	class WP_Book_Plugin_Books_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'WP_Book_Plugin_Books_Widget',
            __('Books by Category', 'wp-book'),
            array('description' => __('Displays books from a selected category', 'wp-book'))
        );
    }

    public function widget($args, $instance)
    {
        $static_title = __('Books by Category', 'wp-book');

        echo $args['before_widget'];
        echo $args['before_title'] . $static_title . $args['after_title'];

        $categories = get_terms(array(
            'taxonomy' => 'category',
            'hide_empty' => false,
        ));

        foreach ($categories as $cat) 
		{
            $query_args = array(
                'post_type' => 'books',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => $cat->term_id,
                    ),
                ),
            );

            $query = new WP_Query($query_args);

            if ($query->have_posts()) {
                echo '<h3>' . esc_html($cat->name) . '</h3>';
                echo '<ul style="padding-left: 20px;">'; // Indentation for books
                while ($query->have_posts()) {
                    $query->the_post();
                    echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
                }
                echo '</ul>';
            }
            wp_reset_postdata();
        }

        echo $args['after_widget'];
    }


    public function form($instance)
    {
        // Optionally, you can still allow a custom title to be set, but it won't be used in the widget output
        $title = !empty($instance['title']) ? $instance['title'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (not used):', 'wp-book'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" disabled>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

        return $instance;
    }


	
}
	?>
