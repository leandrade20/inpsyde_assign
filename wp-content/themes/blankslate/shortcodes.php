<?php 

// Create Shortcode parentlink
// Use the shortcode: [parentlink]

if( defined( 'WPB_VC_VERSION' ) ) {

function vc_parent_links($atts) {

  // Attributes
  $atts = shortcode_atts(
    array(
    'sublinks_title' => ''
  ),
    $atts, 'parentlink'
  );
  // Attributes in var
  $sublinks_title = $atts['sublinks_title'];

  // Output Code



$argsvar = array(
    'post_type'      => 'employee',
    'posts_per_page' => -1,
    // 'post_parent'    => '217',
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
 );

$output = "";

$output .= '<h2 style="line-height: 1.2em; text-align: left; letter-spacing:0px;" class="vc_custom_heading">'.$sublinks_title.'</h2>';

$output .= '<section>';

$output .= '<ul class="parent-page">';

ob_start();

$parloop = new WP_Query( $argsvar );

if ( $parloop->have_posts() ) {

      while ( $parloop->have_posts() ) { $parloop->the_post();

        $thetitle = the_title();
        $thumbnail = the_post_thumbnail();
        $thecontent = the_content();
        $output .= '<section>';
        $output .= '<div class="thumbnail">'. $thumbnail .'</div>';
        $output .= '<h2 class="title">'. $thetitle .'</h2>';
        $output .= '<p class="content">'. $thecontent .'</p>';
        $output .= '</section>';

      }
}



$output .= '</ul>';

$output .= '</section>';



  return $output;

}

ob_end_clean();

add_shortcode( 'parentlink', 'vc_parent_links' );

// Create Submenu list from parent for VC
add_action( 'vc_before_init', 'vc_parent_links_map' );

function vc_parent_links_map() {
  vc_map( array(
    'name' => __( 'Employee List', 'textdomain' ),
    'description' => __( 'Loads Sublinks from Parent', '' ),
    'base' => 'parentlink',
    'class' => 'sublinks',
    'show_settings_on_create' => false,
    'category' => __( 'Menus', 'textdomain'),
    'icon'    => get_template_directory_uri() . '/includes/images/portfolio.svg',
    'params' => array(
      array(
        'type' => 'textfield',
        'class' => '',
        'group' => __("General"),
        'admin_label' => true,
        'heading' => __( 'Title For Sublinks', 'textdomain' ),
        'param_name' => 'sublinks_title',
        'value' => '',
        'description' => __( 'This will be the title for the Portfolios Files.', 'textdomain' )
      ),
    )
  ) );
}
}// If VC Exist