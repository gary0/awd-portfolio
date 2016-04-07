<?php

/**
 * The plugin bootstrap file
 *
 * This file includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://anarchywebdev.com/
 * @since             1.0.0
 * @package           awd_portfolio
 *
 * @wordpress-plugin
 * Plugin Name: AWD Portfolio CPT
 * Plugin URI: http://anarchywebdev.com/
 * Version: 1.0
 * Author: AWD
 * Author URI: http://anarchywebdev.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plugin-name
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_awd_portfolio() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-awd-portfolio-activator.php';
	AWD_Portfolio_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_awd_portfolio() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-awd-portfolio-deactivator.php';
	AWD_Portfolio_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_awd_portfolio' );
register_deactivation_hook( __FILE__, 'deactivate_awd_portfolio' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-awd-portfolio.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
/*function run_plugin_name() {

	$plugin = new AWD_Portfolio();
	$plugin->run();

}
run_plugin_name();*/


/**** Portfolio Items ****/
add_action( 'init', 'awd_portfolio_register' );

function awd_portfolio_register() {
    register_post_type( 'portfolio',
        array(
            'labels' => array(
                'name' => 'Portfolio Items',
                'singular_name' => 'Portfolio Item',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Portfolio Item',
                'edit' => 'Edit',
                'edit_item' => 'Edit Portfolio Item',
                'new_item' => 'New Portfolio Item',
                'view' => 'View',
                'view_item' => 'View Portfolio Item',
                'search_items' => 'Search Portfolio Items',
                'not_found' => 'No Portfolio Items found',
                'not_found_in_trash' => 'No Portfolio Items found in Trash',
                'parent' => 'Parent Portfolio Item'
            ),
 
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( '' ),
            'menu_icon' => plugins_url( 'images/image.png', __FILE__ ),
            'has_archive' => true
        ));
    register_taxonomy("Skills", 
      array(
        "portfolio"), array(
        "hierarchical" => true, "label" => "Skills", "singular_label" => "Skill", "rewrite" => true));

}


/* add custom data fields to the add/edit post page */
add_action("admin_init", "admin_init");
 
function admin_init(){
  /* The ‘year completed’ is placed in the sidebar using ‘side’ whilst the ‘credits’ are placed in the main flow of the page using ‘normal’.*/
  add_meta_box("year_completed-meta", "Year Completed", "year_completed", "portfolio", "side", "low");
  add_meta_box("credits_meta", "Design &amp; Build Credits", "credits_meta", "portfolio", "normal", "low");
}
 
function year_completed(){
  /* Make sure to include "global $post;" so that we can then query the current post using the folowing */
  global $post;
  $custom = get_post_custom($post->ID);
  $year_completed = $custom["year_completed"][0];
  ?>
  <label>Year:</label>
  <input name="year_completed" value="<?php echo $year_completed; ?>" />
  <?php
}
 
function credits_meta() {
  global $post;
  $custom = get_post_custom($post->ID);
  $designers = $custom["designers"][0];
  $developers = $custom["developers"][0];
  $producers = $custom["producers"][0];
  ?>
  <p><label>Designed By:</label><br />
  <textarea cols="50" rows="5" name="designers"><?php echo $designers; ?></textarea></p>
  <p><label>Built By:</label><br />
  <textarea cols="50" rows="5" name="developers"><?php echo $developers; ?></textarea></p>
  <p><label>Produced By:</label><br />
  <textarea cols="50" rows="5" name="producers"><?php echo $producers; ?></textarea></p>
  <?php
}

/**** make sure we save the values with this post ****/
add_action('save_post', 'save_details');
function save_details(){
  global $post;
 
  update_post_meta($post->ID, "year_completed", $_POST["year_completed"]);
  update_post_meta($post->ID, "designers", $_POST["designers"]);
  update_post_meta($post->ID, "developers", $_POST["developers"]);
  update_post_meta($post->ID, "producers", $_POST["producers"]);
}

/**** adding two more functions to the WordPress Admin */
add_action("manage_posts_custom_column",  "portfolio_custom_columns");
add_filter("manage_edit-portfolio_columns", "portfolio_edit_columns");
 
function portfolio_edit_columns($columns){
  $columns = array(
    "cb" => "<input type='checkbox' />",
    "title" => "Portfolio Title",
    "description" => "Description",
    "year" => "Year Completed",
    "skills" => "Skills",
  );
 
  return $columns;
}
/**** Using a simple switch/case we can define what data to show in the column layout */
function portfolio_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "description":
      the_excerpt();
      break;
    case "year":
      $custom = get_post_custom();
      echo $custom["year_completed"][0];
      break;
    case "skills":
      echo get_the_term_list($post->ID, 'Skills', '', ', ','');
      break;
  }
}

// create shortcode to list all portfolio items
add_shortcode( 'list-posts-portfolio', 'portfolio_post_listing_shortcode' );
function portfolio_post_listing_shortcode( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'portfolio',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'title',
    ) );
    if ( $query->have_posts() ) { ?>
            
        <?php while ( $query->have_posts() ) : $query->the_post(); 
          get_template_part( 'page-templates/portfolio', get_post_format() );
        endwhile;
        wp_reset_postdata(); ?>
        
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}