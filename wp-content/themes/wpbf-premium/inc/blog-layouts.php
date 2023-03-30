<?php
/**
 * Blog Layouts
 *
 * @package Page Builder Framework Premium Add-On
 */

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Premium Add-On Blog/CPT Archives
 * 
 * Returns the saved/activated Premium Add-On Blog Layouts
 */
function wpbf_get_blog_layout_settings( $get_cpts = false ) {

	$archives = array();

	$wpbf_settings = get_option( 'wpbf_settings' );

	if( isset( $wpbf_settings['wpbf_blog_layouts'] ) ) {

		$saved_archives = $wpbf_settings['wpbf_blog_layouts'];

		foreach ( $saved_archives as $saved_archive ) {

			// turn post type archives into CPT's
			if( $get_cpts && strpos( $saved_archive, '-' ) ) {
				$saved_archive = substr( $saved_archive, 0, strpos( $saved_archive, '-' ) );
			}

			$archives[] = $saved_archive;
		}

	}

	return $archives;

};

/**
 * Premium Add-On Blog/CPT Layouts
 */
add_filter( 'wpbf_blog_layouts', function( $blog_layouts ) {

	$blog_layouts['grid'] = esc_attr__( 'Grid', 'wpbfpremium' );

	return $blog_layouts;

});

/**
 * Premium Add-On Blog/CPT Archives
 */
add_filter( 'wpbf_archives', function( $archives ) {

	// Add Premium Archives to Archives array
	$archives = array_merge( $archives, wpbf_get_blog_layout_settings() );

	return $archives;

});

/**
 * Premium Add-On Blog/CPT Sidebars
 */
add_filter( 'wpbf_sidebar_layout', function( $sidebar ) {

	$saved_archives = wpbf_get_blog_layout_settings( $get_cpts = true );

	foreach( $saved_archives as $saved_archive ) {

		switch( $saved_archive ) {

			case 'blog':

				if ( is_home() ) {

					$blog_sidebar_position = get_theme_mod( 'blog_sidebar_layout', 'global' );
					$sidebar = $blog_sidebar_position !== 'global' ? $blog_sidebar_position : $sidebar;

				}

				break;

			case 'search':

				if ( is_search() ) {

					$search_sidebar_position = get_theme_mod( 'search_sidebar_layout', 'global' );
					$sidebar = $search_sidebar_position !== 'global' ? $search_sidebar_position : $sidebar;

				}

				break;
			
			case 'tag':

				if( is_tag() ) {

					$tag_sidebar_position = get_theme_mod( 'tag_sidebar_layout', 'global' );
					$sidebar = $tag_sidebar_position !== 'global' ? $tag_sidebar_position : $sidebar;

				}

				break;

			case 'category':

				if( is_category() ) {

					$category_sidebar_position = get_theme_mod( 'category_sidebar_layout', 'global' );
					$sidebar = $category_sidebar_position !== 'global' ? $category_sidebar_position : $sidebar;

				}

				break;

			case 'author':

				if( is_author() ) {

					$author_sidebar_position = get_theme_mod( 'author_sidebar_layout', 'global' );
					$sidebar = $author_sidebar_position !== 'global' ? $author_sidebar_position : $sidebar;

				}

				break;

			case 'date':

				if( is_date() ) {

					$date_sidebar_position = get_theme_mod( 'date_sidebar_layout', 'global' );
					$sidebar = $date_sidebar_position !== 'global' ? $date_sidebar_position : $sidebar;

				}

				break;

			default:

				if( is_post_type_archive( $saved_archive ) ) {

					$cpt_sidebar_layout = get_theme_mod( $saved_archive . '-archive_sidebar_layout', 'global' );
					$sidebar = $cpt_sidebar_layout !== 'global' ? $cpt_sidebar_layout : $sidebar;

				}

				// apply to related taxonomies
				$taxonomies = get_object_taxonomies( $saved_archive, 'names' );

				if( !empty( $taxonomies ) ) {

					foreach( $taxonomies as $taxonomy ) {

						if( is_tax( $taxonomy ) ) {

							$cpt_sidebar_layout = get_theme_mod( $saved_archive . '-archive_sidebar_layout', 'global' );
							$sidebar = $cpt_sidebar_layout !== 'global' ? $cpt_sidebar_layout : $sidebar;

						}

					}

				}

				break;
		}

	}

	return $sidebar;

});

