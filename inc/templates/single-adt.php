<?php
 $post_id =  $post->ID;
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

<ul class="adt-single-listing-fields">
    <li>Sales agent: <?php printf(__("%s",'assignment-data-tool'),$sales_agent);?></li>
    <li>Sales region: <?php printf(__("%s",'assignment-data-tool'),$sales_region);?></li>
    <li>Sales category: <?php printf(__("%s",'assignment-data-tool'),$sales_category);?></li>
    <li>Forecast amount: <?php printf(__("%s",'assignment-data-tool'),$forecast);?></li>
    <li>Probability of sale: <?php printf(__("%s",'assignment-data-tool'),$probablity);?></li>
</ul>