<p>
    <label for="assignment-data-tool"><?php _e( "Sales Agent", 'assignment-data-tool' ); ?></label>
    <br />
    <input class="widefat" type="text" name="sales-agent" id="sales-agent" value="<?php echo esc_attr( get_post_meta( $post->ID, '_adt_sales_agent', true ) ); ?>" size="30" />
  </p>

  <p>
    <label for="assignment-data-tool"><?php _e( "Sales Region", 'assignment-data-tool' ); ?></label>
    <br />
    <input class="widefat" type="text" name="sales-region" id="sales-region" value="<?php echo esc_attr( get_post_meta( $post->ID, '_adt_sales_region', true ) ); ?>" size="30" />
  </p>


  <p>
    <label for="assignment-data-tool"><?php _e( "Forcast Amount", 'assignment-data-tool' ); ?></label>
    <br />
    <input class="widefat" type="text" name="forecast-amount" id="forecast-amount" value="<?php echo esc_attr( get_post_meta( $post->ID, '_adt_forecast_amount', true ) ); ?>" size="30" />
  </p>
  <p>
    <label for="assignment-data-tool"><?php _e( "Probablity of Sales", 'assignment-data-tool' ); ?></label>
    <br />
    <input class="widefat" type="text" name="probablity-sales" id="probablity-sales" value="<?php echo esc_attr( get_post_meta( $post->ID, '_adt_probablity_sales', true ) ); ?>" size="30" />
  </p>