/**
 * Premium Add-On Blog/CPT Layout
 */
add_filter( 'wpbf_blog_layout', function( $blog_layout ) {

	$saved_archives = wpbf_get_blog_layout_settings( $get_cpts = true );

	foreach( $saved_archives as $saved_archive ) {

		switch ( $saved_archive ) {

			case 'blog':

				if( is_home() ) {

					$template_parts_header = get_theme_mod( 'blog_sortable_header', array( 'title', 'meta', 'featured' ) );
					$template_parts_footer = get_theme_mod( 'blog_sortable_footer', array( 'readmore', 'categories' ) );
					$blog_layout           = get_theme_mod( 'blog_layout', 'default' );
					$style                 = get_theme_mod( 'blog_post_style', 'plain' );
					$stretched             = get_theme_mod( 'blog_boxed_image_streched', false );

					if( $blog_layout !== 'beside' && $style == 'boxed' && $stretched ) {
						$style             .= ' stretched';
					}

					$blog_layout = array( 'blog_layout' => $blog_layout, 'template_parts_header' => $template_parts_header, 'template_parts_footer' => $template_parts_footer, 'style' => $style );

				}

				break;

			case 'search':

				if( is_search() ) {

					$template_parts_header = get_theme_mod( 'search_sortable_header', array( 'title', 'meta', 'featured' ) );
					$template_parts_footer = get_theme_mod( 'search_sortable_footer', array( 'readmore', 'categories' ) );
					$blog_layout           = get_theme_mod( 'search_layout', 'default' );
					$style                 = get_theme_mod( 'search_post_style', 'plain' );
					$stretched             = get_theme_mod( 'search_boxed_image_streched', false );

					if( $blog_layout !== 'beside' && $style == 'boxed' && $stretched ) {
						$style             .= ' stretched';
					}

					$blog_layout = array( 'blog_layout' => $blog_layout, 'template_parts_header' => $template_parts_header, 'template_parts_footer' => $template_parts_footer, 'style' => $style );

				}

				break;

			case 'category':

				if( is_category() ) {

					$template_parts_header = get_theme_mod( 'category_sortable_header', array( 'title', 'meta', 'featured' ) );
					$template_parts_footer = get_theme_mod( 'category_sortable_footer', array( 'readmore', 'categories' ) );
					$blog_layout           = get_theme_mod( 'category_layout', 'default' );
					$style                 = get_theme_mod( 'category_post_style', 'plain' );
					$stretched             = get_theme_mod( 'category_boxed_image_streched', false );

					if( $blog_layout !== 'beside' && $style == 'boxed' && $stretched ) {
						$style             .= ' stretched';
					}

					$blog_layout = array( 'blog_layout' => $blog_layout, 'template_parts_header' => $template_parts_header, 'template_parts_footer' => $template_parts_footer, 'style' => $style );

				}
				
				break;

			case 'tag':
				
				if( is_tag() ) {

					$template_parts_header = get_theme_mod( 'tag_sortable_header', array( 'title', 'meta', 'featured' ) );
					$template_parts_footer = get_theme_mod( 'tag_sortable_footer', array( 'readmore', 'categories' ) );
					$blog_layout           = get_theme_mod( 'tag_layout', 'default' );
					$style                 = get_theme_mod( 'tag_post_style', 'plain' );
					$stretched             = get_theme_mod( 'tag_boxed_image_streched', false );

					if( $blog_layout !== 'beside' && $style == 'boxed' && $stretched ) {
						$style             .= ' stretched';
					}

					$blog_layout = array( 'blog_layout' => $blog_layout, 'template_parts_header' => $template_parts_header, 'template_parts_footer' => $template_parts_footer, 'style' => $style );

				}

				break;

			case 'author':

				if( is_author() ) {

					$template_parts_header = get_theme_mod( 'author_sortable_header', array( 'title', 'meta', 'featured' ) );
					$template_parts_footer = get_theme_mod( 'author_sortable_footer', array( 'readmore', 'categories' ) );
					$blog_layout           = get_theme_mod( 'author_layout', 'default' );
					$style                 = get_theme_mod( 'author_post_style', 'plain' );
					$stretched             = get_theme_mod( 'author_boxed_image_streched', false );

					if( $blog_layout !== 'beside' && $style == 'boxed' && $stretched ) {
						$style             .= ' stretched';
					}

					$blog_layout = array( 'blog_layout' => $blog_layout, 'template_parts_header' => $template_parts_header, 'template_parts_footer' => $template_parts_footer, 'style' => $style );

				}
				
				break;

			case 'date':

				if( is_date() ) {

					$template_parts_header = get_theme_mod( 'date_sortable_header', array( 'title', 'meta', 'featured' ) );
					$template_parts_footer = get_theme_mod( 'date_sortable_footer', array( 'readmore', 'categories' ) );
					$blog_layout           = get_theme_mod( 'date_layout', 'default' );
					$style                 = get_theme_mod( 'date_post_style', 'plain' );
					$stretched             = get_theme_mod( 'date_boxed_image_streched', false );

					if( $blog_layout !== 'beside' && $style == 'boxed' && $stretched ) {
						$style             .= ' stretched';
					}

					$blog_layout = array( 'blog_layout' => $blog_layout, 'template_parts_header' => $template_parts_header, 'template_parts_footer' => $template_parts_footer, 'style' => $style );

				}
				
				break;
			
			default:

				if( is_post_type_archive( $saved_archive ) ) {

					$template_parts_header = get_theme_mod( $saved_archive . '-archive_sortable_header', array( 'title', 'meta', 'featured' ) );
					$template_parts_footer = get_theme_mod( $saved_archive . '-archive_sortable_footer', array( 'readmore', 'categories' ) );
					$blog_layout           = get_theme_mod( $saved_archive . '-archive_layout', 'default' );
					$style                 = get_theme_mod( $saved_archive . '-archive_post_style', 'plain' );
					$stretched             = get_theme_mod( $saved_archive . '-archive_boxed_image_streched', false );

					if( $blog_layout !== 'beside' && $style == 'boxed' && $stretched ) {
						$style             .= ' stretched';
					}

					$blog_layout = array( 'blog_layout' => $blog_layout, 'template_parts_header' => $template_parts_header, 'template_parts_footer' => $template_parts_footer, 'style' => $style );

				}

				// apply to related taxonomies
				$taxonomies = get_object_taxonomies( $saved_archive, 'names' );

				if( !empty( $taxonomies ) ) {

					foreach( $taxonomies as $taxonomy ) {

						if( is_tax( $taxonomy ) ) {

							$template_parts_header = get_theme_mod( $saved_archive . '-archive_sortable_header', array( 'title', 'meta', 'featured' ) );
							$template_parts_footer = get_theme_mod( $saved_archive . '-archive_sortable_footer', array( 'readmore', 'categories' ) );
							$blog_layout           = get_theme_mod( $saved_archive . '-archive_layout', 'default' );
							$style                 = get_theme_mod( $saved_archive . '-archive_post_style', 'plain' );
							$stretched             = get_theme_mod( $saved_archive . '-archive_boxed_image_streched', false );

							if( $blog_layout !== 'beside' && $style == 'boxed' && $stretched ) {
								$style             .= ' stretched';
							}

							$blog_layout = array( 'blog_layout' => $blog_layout, 'template_parts_header' => $template_parts_header, 'template_parts_footer' => $template_parts_footer, 'style' => $style );

						}

					}

				}

				break;
		}
	}

	return $blog_layout;

});

