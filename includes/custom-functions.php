<?php

add_action('wp_footer', 'ga');
 
function ga() { ?>
   
<?php }

/*==========================================================================
// Hide the admin bar on front-end
==========================================================================*/

show_admin_bar(false);

/*==========================================================================
// hide the wordpress login welcome screen for new users
==========================================================================*/

add_action( 'load-index.php', 'hide_welcome_panel' );

function hide_welcome_panel() {
    $user_id = get_current_user_id();

    if ( 1 == get_user_meta( $user_id, 'show_welcome_panel', true ) )
        update_user_meta( $user_id, 'show_welcome_panel', 0 );
}

/*==========================================================================
// Tidy the dashboard up for client
==========================================================================*/

function admin_remove_dashboard_widgets() {
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
} 
// Hoook into the 'wp_dashboard_setup' action to register our function
add_action('wp_dashboard_setup', 'admin_remove_dashboard_widgets' );

/*==========================================================================
// Remove rel attribute from the category list - html validation error - WP bug
==========================================================================*/

function remove_category_list_rel($output)
{
  $output = str_replace(' rel="category"', '', $output);
  return $output;
}
add_filter('wp_list_categories', 'remove_category_list_rel');
add_filter('the_category', 'remove_category_list_rel');

/*==========================================================================
// show featured image in admin posts view
==========================================================================*/

// set image size
add_image_size( 'admin-list-thumb', 100, 100, false );

// Add the posts and pages columns filter. They can both use the same function.
add_filter('manage_posts_columns', 'tcb_add_post_thumbnail_column', 5);
add_filter('manage_pages_columns', 'tcb_add_post_thumbnail_column', 5);

// Add the column
function tcb_add_post_thumbnail_column($cols){
  $cols['tcb_post_thumb'] = __('Featured');
  return $cols;
}

// Hook into the posts an pages column managing. Sharing function callback again.
add_action('manage_posts_custom_column', 'tcb_display_post_thumbnail_column', 5, 2);
add_action('manage_pages_custom_column', 'tcb_display_post_thumbnail_column', 5, 2);

// Grab featured-thumbnail size post thumbnail and display it.
function tcb_display_post_thumbnail_column($col, $id){
  switch($col){
    case 'tcb_post_thumb':
      if( function_exists('the_post_thumbnail') )
        echo the_post_thumbnail( 'admin-list-thumb' );
      else
        echo 'Not supported in theme';
      break;
  }
}

/*==========================================================================
// tidy menus for client - things they don't need for this build
==========================================================================*/

function my_remove_menu_pages()
{
	remove_menu_page('link-manager.php');
	remove_menu_page('tools.php');	
	remove_menu_page('edit-comments.php');
	remove_menu_page('wpcf7');
	remove_menu_page('cpt_main_menu');
	remove_menu_page('plugins.php');
	remove_menu_page( 'edit.php?post_type=acf');
	remove_submenu_page( 'index.php', 'update-core.php' );
	remove_submenu_page( 'options-general.php', 'options-discussion.php' );
	remove_submenu_page( 'options-general.php', 'thumbGen' );
	remove_submenu_page( 'options-general.php', 'simple-pagination' );
	remove_submenu_page( 'options-general.php', 'options-permalink.php' );
	remove_submenu_page( 'options-general.php', 'breadcrumb_navxt' );
	remove_submenu_page( 'options-general.php', 'simple-pagination/simple-pagination.php' );
}

// remove editor button (cant do it above)
function remove_editor_menu()
{
	remove_action('admin_menu', '_add_themes_utility_last', 101);
}

// hide the header and background options for everybody but greensplash user
function remove_theme_options()
{

	remove_theme_support('custom-background');
	remove_theme_support('custom-header');

}
global $current_user;
       get_currentuserinfo();

if ($current_user->user_login !== "greensplash"){
	add_action( 'admin_menu', 'my_remove_menu_pages' );
	add_action('_admin_menu', 'remove_editor_menu', 1);
	add_action( 'after_setup_theme','remove_theme_options', 100 );
}

/*==========================================================================
// Filter Yoast Meta Priority
==========================================================================*/

add_filter( 'wpseo_metabox_prio', function() { return 'low'; }); 

?>