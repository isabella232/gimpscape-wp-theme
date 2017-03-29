<?php
//add suppport post-thumbnails for post page
add_theme_support( 'post-thumbnails' );

//enable menu location on appearance theme
function register_my_menus() {
  register_nav_menus(
    array(
      'top-navbar' => __( 'Header Nav' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

//enable widget sidebar
function sidebar_widgets_init() {
	register_sidebar(
      array(
  		'name'          => 'Sidebar',
  		'id'            => 'sidebar',
  		'before_widget' => '<div class="blog-widget">',
  		'after_widget'  => '</div>',
  		'before_title'  => '<div class="blog-widget-title">',
  		'after_title'   => '</div>',
      ));
}
add_action( 'widgets_init', 'sidebar_widgets_init' );

//enable widget wide
function footer_wide_widgets_init() {
	register_sidebar(
      array(
  		'name'          => 'Footer Wide',
  		'id'            => 'footer_wide',
  		'before_widget' => '<div class="footer-widget">',
  		'after_widget'  => '</div>',
  		'before_title'  => '<div class="footer-title-hidden">',
  		'after_title'   => '</div>',
      ));
}
add_action( 'widgets_init', 'footer_wide_widgets_init' );

//enable widget footer1
function footer_widgets_init() {
	register_sidebar(
      array(
  		'name'          => 'Footer 1-4',
  		'id'            => 'footer_1',
  		'before_widget' => '<div class="col-md-2"><div class="footer-widget">',
  		'after_widget'  => '</div></div>',
  		'before_title'  => '<div class="footer-widget-title">',
  		'after_title'   => '</div>',
      ));
}
add_action( 'widgets_init', 'footer_widgets_init' );


// Membuat Menu slideshow di Halaman admin
add_action('init','add_menu_slideshow');
function add_menu_slideshow(){
	register_post_type(
		'slideshow',
		array(
			'labels' 		=> array(
				'name'				=> __( 'Semua Slideshow', 'slideshow'),
				'singular_name' 	=> __( 'Slide', 'slideshow' ),
				'add_new' 			=> __( 'Tambah slide', 'add_new' ),
				'add_new_item' 		=> __( 'Tambah Slide', 'add_new_slide' ),
				'edit_item' 		=> __( 'Edit Slide', 'edit_slide' ),
				'new_item' 			=> __( 'Slide Baru', 'new_slide' ),
				'view_item' 		=> __( 'Lihat', 'view_slide' ),
				'search_items'		=> __( 'Search Slide', 'search_slide' ),
				'not_found'			=> __( 'Not Found', 'slide_not_found' ),
				'not_found_in_trash'=> __( 'Slide Not Found in Trash', 'trash_slide_not_found' ),
				'parent_item_colon'	=> __( 'Parent Slide Item : ', 'parent_slide' ),
				'menu_name'			=> __( 'Slideshow', 'slideshow' )
			),
			'hierarchical' 	=> false,
			'public' 		=> true,
			'has_archive' 	=> true,
			'description'	=> 'Carousel Slideshow',
			'menu_icon' 	=> 'dashicons-images-alt2',
			'supports'		=> array(
				'title',
				'thumbnail'
			),
			'show_ui'		=> true,
			'show_in_menu'	=> true,
			'menu_position'	=> 3,
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => true,
			'rewrite'	=> array('slug'=>'slideshow')
		)
	);
}

// Membuat Menu Karya di halaman admin
add_action('init','add_menu_karya');
function add_menu_karya(){
	register_post_type(
		'karya',
		array(
			'labels' 		=> array(
				'name'				=> __( 'Semua Karya', 'karya'),
				'singular_name' 	=> __( 'Karya', 'karya' ),
				'add_new' 			=> __( 'Tambah Karya', 'add_new' ),
				'add_new_item' 		=> __( 'Tambah Karya', 'add_new_karya' ),
				'edit_item' 		=> __( 'Edit Karya', 'edit_karya' ),
				'new_item' 			=> __( 'Karya Baru', 'new_karya' ),
				'view_item' 		=> __( 'Lihat', 'view_karya' ),
				'search_items'		=> __( 'Search Karya', 'search_karya' ),
				'not_found'			=> __( 'Not Found', 'karya_not_found' ),
				'not_found_in_trash'=> __( 'Karnya Not Found in Trash', 'trash_karya_not_found' ),
				'parent_item_colon'	=> __( 'Parent Karya Item : ', 'parent_karya' ),
				'menu_name'			=> __( 'Ruang Karya', 'karya' )
			),
			'hierarchical' 	=> true,
			'public' 		=> true,
			'has_archive' 	=> true,
			'description'	=> 'Ruang Karya Gimpscape',
			'menu_icon' 	=> 'dashicons-format-image',
			'supports'		=> array(
				'title',
				'thumbnail',
        'custom-fields',
        'comments',
        'editor'
			),
			'show_ui'		=> true,
			'show_in_menu'	=> true,
			'menu_position'	=> 3,
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => true,
			'rewrite'	=> array('slug'=>'karya')
		)
	);
}
// Tambah taxonomy
add_action( 'init', 'register_taxonomy_karya');
function register_taxonomy_karya(){
	register_taxonomy(
		'kategori',
		'karya',
		array(
			'labels' => array(
				'not_found'	=> 'Not Found'
			),
			'hierarchical'	=> true,
			'label'			=> 'Kategori Karya',
		)
	);
}

// function switch_on_comments_automatically(){
//     global $wpdb;
//     $wpdb->query( $wpdb->prepare("UPDATE $wpdb->posts SET comment_status = 'open'")); // Switch comments on automatically
// }
// switch_on_comments_automatically();

//redirect to refrence url
add_filter('comment_post_redirect', 'redirect_after_comment');
function redirect_after_comment($location)
{
return $_SERVER["HTTP_REFERER"];
}

// ==========================
// ==membuat theme setting===
// ===========================
function theme_settings_page()
{
?>
<div class="wrap">
	    <h1>GimpScape Homepage Editor</h1>
	    <form method="post" action="options.php">
	        <?php
              settings_fields("section");
              settings_fields("features");
	            settings_fields("support");
	            do_settings_sections("theme-options");
	            submit_button();
	        ?>
	    </form>
		</div>
<?php
}

function add_theme_menu_item()
{
	add_menu_page("Homepage Editor", "Homepage Editor", "manage_options", "theme-panel", "theme_settings_page", 'dashicons-admin-home', 3);
}

add_action("admin_menu", "add_theme_menu_item");

function display_topleft_info()
{
	?>
    	<textarea name="topleft_info" id="topleft_info" cols="40" rows="8"><?php echo get_option('topleft_info'); ?></textarea>
    <?php
}

function display_topright_info()
{
	?>
  <textarea name="topright_info" id="topright_info"  cols="40" rows="8"><?php echo get_option('topright_info'); ?></textarea>
    <?php
}

function display_topimage_banner_url()
{
	?>
  <input type="text" name="topimage_banner_url" id="topimage_banner_url"  value="<?php echo get_option('topimage_banner_url'); ?>"/>
  <p>*copy url gambar dari media library</p>
    <?php
}


function display_topimage_banner()
{
	?>
  <textarea name="topimage_banner" id="topimage_banner"  cols="40" rows="8"><?php echo get_option('topimage_banner'); ?></textarea>
    <?php
}

function display_features_desc()
{
	?>
  <textarea name="features_desc" id="features_desc"  cols="40" rows="8"><?php echo get_option('features_desc'); ?></textarea>
    <?php
}

function display_left_features()
{
	?>
  <textarea name="left_features" id="left_features"  cols="40" rows="8"><?php echo get_option('left_features'); ?></textarea>
    <?php
}

function display_mid_features()
{
	?>
  <textarea name="mid_features" id="mid_features"  cols="40" rows="8"><?php echo get_option('mid_features'); ?></textarea>
    <?php
}

function display_right_features()
{
	?>
  <textarea name="right_features" id="right_features"  cols="40" rows="8"><?php echo get_option('right_features'); ?></textarea>
    <?php
}

function display_support_title()
{
	?>
  <input type="text" name="support_title" id="support_title" value="<?php echo get_option('support_title'); ?>">
    <?php
}

function display_support_desc()
{
	?>
  <textarea name="support_desc" id="support_desc"  cols="40" rows="8"><?php echo get_option('support_desc'); ?></textarea>
    <?php
}

function display_support_bg()
{
	?>
  <input type="text" name="support_bg" id="support_bg" value="<?php echo get_option('support_bg'); ?>">

    <?php
}

function display_support_icon()
{
	?>
  <input type="text" name="support_icon" id="support_icon" value="<?php echo get_option('support_icon'); ?>">

    <?php
}

function display_theme_panel_fields()
{
	add_settings_section("section", "Top Info Section", null, "theme-options");
	add_settings_field("topleft_info", "Top Left Info", "display_topleft_info", "theme-options", "section");
  add_settings_field("topright_info", "Top Right Info", "display_topright_info", "theme-options", "section");
  add_settings_field("topimage_banner_url", "Top Image Banner Url", "display_topimage_banner_url", "theme-options", "section");
  add_settings_field("topimage_banner", "Top Image Banner Text", "display_topimage_banner", "theme-options", "section");

  add_settings_section("features", "Fitur Section (Background Biru)", null, "theme-options");
  add_settings_field("features_desc", "Fitur Description Text", "display_features_desc", "theme-options", "features");
  add_settings_field("left_features", "Fitur Kiri", "display_left_features", "theme-options", "features");
  add_settings_field("mid_features", "Fitur Tengah", "display_mid_features", "theme-options", "features");
  add_settings_field("right_features", "Fitur Kanan", "display_right_features", "theme-options", "features");

  add_settings_section("support", "Support Section", null, "theme-options");
  add_settings_field("support_bg", "Gambar Background Url", "display_support_bg", "theme-options", "support");
  add_settings_field("support_title", "Judul", "display_support_title", "theme-options", "support");
  add_settings_field("support_icon", "Icon Url", "display_support_icon", "theme-options", "support");
  add_settings_field("support_desc", "Description Text", "display_support_desc", "theme-options", "support");


  register_setting("section", "topleft_info");
  register_setting("section", "topright_info");
  register_setting("section", "topimage_banner_url");
  register_setting("section", "topimage_banner");
  register_setting("features", "features_desc");
  register_setting("features", "left_features");
  register_setting("features", "mid_features");
  register_setting("features", "right_features");
  register_setting("support", "support_bg");
  register_setting("support", "support_title");
  register_setting("support", "support_icon");
  register_setting("support", "support_desc");

}

add_action("admin_init", "display_theme_panel_fields");

?>