/**
 * Archive Headlines
 */
function wpbf_premium_archive_title( $title ) {

	$saved_archives = wpbf_get_blog_layout_settings( $get_cpts = true );

	foreach( $saved_archives as $saved_archive ) {

		switch( $saved_archive ) {

			case 'category':

				if( is_category() ) {

					$archive_headline  = get_theme_mod( 'category_headline' );

					if( $archive_headline == 'hide_prefix' ) {
						$title = single_cat_title( '', false );
					} elseif( $archive_headline == 'hide' ) {
						$title = false;
					} else {
						$title = sprintf( __( 'Category: %s' ), single_cat_title( '', false ) );
					}

				}

				break;

			case 'tag':

				if( is_tag() ) {

					$archive_headline  = get_theme_mod( 'tag_headline' );

					if( $archive_headline == 'hide_prefix' ) {
						$title = single_tag_title( '', false );
					} elseif( $archive_headline == 'hide' ) {
						$title = false;
					} else {
						$title = sprintf( __( 'Tag: %s' ), single_tag_title( '', false ) );
					}

				}
				
				break;

			case 'date':

				if( is_date() ) {

					$archive_headline  = get_theme_mod( 'date_headline' );

					$date   = get_the_date( 'F Y' );
					$period = sprintf( __( 'Month: %s' ), $date );

					if( is_year() ) {
						$date = get_the_date( 'Y' );
						$period = sprintf( __( 'Year: %s' ), $date );
					}

					if( is_day() ) {
						$date = get_the_date( 'F j, Y' );
						$period = sprintf( __( 'Day: %s' ), $date );
					}

					if( $archive_headline == 'hide_prefix' ) {
						$title = $date;
					} elseif( $archive_headline == 'hide' ) {
						$title = false;
					} else {
						$title = $period;
					}

				}
				
				break;
			
			default:

				$archive_headline = get_theme_mod( $saved_archive . '-archive_headline' );

				if( is_post_type_archive( $saved_archive ) ) {

					if( $archive_headline == 'hide_prefix' ) {
						$title = post_type_archive_title( '', false );
					} elseif( $archive_headline == 'hide' ) {
						$title = false;
					} else {
						$title = sprintf( __( 'Archives: %s' ), post_type_archive_title( '', false ) );
					}

				}

				// apply to related taxonomies
				$taxonomies = get_object_taxonomies( $saved_archive, 'names' );

				if( !empty( $taxonomies ) ) {

					foreach( $taxonomies as $taxonomy ) {
						if( is_tax( $taxonomy ) ) {
							if( $archive_headline == 'hide_prefix' ) {
								$title = single_term_title( '', false );
							} elseif( $archive_headline == 'hide' ) {
								$title = false;
							} else {
								$tax = get_taxonomy( get_queried_object()->taxonomy );
								$title = sprintf( __( '%1$s: %2$s' ), $tax->labels->singular_name, single_term_title( '', false ) );
							}
						}
					}

				}

				break;
		}

	}

	return $title;

};
add_filter( 'get_the_archive_title', 'wpbf_premium_archive_title', 20 );

