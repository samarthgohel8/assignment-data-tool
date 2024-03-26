<?php while ( $adt_listing->have_posts() ) : $adt_listing->the_post(); 
$post_id = get_the_ID();
$sales_agent = get_post_meta($post_id ,'_adt_sales_agent',true);
$sales_region = get_post_meta($post_id ,'_adt_sales_region',true);
$forecast = get_post_meta($post_id ,'_adt_forecast_amount',true);
$probablity = get_post_meta($post_id ,'_adt_probablity_sales',true);

$terms_list = array();
$terms = get_the_terms($post_id , 'sales_category');
if ($terms && !is_wp_error($terms)) {
    $term_names = array();
    foreach ($terms as $term) {
        $term_names[] = $term->name;
    }
    $terms_list[] = implode(', ', $term_names);
} else {
    $terms_list[] = ''; // If no terms found, add an empty string
}

$sales_category = implode(', ', $terms_list);
?>
    <tr>
        <td><a href="<?php echo esc_url(get_permalink($post_id));?>"><?php the_title();?></a></td>
        <td><?php printf(__('%s','assignment-data-tool'),$sales_agent);?></td>
        <td><?php printf(__('%s','assignment-data-tool'),$sales_region);?></td>
        <td><?php printf(__('%s','assignment-data-tool'),$sales_category);?></td>
        <td><?php printf(__('%s','assignment-data-tool'),$forecast);?></td>
        <td><?php printf(__('%s','assignment-data-tool'),$probablity);?></td>
    </tr>
<?php endwhile; ?>