<?php /* Template Name: Employee */ ?>
<?php get_header(); ?>
<main id="content">
  	<?php   
    // Custom WP query query
$args_query = array(
	'post_type' => array('employee'),
	'post_status' => array('publish'),
	'order' => 'DESC',
);

$query = new WP_Query( $args_query );

if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		
	if ( has_post_thumbnail() ) { the_post_thumbnail(); } 
	the_title();
the_content();
	}
} else {

}

wp_reset_postdata();

?>
</main>

<?php get_footer(); ?>