/**
 * Grid Layout
 */
function wpbf_blog_layout_grid() {

	$blog_layout        = get_theme_mod( 'archive_layout', 'default' );
	$mobile_breakpoint  = get_theme_mod( 'archive_grid_mobile', 1 );
	$tablet_breakpoint  = get_theme_mod( 'archive_grid_tablet', 2 );
	$desktop_breakpoint = get_theme_mod( 'archive_grid_desktop', 3 );
	$grid_gap           = get_theme_mod( 'archive_grid_gap', 'small' );
	$masonry            = get_theme_mod( 'archive_grid_masonry' ) ? ' wpbf-post-grid-masonry opacity' : false;

	$grid = $blog_layout == 'grid' ? '<div class="wpbf-grid wpbf-post-grid'. $masonry .' wpbf-grid-'. esc_attr( $grid_gap ) .' wpbf-grid-1-'. esc_attr( $mobile_breakpoint ) .' wpbf-grid-small-1-'. esc_attr( $tablet_breakpoint ) .' wpbf-grid-large-1-'. esc_attr( $desktop_breakpoint ) .'">' : false;

	echo apply_filters( 'wpbf_blog_layout_grid', $grid );

}
add_action( 'wpbf_before_loop', 'wpbf_blog_layout_grid' );

/**
 * Grid Layout Close
 */
function wpbf_blog_layout_grid_close() {

	$blog_layout = get_theme_mod( 'archive_layout', 'default' );

	$grid = $blog_layout == 'grid' ? '</div>' : false;

	echo apply_filters( 'wpbf_blog_layout_grid_close', $grid );

}
add_action( 'wpbf_after_loop', 'wpbf_blog_layout_grid_close' );

