<?php

function sd_scripts_enqueue() {
    wp_enqueue_script('kit','//kit.fontawesome.com/1beb187cca.js', true);
    wp_enqueue_script('wow','//cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js');
    wp_enqueue_script('bootstrap_js','//maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js');
    wp_enqueue_script('wow','//cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js');
    wp_enqueue_script('myjs',get_stylesheet_directory_uri() . '/js/myjs.js');
    
}

add_action( 'wp_enqueue_scripts', 'sd_scripts_enqueue',11);



function sd_styles_enqueue() {
    wp_enqueue_style('bootstrap','//maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css');
    wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/css/main.css');
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,800');
    wp_enqueue_style( 'animate', '//cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css');
    // wp_enqueue_style( 'fontawesome', '//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
}
add_action( 'wp_enqueue_scripts', 'sd_styles_enqueue',1 );



add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup() {
load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'search-form' ) );
global $content_width;
if ( ! isset( $content_width ) ) { $content_width = 1920; }
register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'blankslate' ) ) );
}
add_action( 'wp_enqueue_scripts', 'blankslate_load_scripts' );
function blankslate_load_scripts() {
wp_enqueue_style( 'blankslate-style', get_stylesheet_uri() );
wp_enqueue_script( 'jquery' );
}
add_action( 'wp_footer', 'blankslate_footer_scripts' );
function blankslate_footer_scripts() {
?>
<script>
jQuery(document).ready(function ($) {
var deviceAgent = navigator.userAgent.toLowerCase();
if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
$("html").addClass("ios");
$("html").addClass("mobile");
}
if (navigator.userAgent.search("MSIE") >= 0) {
$("html").addClass("ie");
}
else if (navigator.userAgent.search("Chrome") >= 0) {
$("html").addClass("chrome");
}
else if (navigator.userAgent.search("Firefox") >= 0) {
$("html").addClass("firefox");
}
else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
$("html").addClass("safari");
}
else if (navigator.userAgent.search("Opera") >= 0) {
$("html").addClass("opera");
}
});
</script>
<?php
}
add_filter( 'document_title_separator', 'blankslate_document_title_separator' );
function blankslate_document_title_separator( $sep ) {
$sep = '|';
return $sep;
}
add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
if ( $title == '' ) {
return '...';
} else {
return $title;
}
}
add_filter( 'the_content_more_link', 'blankslate_read_more_link' );
function blankslate_read_more_link() {
if ( ! is_admin() ) {
return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">...</a>';
}
}
add_filter( 'excerpt_more', 'blankslate_excerpt_read_more_link' );
function blankslate_excerpt_read_more_link( $more ) {
if ( ! is_admin() ) {
global $post;
return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">...</a>';
}
}
add_filter( 'intermediate_image_sizes_advanced', 'blankslate_image_insert_override' );
function blankslate_image_insert_override( $sizes ) {
unset( $sizes['medium_large'] );
return $sizes;
}
add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init() {
register_sidebar( array(
'name' => esc_html__( 'Sidebar Widget Area', 'blankslate' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
add_action( 'wp_head', 'blankslate_pingback_header' );
function blankslate_pingback_header() {
if ( is_singular() && pings_open() ) {
printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
}
}
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script() {
if ( get_option( 'thread_comments' ) ) {
wp_enqueue_script( 'comment-reply' );
}
}
function blankslate_custom_pings( $comment ) {
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php
}
add_filter( 'get_comments_number', 'blankslate_comment_count', 0 );
function blankslate_comment_count( $count ) {
if ( ! is_admin() ) {
global $id;
$get_comments = get_comments( 'status=approve&post_id=' . $id );
$comments_by_type = separate_comments( $get_comments );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}

// Shortcodes
include ('shortcodes.php');

// Register Custom Post Type Employee
function create_employee_cpt() {

	$labels = array(
		'name' => _x( 'Employees', 'Post Type General Name', 'textdomain' ),
		'singular_name' => _x( 'Employee', 'Post Type Singular Name', 'textdomain' ),
		'menu_name' => _x( 'Employees', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar' => _x( 'Employee', 'Add New on Toolbar', 'textdomain' ),
		'archives' => __( 'Employee Archives', 'textdomain' ),
		'attributes' => __( 'Employee Attributes', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Employee:', 'textdomain' ),
		'all_items' => __( 'All Employees', 'textdomain' ),
		'add_new_item' => __( 'Add New Employee', 'textdomain' ),
		'add_new' => __( 'Add New', 'textdomain' ),
		'new_item' => __( 'New Employee', 'textdomain' ),
		'edit_item' => __( 'Edit Employee', 'textdomain' ),
		'update_item' => __( 'Update Employee', 'textdomain' ),
		'view_item' => __( 'View Employee', 'textdomain' ),
		'view_items' => __( 'View Employees', 'textdomain' ),
		'search_items' => __( 'Search Employee', 'textdomain' ),
		'not_found' => __( 'Not found', 'textdomain' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
		'featured_image' => __( 'Featured Image', 'textdomain' ),
		'set_featured_image' => __( 'Set featured image', 'textdomain' ),
		'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
		'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
		'insert_into_item' => __( 'Insert into Employee', 'textdomain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Employee', 'textdomain' ),
		'items_list' => __( 'Employees list', 'textdomain' ),
		'items_list_navigation' => __( 'Employees list navigation', 'textdomain' ),
		'filter_items_list' => __( 'Filter Employees list', 'textdomain' ),
	);
	$args = array(
		'label' => __( 'Employee', 'textdomain' ),
		'description' => __( '', 'textdomain' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-businessman',
		'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
		
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'employee', $args );

}
add_action( 'init', 'create_employee_cpt', 0 );




function myshort() {
    ob_start(); ?>
    
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto mt-5">

    
<?php
    $args = array( 'post_type' => 'employee', 'posts_per_page' => -1 );
    $loop = new WP_Query( $args );
    while ( $loop->have_posts() ) : $loop->the_post();
?>

<div class="employee_element d-flex mt-5">
        <div class="image">
            <?php the_post_thumbnail(); ?>
        </div>
        <div class="text ml-5 d-table">
            <h3><?php the_title(); ?></h3>
            <p><strong>Position: </strong><?php echo get_post_meta(get_the_ID(), 'employee_position', true ); ?></p>
        </div>
</div>
<section class="hidden">
                <div class="hidden_wrap">
                <div class="close_x">X</div>
                <h3><?php the_title(); ?></h3>
                <?php the_content(); ?>
                <section class="social_media">
<?php $meta_value = get_post_meta( get_the_ID(), 'employee_github', true ); 
			if  (!empty( $meta_value )) {echo '<a href="' . $meta_value . '" target="_blank"><i class="fab fa-github"></i></a>';}
			else {} ?>
			<?php $meta_value = get_post_meta( get_the_ID(), 'employee_linkedin', true ); 
			if  (!empty( $meta_value )) {echo '<a href="' . $meta_value . '" target="_blank"><i class="fab fa-linkedin"></i></a>';}
			else {} ?>
			<?php $meta_value = get_post_meta( get_the_ID(), 'employee_xing', true ); 
			if  (!empty( $meta_value )) {echo '<a href="' . $meta_value . '" target="_blank"><i class="fab fa-xing"></i></a>';}
			else {} ?>
			<?php $meta_value = get_post_meta( get_the_ID(), 'employee_facebook', true ); 
			if  (!empty( $meta_value )) {echo '<a href="' . $meta_value . '" target="_blank"><i class="fab fa-facebook"></i></a>';}
			else {} ?>
</section>
                </div>
            </section>

<?php endwhile; ?>

        </div>
      </div>
    </div>

 <?php   return ob_get_clean(); 
}

add_shortcode('doitman', 'myshort');




function member_add_meta_box() {
//this will add the metabox for the member post type
$screens = array( 'employee' );

foreach ( $screens as $screen ) {

    add_meta_box(
        'member_sectionid',
        __( 'Employee Details', 'member_textdomain','member_textdomain2','member_textdomain3','member_textdomain4','member_textdomain5'),
        'member_meta_box_callback',
        $screen
    );
 }
}
add_action( 'add_meta_boxes', 'member_add_meta_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function member_meta_box_callback( $post ) {

// Add a nonce field so we can check for it later.
wp_nonce_field( 'member_save_meta_box_data', 'member_meta_box_nonce' );
/*
 * Use get_post_meta() to retrieve an existing value
 * from the database and use the value for the form.
 */
$value = get_post_meta( $post->ID, 'employee_position', true );

echo '<label for="member_new_field">';
_e( 'Position', 'member_textdomain' );
echo '</label> ';
echo '<input type="text" id="member_new_field" name="member_new_field" value="' . esc_attr( $value ) . '" size="25" />';
echo '<br>';
echo '<br>';
$value2 = get_post_meta( $post->ID, 'employee_github', true );

echo '<label for="member_github">';
_e( 'Github', 'member_textdomain2' );
echo '</label> ';
echo '<input type="text" id="member_github" name="member_github" value="' . esc_attr( $value2 ) . '" size="25" />';
echo '<br>';
echo '<br>';
$value3 = get_post_meta( $post->ID, 'employee_linkedin', true );

echo '<label for="member_linkedin">';
_e( 'Linkedin', 'member_textdomain3' );
echo '</label> ';
echo '<input type="text" id="member_linkedin" name="member_linkedin" value="' . esc_attr( $value3 ) . '" size="25" />';

echo '<br>';
echo '<br>';
$value4 = get_post_meta( $post->ID, 'employee_xing', true );

echo '<label for="member_xing">';
_e( 'Xing', 'member_textdomain4' );
echo '</label> ';
echo '<input type="text" id="member_xing" name="member_xing" value="' . esc_attr( $value4 ) . '" size="25" />';

echo '<br>';
echo '<br>';
$value5 = get_post_meta( $post->ID, 'employee_facebook', true );

echo '<label for="member_facebook">';
_e( 'Facebook', 'member_textdomain5' );
echo '</label> ';
echo '<input type="text" id="member_facebook" name="member_facebook" value="' . esc_attr( $value5 ) . '" size="25" />';
}
/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
 function member_save_meta_box_data( $post_id ) {

 if ( ! isset( $_POST['member_meta_box_nonce'] ) ) {
    return;
 }

 if ( ! wp_verify_nonce( $_POST['member_meta_box_nonce'], 'member_save_meta_box_data' ) ) {
    return;
 }

 if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
 }

 // Check the user's permissions.
 if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) ) {
        return;
    }

 } else {

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
 }

 if ( ! isset( $_POST['member_new_field'] ) ) {
    return;
 }

 $my_data = sanitize_text_field( $_POST['member_new_field'] );

 update_post_meta( $post_id, 'employee_position', $my_data );
 
  $my_data2 = sanitize_text_field( $_POST['member_github'] );

 update_post_meta( $post_id, 'employee_github', $my_data2 );
 
   $my_data3 = sanitize_text_field( $_POST['member_linkedin'] );

 update_post_meta( $post_id, 'employee_linkedin', $my_data3 );
 
 $my_data4 = sanitize_text_field( $_POST['member_xing'] );

 update_post_meta( $post_id, 'employee_xing', $my_data4 );
 
  $my_data5 = sanitize_text_field( $_POST['member_facebook'] );

 update_post_meta( $post_id, 'employee_facebook', $my_data5 );
 
}
add_action( 'save_post', 'member_save_meta_box_data' );