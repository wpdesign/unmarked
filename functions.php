<?php
/*
Author: Jihan Ahmed
URL: http://wpunmarked.com

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, etc.
*/

// Theme setup and custom theme supports.
require get_template_directory() . '/inc/functions/setup.php';

// Register widget area.
require get_template_directory() . '/inc/functions/widgets.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/functions/template-tags.php';

// Load functions to secure your WP install.
require get_template_directory() . '/inc/functions/cleanup.php';

// Customizer additions.
require get_template_directory() . '/inc/functions/customizer.php';

// Custom comment form.
require get_template_directory() . '/inc/functions/custom-comments.php';

// Load Jetpack compatibility file.
require get_template_directory() . '/inc/functions/jetpack.php';

// Custom functions that act independently of the theme templates.
require get_template_directory() . '/inc/functions/extras.php';

// Load unmarked breadcrumbs for WordPress
require get_template_directory() . '/inc/functions/breadcrumbs.php';

// Load custom Bootstrap pagination for WordPress
require get_template_directory() . '/inc/functions/wp_bootstrap_pagination.php';

// Load custom WordPress nav walker.
require get_template_directory() . '/inc/functions/class-wp-bootstrap-navwalker.php';

// Enqueue scripts and styles.
require get_template_directory() . '/inc/functions/enqueue-scripts.php';

// Fix WordPress gallery style with Bootstrap layout and css
include_once get_template_directory() . '/inc/functions/bootstrap-wp-gallery.php';

// Add googleFonts of your choice
function unmarked_fonts() {
  wp_enqueue_style('googleFonts', '//fonts.googleapis.com/css?family=Roboto:400,500,700');
}
add_action('wp_enqueue_scripts', 'unmarked_fonts');

// customize ACF path
add_filter('acf/settings/path', 'unmarked_settings_path');
function unmarked_settings_path( $path ) {
    $path = get_stylesheet_directory() . '/inc/acf/';
    return $path;
}
 
// customize ACF dir
add_filter('acf/settings/dir', 'unmarked_settings_dir');
function unmarked_settings_dir( $dir ) {
    $dir = get_stylesheet_directory_uri() . '/inc//acf/';
    return $dir; 
}
 
// Hide ACF field group menu item
//add_filter('acf/settings/show_admin', '__return_false');

// Include ACF
include_once( get_stylesheet_directory() . '/inc/acf/acf.php' );

// Customize the Archive Title
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;
        }
    return $title;
});



add_theme_support( 'yoast-seo-breadcrumbs' );

// Include Custom Posts
require get_template_directory() . '/inc/custom-post-type.php';

// Custom Excerpt
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
 
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}


// Limit except length to 125 characters.
function get_excerpt(){
$excerpt = get_the_content();
$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
$excerpt = strip_shortcodes($excerpt);
$excerpt = strip_tags($excerpt);
$excerpt = substr($excerpt, 0, 120);
$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
$excerpt = $excerpt.'...';
return $excerpt;
}

// Numbered Pagination
function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('&laquo;'),
    'next_text'       => __('&raquo;'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo '<nav class="pager">';
	echo '<div class="pages">';
      echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
	  echo "</div>";
    echo "</nav>";
  }

}