<?php
// Exit if accessed directly

if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
}
/**
 * ADT_Post_Types class.
 */

class ADT_Post_Types {
    /**
	 * Constructor
	 */

	public function __construct() {

		add_action( 'init', array( $this, 'register_post_types' ), 0 );
    add_action( 'add_meta_boxes', [$this, 'adt_add_post_meta_boxes'],100 );

    add_action( 'save_post', [$this,'adt_save_post_meta_fields'], 100, 2 );

    add_filter( 'the_content', array( $this, 'adt_listing_content' ) );

       
       
    }
    /**
	 * register_post_types function.
	 *
	 * @access public
	 * @return void
	 */

	public function register_post_types() {

        /**
		 * Post types
		 */

         register_post_type('adt_listing',
         array(
             'labels'      => array(
                 'name'          => __('Adt List', 'assignment-data-tool'),
                 'singular_name' => __('Adt List', 'assignment-data-tool'),
             ),
                 'public'      => true,
                 'has_archive' => true,
         )
     );

     $labels = array(
          'name'                       => _x( 'Sales Category', 'Taxonomy General Name', 'assignment-data-tool' ),
          'singular_name'              => _x( 'Sales Category', 'Taxonomy Singular Name', 'assignment-data-tool' ),
          'menu_name'                  => __( 'Sales Category', 'assignment-data-tool' ),
          'all_items'                  => __( 'All Items', 'assignment-data-tool' ),
          'parent_item'                => __( 'Parent Item', 'assignment-data-tool' ),
          'parent_item_colon'          => __( 'Parent Item:', 'assignment-data-tool' ),
          'new_item_name'              => __( 'New Item Name', 'assignment-data-tool' ),
          'add_new_item'               => __( 'Add New Item', 'assignment-data-tool' ),
          'edit_item'                  => __( 'Edit Item', 'assignment-data-tool' ),
          'update_item'                => __( 'Update Item', 'assignment-data-tool' ),
          'view_item'                  => __( 'View Item', 'assignment-data-tool' ),
          'separate_items_with_commas' => __( 'Separate items with commas', 'assignment-data-tool' ),
          'add_or_remove_items'        => __( 'Add or remove items', 'assignment-data-tool' ),
          'choose_from_most_used'      => __( 'Choose from the most used', 'assignment-data-tool' ),
          'popular_items'              => __( 'Popular Items', 'assignment-data-tool' ),
          'search_items'               => __( 'Search Items', 'assignment-data-tool' ),
          'not_found'                  => __( 'Not Found', 'assignment-data-tool' ),
          'no_terms'                   => __( 'No items', 'assignment-data-tool' ),
          'items_list'                 => __( 'Items list', 'assignment-data-tool' ),
          'items_list_navigation'      => __( 'Items list navigation', 'assignment-data-tool' ),
      );
      $args = array(
          'labels'                     => $labels,
          'hierarchical'               => true,
          'public'                     => true,
          'show_ui'                    => true,
          'show_admin_column'          => true,
          'show_in_nav_menus'          => true,
          'show_tagcloud'              => true,
      );
      register_taxonomy( 'sales_category', array( 'adt_listing' ), $args );

    }

    /* 
    * Create one or more meta boxes to be displayed on the post editor screen.
    */
    public function adt_add_post_meta_boxes() {

        add_meta_box(
          'adt-meta-box',      // Unique ID
          esc_html__( 'Listing Data', 'assignment-data-tool' ),    // Title
          [$this,'output_admin_adt_fields_meta_box'],   // Callback function
          'adt_listing',         // Admin page (or post type)
          'normal',         // Context
          'default'         // Priority
        );
      }

    /* 
    * Display the post meta box. 
    */
    public function output_admin_adt_fields_meta_box( $post ) {
      include('templates/meta-box.php');
    }


    /**
     * Save meta fields
     */
    public function adt_save_post_meta_fields($post_id, $post ){

        /* Verify the nonce before proceeding. \*/
        //if ( isset( $_REQUEST['_wpnonce'] ) && wp_verify_nonce( $_REQUEST['_wpnonce'], 'adt_post_meta_nonce' ) )
        //return $post_id;
      

        $sales_agent = ( isset( $_POST['sales-agent'] ) ? sanitize_html_class( $_POST['sales-agent'] ) : '' );
        $sales_region = ( isset( $_POST['sales-region'] ) ? sanitize_html_class( $_POST['sales-region'] ) : '' );
        $sales_category = ( isset( $_POST['sales-category'] ) ? sanitize_html_class( $_POST['sales-category'] ) : '' );
        $forecast_amount = ( isset( $_POST['forecast-amount'] ) ? sanitize_html_class( $_POST['forecast-amount'] ) : '' );
        $probablity_sales = ( isset( $_POST['probablity-sales'] ) ? sanitize_html_class( $_POST['probablity-sales'] ) : '' );


        update_post_meta($post_id,'_adt_sales_agent',$sales_agent);
        update_post_meta($post_id,'_adt_sales_region',$sales_region);
        update_post_meta($post_id,'_adt_forecast_amount',$forecast_amount);
        update_post_meta($post_id,'_adt_probablity_sales',$probablity_sales);

    }

    public function adt_listing_content($content){

      global $post;

		if ( ! is_singular( 'adt_listing' ) || ! in_the_loop() ) {
			return $content;
		}

    remove_filter( 'the_content', array( $this, 'adt_listing_content' ) );

    if ( 'adt_listing' === $post->post_type ) {

      ob_start();

			do_action( 'adt_content_start' );

			include( 'templates/single-adt.php' );

			do_action( 'adt_content_end' );

			$content = ob_get_clean();
    }

    return apply_filters( 'adt_single_listing_content', $content, $post );
    }

}

new ADT_Post_Types();