<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * ADT_Shortcodes class.
 */

class ADT_Shortcodes {
    /**
	 * Constructor
	 */

	public function __construct() {
        add_shortcode( 'adt_listing', array( $this, 'output_adt_listing' ) );
    }

    /**
	 * output_adt_listing function.
	 *
	 * @access public
	 * @param mixed $args
	 * @return void
	 */

	public function output_adt_listing( $atts ) {
        extract( shortcode_atts( array(
		    
			'id' => '',

		), $atts ) );

            $args = array(

                'post_type'   => 'adt_listing',
    
                'post_status' => 'publish',
    
                //'p'           => $id
            );
    
            $adt_listing = new WP_Query( $args );

			
            ob_start();

            if ( $adt_listing->have_posts() ) : ?>

            <?php include('templates/adt-table.php');?>

            <?php endif;

            wp_reset_postdata();

		return '<div class="adt_listings">' . ob_get_clean() . '</div>';
    }

}

new ADT_Shortcodes();