/**
 * Filter Grid Layout
 */
add_filter( 'wpbf_blog_layout_grid', function( $grid ) {

	$saved_archives = wpbf_get_blog_layout_settings( $get_cpts = true );

	foreach( $saved_archives as $saved_archive ) {

		switch ( $saved_archive ) {

			case 'blog':

				if( is_home() ) {

					$blog_layout        = get_theme_mod( 'blog_layout', 'default' );
					$mobile_breakpoint  = get_theme_mod( 'blog_grid_mobile', 1 );
					$tablet_breakpoint  = get_theme_mod( 'blog_grid_tablet', 2 );
					$desktop_breakpoint = get_theme_mod( 'blog_grid_desktop', 3 );
					$grid_gap           = get_theme_mod( 'blog_grid_gap', 'small' );
					$masonry            = get_theme_mod( 'blog_grid_masonry' ) ? ' wpbf-post-grid-masonry opacity' : false;

					$grid = $blog_layout == 'grid' ? '<div class="wpbf-grid wpbf-post-grid'. $masonry .' wpbf-grid-'. esc_attr( $grid_gap ) .' wpbf-grid-1-'. esc_attr( $mobile_breakpoint ) .' wpbf-grid-small-1-'. esc_attr( $tablet_breakpoint ) .' wpbf-grid-large-1-'. esc_attr( $desktop_breakpoint ) .'">' : false;

				}

				break;

			case 'search':

				if( is_search() ) {

					$blog_layout        = get_theme_mod( 'search_layout', 'default' );
					$mobile_breakpoint  = get_theme_mod( 'search_grid_mobile', 1 );
					$tablet_breakpoint  = get_theme_mod( 'search_grid_tablet', 2 );
					$desktop_breakpoint = get_theme_mod( 'search_grid_desktop', 3 );
					$grid_gap           = get_theme_mod( 'search_grid_gap', 'small' );
					$masonry            = get_theme_mod( 'search_grid_masonry' ) ? ' wpbf-post-grid-masonry opacity' : false;

					$grid = $blog_layout == 'grid' ? '<div class="wpbf-grid wpbf-post-grid'. $masonry .' wpbf-grid-'. esc_attr( $grid_gap ) .' wpbf-grid-1-'. esc_attr( $mobile_breakpoint ) .' wpbf-grid-small-1-'. esc_attr( $tablet_breakpoint ) .' wpbf-grid-large-1-'. esc_attr( $desktop_breakpoint ) .'">' : false;

				}

				break;

			case 'category':

				if( is_category() ) {

					$blog_layout        = get_theme_mod( 'category_layout', 'default' );
					$mobile_breakpoint  = get_theme_mod( 'category_grid_mobile', 1 );
					$tablet_breakpoint  = get_theme_mod( 'category_grid_tablet', 2 );
					$desktop_breakpoint = get_theme_mod( 'category_grid_desktop', 3 );
					$grid_gap           = get_theme_mod( 'category_grid_gap', 'small' );
					$masonry            = get_theme_mod( 'category_grid_masonry' ) ? ' wpbf-post-grid-masonry opacity' : false;

					$grid = $blog_layout == 'grid' ? '<div class="wpbf-grid wpbf-post-grid'. $masonry .' wpbf-grid-'. esc_attr( $grid_gap ) .' wpbf-grid-1-'. esc_attr( $mobile_breakpoint ) .' wpbf-grid-small-1-'. esc_attr( $tablet_breakpoint ) .' wpbf-grid-large-1-'. esc_attr( $desktop_breakpoint ) .'">' : false;

				}

				break;

			case 'tag':

				if( is_tag() ) {

					$blog_layout        = get_theme_mod( 'tag_layout', 'default' );
					$mobile_breakpoint  = get_theme_mod( 'tag_grid_mobile', 1 );
					$tablet_breakpoint  = get_theme_mod( 'tag_grid_tablet', 2 );
					$desktop_breakpoint = get_theme_mod( 'tag_grid_desktop', 3 );
					$grid_gap           = get_theme_mod( 'tag_grid_gap', 'small' );
					$masonry            = get_theme_mod( 'tag_grid_masonry' ) ? ' wpbf-post-grid-masonry opacity' : false;

					$grid = $blog_layout == 'grid' ? '<div class="wpbf-grid wpbf-post-grid'. $masonry .' wpbf-grid-'. esc_attr( $grid_gap ) .' wpbf-grid-1-'. esc_attr( $mobile_breakpoint ) .' wpbf-grid-small-1-'. esc_attr( $tablet_breakpoint ) .' wpbf-grid-large-1-'. esc_attr( $desktop_breakpoint ) .'">' : false;

				}

				break;

			case 'author':

				if( is_author() ) {

					$blog_layout        = get_theme_mod( 'author_layout', 'default' );
					$mobile_breakpoint  = get_theme_mod( 'author_grid_mobile', 1 );
					$tablet_breakpoint  = get_theme_mod( 'author_grid_tablet', 2 );
					$desktop_breakpoint = get_theme_mod( 'author_grid_desktop', 3 );
					$grid_gap           = get_theme_mod( 'author_grid_gap', 'small' );
					$masonry            = get_theme_mod( 'author_grid_masonry' ) ? ' wpbf-post-grid-masonry opacity' : false;

					$grid = $blog_layout == 'grid' ? '<div class="wpbf-grid wpbf-post-grid'. $masonry .' wpbf-grid-'. esc_attr( $grid_gap ) .' wpbf-grid-1-'. esc_attr( $mobile_breakpoint ) .' wpbf-grid-small-1-'. esc_attr( $tablet_breakpoint ) .' wpbf-grid-large-1-'. esc_attr( $desktop_breakpoint ) .'">' : false;

				}

				break;

			case 'date':

				if( is_date() ) {

					$blog_layout        = get_theme_mod( 'date_layout', 'default' );
					$mobile_breakpoint  = get_theme_mod( 'date_grid_mobile', 1 );
					$tablet_breakpoint  = get_theme_mod( 'date_grid_tablet', 2 );
					$desktop_breakpoint = get_theme_mod( 'date_grid_desktop', 3 );
					$grid_gap           = get_theme_mod( 'date_grid_gap', 'small' );
					$masonry            = get_theme_mod( 'date_grid_masonry' ) ? ' wpbf-post-grid-masonry opacity' : false;

					$grid = $blog_layout == 'grid' ? '<div class="wpbf-grid wpbf-post-grid'. $masonry .' wpbf-grid-'. esc_attr( $grid_gap ) .' wpbf-grid-1-'. esc_attr( $mobile_breakpoint ) .' wpbf-grid-small-1-'. esc_attr( $tablet_breakpoint ) .' wpbf-grid-large-1-'. esc_attr( $desktop_breakpoint ) .'">' : false;

				}

				break;

			default:

				if( is_post_type_archive( $saved_archive ) ) {

					$blog_layout        = get_theme_mod( $saved_archive . '-archive_layout', 'default' );
					$mobile_breakpoint  = get_theme_mod( $saved_archive . '-archive_grid_mobile', 1 );
					$tablet_breakpoint  = get_theme_mod( $saved_archive . '-archive_grid_tablet', 2 );
					$desktop_breakpoint = get_theme_mod( $saved_archive . '-archive_grid_desktop', 3 );
					$grid_gap           = get_theme_mod( $saved_archive . '-archive_grid_gap', 'small' );
					$masonry            = get_theme_mod( $saved_archive . '-archive_grid_masonry' ) ? ' wpbf-post-grid-masonry opacity' : false;

					$grid = $blog_layout == 'grid' ? '<div class="wpbf-grid wpbf-post-grid'. $masonry .' wpbf-grid-'. esc_attr( $grid_gap ) .' wpbf-grid-1-'. esc_attr( $mobile_breakpoint ) .' wpbf-grid-small-1-'. esc_attr( $tablet_breakpoint ) .' wpbf-grid-large-1-'. esc_attr( $desktop_breakpoint ) .'">' : false;

				}

				// apply to related taxonomies
				$taxonomies = get_object_taxonomies( $saved_archive, 'names' );

				if( !empty( $taxonomies ) ) {

					foreach( $taxonomies as $taxonomy ) {

						if( is_tax( $taxonomy ) ) {

							$blog_layout        = get_theme_mod( $saved_archive . '-archive_layout', 'default' );
							$mobile_breakpoint  = get_theme_mod( $saved_archive . '-archive_grid_mobile', 1 );
							$tablet_breakpoint  = get_theme_mod( $saved_archive . '-archive_grid_tablet', 2 );
							$desktop_breakpoint = get_theme_mod( $saved_archive . '-archive_grid_desktop', 3 );
							$grid_gap           = get_theme_mod( $saved_archive . '-archive_grid_gap', 'small' );
							$masonry            = get_theme_mod( $saved_archive . '-archive_grid_masonry' ) ? ' wpbf-post-grid-masonry opacity' : false;

							$grid = $blog_layout == 'grid' ? '<div class="wpbf-grid wpbf-post-grid'. $masonry .' wpbf-grid-'. esc_attr( $grid_gap ) .' wpbf-grid-1-'. esc_attr( $mobile_breakpoint ) .' wpbf-grid-small-1-'. esc_attr( $tablet_breakpoint ) .' wpbf-grid-large-1-'. esc_attr( $desktop_breakpoint ) .'">' : false;

						}

					}

				}

				break;
		}

	}

	return $grid;

});

/**
 * Filter Grid Layout Close
 */
add_filter( 'wpbf_blog_layout_grid_close', function( $grid ) {

	$saved_archives = wpbf_get_blog_layout_settings( $get_cpts = true );

	foreach( $saved_archives as $saved_archive ) {

		switch ( $saved_archive ) {

			case 'blog':

				if( is_home() ) {

					$blog_layout = get_theme_mod( 'blog_layout', 'default' );
					$grid = $blog_layout == 'grid' ? '</div>' : false;

				}

				break;

			case 'search':

				if( is_search() ) {

					$blog_layout = get_theme_mod( 'search_layout', 'default' );
					$grid = $blog_layout == 'grid' ? '</div>' : false;

				}

				break;

			case 'category':

				if( is_category() ) {

					$blog_layout = get_theme_mod( 'category_layout', 'default' );
					$grid = $blog_layout == 'grid' ? '</div>' : false;

				}

				break;

			case 'tag':

				if( is_tag() ) {

					$blog_layout = get_theme_mod( 'tag_layout', 'default' );
					$grid = $blog_layout == 'grid' ? '</div>' : false;

				}

				break;

			case 'author':

				if( is_author() ) {

					$blog_layout = get_theme_mod( 'author_layout', 'default' );
					$grid = $blog_layout == 'grid' ? '</div>' : false;

				}

				break;

			case 'date':

				if( is_date() ) {

					$blog_layout = get_theme_mod( 'date_layout', 'default' );
					$grid = $blog_layout == 'grid' ? '</div>' : false;

				}

				break;

			default:

				if( is_post_type_archive( $saved_archive ) ) {

					$blog_layout = get_theme_mod( $saved_archive . '-archive_layout', 'default' );
					$grid = $blog_layout == 'grid' ? '</div>' : false;

				}

				// apply to related taxonomies
				$taxonomies = get_object_taxonomies( $saved_archive, 'names' );

				if( !empty( $taxonomies ) ) {

					foreach( $taxonomies as $taxonomy ) {

						if( is_tax( $taxonomy ) ) {

							$blog_layout = get_theme_mod( $saved_archive . '-archive_layout', 'default' );
							$grid = $blog_layout == 'grid' ? '</div>' : false;

						}

					}

				}

				break;
		}

	}

	return $grid;

});

/**
 * Isotope for Grid Layout
 */
function wpbf_isotope() {

	if( is_archive() || is_home() || is_search() ) {

		wp_enqueue_script( 'wpbf-isotope', WPBF_PREMIUM_URI . 'js/isotope.js', array( 'jquery' ), '3.0.6', true );

	}

}
add_action( 'wp_enqueue_scripts', 'wpbf_isotope' );