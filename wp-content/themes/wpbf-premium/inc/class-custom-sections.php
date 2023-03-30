<?php
/**
 * Custom Sections
 *
 * @package Page Builder Framework Premium Add-On
 */

namespace WPBF;

ob_start();

class Custom_Sections {
	public function __construct() {
		add_action( 'init', [ $this, 'register_cpt' ] );
		add_action( 'admin_menu', [ $this, 'menu_item' ], 100 );
		add_action( 'admin_head', [ $this, 'fix_current_item' ] );
		add_filter( 'manage_wpbf_hooks_posts_columns', [ $this, 'register_columns' ] );
		add_action( 'manage_wpbf_hooks_posts_custom_column', array( $this, 'add_columns' ), 10, 2 );

		add_action( 'add_meta_boxes', [ $this, 'meta_box' ] );

		add_filter( 'post_updated_messages', [ $this, 'cpt_messages' ] );

		add_action( 'save_post', [ $this, 'save_meta_box_data' ] );

		add_action( 'wp', [ $this, 'do_published_hooks' ] );
		add_action( 'wp', [ $this, 'frontend_show_hooks' ] );
		add_action( 'admin_bar_menu', [ $this, 'display_hooks' ], 999 );

		add_action( 'template_redirect', [ $this, 'cpt_redirect' ] );

		add_action( 'admin_enqueue_scripts', [ $this, 'hook_admin_scripts' ] );

	}

	public function hook_admin_scripts() {
		wp_enqueue_style( 'wpbf-premium-hooks', WPBF_PREMIUM_URI . 'css/wpbf-premium-hooks.css', '', WPBF_PREMIUM_VERSION );

	}

	public function is_gutenberg_active( $hook_id ) {

		$gutenberg = true;

		if ( version_compare( $GLOBALS['wp_version'], '5.0', '<' ) ) {
			$gutenberg = false;
		}

		if ( ! function_exists( 'has_blocks' ) || ! has_blocks( $hook_id ) ) {
			$gutenberg = false;
		}

		return $gutenberg;

	}

	public function do_published_hooks() {
		$args = array(
			'post_type'     => 'wpbf_hooks',
			'no_found_rows' => true,
			'post_status'   => 'publish',
			'numberposts'   => 100,
			'fields'        => 'ids',
			'order'         => 'ASC',
		);

		$hooks = get_posts( $args );

		foreach ( $hooks as $hook_id ) {

			if ( is_singular( 'wpbf_hooks' ) ) {
				return; // stopping from outputting the hooks on the actual hooks posts.
			}

			$location = get_post_meta( $hook_id, '_wpbf_hook_location', true );

			$action   = get_post_meta( $hook_id, '_wpbf_hook_action', true );
			$priority = get_post_meta( $hook_id, '_wpbf_hook_priority', true );

			if ( ! empty( $location ) ) {
				if ( $location == 'header' ) {
					$action = 'wpbf_header';
				} elseif ( $location == 'footer' ) {
					$action = 'wpbf_footer';
				} elseif ( $location == '404' ) {
					$action = 'wpbf_404';
				}
			}

			if ( ! empty( $action ) ) {

				if ( empty( $priority ) ) {
					$priority = 10;
				}

				switch ( $action ) {
					case 'wpbf_header':
						remove_action( 'wpbf_header', 'wpbf_do_header' );
						break;
					case 'wpbf_footer':
						remove_action( 'wpbf_before_footer', 'wpbf_custom_footer' );
						remove_action( 'wpbf_footer', 'wpbf_do_footer' );
						break;
					case 'wpbf_404':
						remove_action( 'wpbf_404', 'wpbf_do_404' );
						break;
				}

				if ( ! $this->is_match_display_rules( $hook_id ) ) {

					switch ( $action ) {
						case 'wpbf_header':
							add_action( 'wpbf_header', 'wpbf_do_header' );
							break;
						case 'wpbf_before_footer':
							add_action( 'wpbf_before_footer', 'wpbf_custom_footer' );
							break;
						case 'wpbf_404':
							add_action( 'wpbf_404', 'wpbf_do_404' );
							break;
					}

					continue;
				}

				add_action(
					$action,
					function () use ( $hook_id, $action ) {
						if ( class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->db->is_built_with_elementor( $hook_id ) ) { // Elementor Support.
							echo do_shortcode( sprintf( '[elementor-template id="%s"]', $hook_id ) );
						} elseif ( class_exists( '\FLBuilderModel' ) && \FLBuilderModel::is_builder_enabled( $hook_id ) ) { // Beaver Builder Support.
							echo do_shortcode( sprintf( '[fl_builder_insert_layout id="%s"]', $hook_id ) );
						} elseif ( $this->is_gutenberg_active( $hook_id ) ) {
							echo do_shortcode( do_blocks( get_post_field( 'post_content', $hook_id ) ) );
						} else {
							echo do_shortcode( get_post_field( 'post_content', $hook_id ) );
						}
					},
					absint( $priority )
				);
			}
		}
	}

	public function is_match_display_rules( $hook_id ) {
		$restrict_logged_user = get_post_meta( $hook_id, '_wpbf_restrict_logged_users', true );

		if ( ! empty( $restrict_logged_user ) && $restrict_logged_user == 'true' && ! is_user_logged_in() ) {
			return false;
		}

		$db_parent_rule = get_post_meta( $hook_id, '_wpbf_display_rule_parent', true );
		if ( empty( $db_parent_rule ) || ! is_array( $db_parent_rule ) ) {
			$db_parent_rule = [ 1 => 'entire_site' ];
		}

		$db_exclusion_parent_rule = get_post_meta( $hook_id, '_wpbf_exclusion_display_rule_parent', true );
		if ( empty( $db_exclusion_parent_rule ) || ! is_array( $db_exclusion_parent_rule ) ) {
			$db_exclusion_parent_rule = [ 1 => '' ];
		}

		$db_child_rule = get_post_meta( $hook_id, '_wpbf_display_rule_child', true );
		if ( empty( $db_child_rule ) || ! is_array( $db_child_rule ) ) {
			$db_child_rule = [];
		}

		$db_exclusion_child_rule = get_post_meta( $hook_id, '_wpbf_exclusion_display_rule_child', true );
		if ( empty( $db_exclusion_child_rule ) || ! is_array( $db_exclusion_child_rule ) ) {
			$db_exclusion_child_rule = [];
		}

		$post_id = is_singular() || is_front_page() ? get_queried_object_id() : 0;

		if ( ! $post_id ) {
			if ( 'page' == get_option( 'show_on_front' ) ) {
				$post_id = get_option( 'page_for_posts' );
			}
		}

		foreach ( $db_exclusion_parent_rule as $key => $rule ) {
			if ( $rule == 'entire_site' ) {
				return false;
			}

			if ( $rule == 'all_archive' ) {
				if ( is_archive() ) {
					return false;
				}
			}

			if ( $rule == 'author_archive' ) {
				if ( $db_exclusion_child_rule[ $key ] == 'all' ) {
					if ( is_author() ) {
						return false;
					}
				} else {

					$author_id = $db_exclusion_child_rule[ $key ];

					if ( is_author( $author_id ) ) {
						return false;
					}
				}
			}

			if ( $rule == 'date_archive' ) {
				if ( is_date() ) {
					return false;
				}
			}

			if ( $rule == 'blog_page' ) {
				if ( is_home() ) {
					return false;
				}
			}

			if ( $rule == 'search' && is_search() ) {
				return false;
			}

			if ( $rule == '404' ) {
				if ( is_404() ) {
					return false;
				}
			}

			if ( $rule == 'posts' ) {
				if ( $db_exclusion_child_rule[ $key ] == 'all' ) {
					if ( is_singular( 'post' ) ) {
						return false;
					}
				} else {

					if ( $post_id == $db_exclusion_child_rule[ $key ] ) {
						return false;
					}
				}
			}

			if ( $rule == 'post_category' ) {
				if ( $db_exclusion_child_rule[ $key ] == 'all' ) {
					if ( is_tax( 'category' ) ) {
						return false;
					}
				} else {

					$category_id = $db_exclusion_child_rule[ $key ];

					if ( is_tax( 'category', $category_id ) ) {
						return false;
					}
				}
			}

			if ( $rule == 'post_tag' ) {
				if ( $db_exclusion_child_rule[ $key ] == 'all' ) {
					if ( is_tax( 'post_tag' ) ) {
						return false;
					}
				} else {

					$tag_id = $db_exclusion_child_rule[ $key ];

					if ( is_tax( 'post_tag', $tag_id ) ) {
						return false;
					}
				}
			}

			if ( $rule == 'post_archive' ) {
				if ( is_post_type_archive( 'post' ) ) {
					return false;
				}
			}

			$post_types = $this->get_filtered_post_types();

			if ( class_exists( 'Easy_Digital_Downloads' ) ) {
				unset( $post_types['download'] );
				if ( $rule == 'download' ) {
					if ( $db_exclusion_child_rule[ $key ] == 'all' ) {
						if ( is_singular( 'download' ) ) {
							return false;
						}
					} else {

						if ( $post_id == $db_exclusion_child_rule[ $key ] ) {
							return false;
						}
					}
				}

				if ( $rule == 'download_category' ) {
					if ( $db_exclusion_child_rule[ $key ] == 'all' ) {
						if ( is_tax( 'download_category' ) ) {
							return false;
						}
					} else {
						$download_category_id = $db_exclusion_child_rule[ $key ];

						if ( is_tax( 'download_category', $download_category_id ) ) {
							return false;
						}
					}
				}

				if ( $rule == 'download_tag' ) {
					if ( $db_exclusion_child_rule[ $key ] == 'all' ) {
						if ( is_tax( 'download_tag' ) ) {
							return false;
						}
					} else {

						$download_tag_id = $db_exclusion_child_rule[ $key ];

						if ( is_tax( 'download_tag', $download_tag_id ) ) {
							return false;
						}
					}
				}
			}

			if ( class_exists( 'WooCommerce' ) ) {
				unset( $post_types['product'] );
				if ( $rule == 'product' ) {
					if ( $db_exclusion_child_rule[ $key ] == 'all' ) {
						if ( is_singular( 'product' ) ) {
							return false;
						}
					} else {

						if ( $post_id == $db_exclusion_child_rule[ $key ] ) {
							return false;
						}
					}
				}

				if ( $rule == 'product_category' ) {
					if ( $db_exclusion_child_rule[ $key ] == 'all' ) {
						if ( is_tax( 'product_cat' ) ) {
							return false;
						}
					} else {

						$product_category_id = $db_exclusion_child_rule[ $key ];

						if ( is_tax( 'product_cat', $product_category_id ) ) {
							return false;
						}
					}
				}

				if ( $rule == 'product_tag' ) {
					if ( $db_exclusion_child_rule[ $key ] == 'all' ) {
						if ( is_tax( 'product_tag' ) ) {
							return false;
						}
					} else {

						$product_tag_id = $db_exclusion_child_rule[ $key ];

						if ( is_tax( 'product_tag', $product_tag_id ) ) {
							return false;
						}
					}
				}
			}

			if ( $rule == 'pages' ) {
				if ( $db_exclusion_child_rule[ $key ] == 'all' ) {
					if ( is_page() ) {
						return false;
					}
				} else {

					if ( $post_id == $db_exclusion_child_rule[ $key ] ) {
						return false;
					}
				}
			}

			foreach ( array_keys( $post_types ) as $cpt ) {
				if ( $rule == $cpt ) {
					if ( $db_exclusion_child_rule[ $key ] == 'all' ) {
						if ( is_singular( $cpt ) ) {
							return false;
						}
					} else {

						if ( $post_id == $db_exclusion_child_rule[ $key ] ) {
							return false;
						}
					}
				}
			}
		}

		foreach ( $db_parent_rule as $key => $rule ) {
			if ( $rule == 'entire_site' ) {
				return true;
			}

			if ( $rule == 'all_archive' ) {
				if ( is_archive() ) {
					return true;
				}
			}

			if ( $rule == 'author_archive' ) {
				if ( $db_child_rule[ $key ] == 'all' ) {
					if ( is_author() ) {
						return true;
					}
				} else {

					$author_id = $db_child_rule[ $key ];

					if ( is_author( $author_id ) ) {
						return true;
					}
				}
			}

			if ( $rule == 'date_archive' ) {
				if ( is_date() ) {
					return true;
				}
			}

			if ( $rule == 'blog_page' ) {
				if ( is_home() ) {
					return true;
				}
			}

			if ( $rule == 'search' && is_search() ) {
				return true;
			}

			if ( $rule == '404' ) {
				if ( is_404() ) {
					return true;
				}
			}

			if ( $rule == 'posts' ) {
				if ( $db_child_rule[ $key ] == 'all' ) {
					if ( is_singular( 'post' ) ) {
						return true;
					}
				} else {
					if ( $post_id == $db_child_rule[ $key ] ) {
						return true;
					}
				}
			}

			if ( $rule == 'post_category' ) {
				if ( $db_child_rule[ $key ] == 'all' ) {
					if ( is_tax( 'category' ) ) {
						return true;
					}
				} else {
					$category_id = $db_child_rule[ $key ];

					if ( is_tax( 'category', $category_id ) ) {
						return true;
					}
				}
			}

			if ( $rule == 'post_tag' ) {
				if ( $db_child_rule[ $key ] == 'all' ) {
					if ( is_tax( 'post_tag' ) ) {
						return true;
					}
				} else {
					$tag_id = $db_child_rule[ $key ];

					if ( is_tax( 'post_tag', $tag_id ) ) {
						return true;
					}
				}
			}

			if ( $rule == 'post_archive' ) {
				if ( is_post_type_archive( 'post' ) ) {
					return true;
				}
			}

			$post_types = $this->get_filtered_post_types();

			if ( class_exists( 'Easy_Digital_Downloads' ) ) {
				unset( $post_types['download'] );
				if ( $rule == 'download' ) {
					if ( $db_child_rule[ $key ] == 'all' ) {
						if ( is_singular( 'download' ) ) {
							return true;
						}
					} else {
						if ( $post_id == $db_child_rule[ $key ] ) {
							return true;
						}
					}
				}

				if ( $rule == 'download_category' ) {
					if ( $db_child_rule[ $key ] == 'all' ) {
						if ( is_tax( 'download_category' ) ) {
							return true;
						}
					} else {

						$download_category_id = $db_child_rule[ $key ];

						if ( is_tax( 'download_category', $download_category_id ) ) {
							return true;
						}
					}
				}

				if ( $rule == 'download_tag' ) {
					if ( $db_child_rule[ $key ] == 'all' ) {
						if ( is_tax( 'download_tag' ) ) {
							return true;
						}
					} else {

						$download_tag_id = $db_child_rule[ $key ];

						if ( is_tax( 'download_tag', $download_tag_id ) ) {
							return true;
						}
					}
				}
			}

			if ( class_exists( 'WooCommerce' ) ) {
				unset( $post_types['product'] );
				if ( $rule == 'product' ) {
					if ( $db_child_rule[ $key ] == 'all' ) {
						if ( is_singular( 'product' ) ) {
							return true;
						}
					} else {

						if ( $post_id == $db_child_rule[ $key ] ) {
							return true;
						}
					}
				}

				if ( $rule == 'product_category' ) {
					if ( $db_child_rule[ $key ] == 'all' ) {
						if ( is_tax( 'product_cat' ) ) {
							return true;
						}
					} else {

						$product_category_id = $db_child_rule[ $key ];

						if ( is_tax( 'product_cat', $product_category_id ) ) {
							return true;
						}
					}
				}

				if ( $rule == 'product_tag' ) {
					if ( $db_child_rule[ $key ] == 'all' ) {
						if ( is_tax( 'product_tag' ) ) {
							return true;
						}
					} else {

						$product_tag_id = $db_child_rule[ $key ];

						if ( is_tax( 'product_tag', $product_tag_id ) ) {
							return true;
						}
					}
				}
			}

			if ( $rule == 'pages' ) {
				if ( $db_child_rule[ $key ] == 'all' ) {
					if ( is_page() ) {
						return true;
					}
				} else {

					if ( $post_id == $db_child_rule[ $key ] ) {
						return true;
					}
				}
			}

			foreach ( array_keys( $post_types ) as $cpt ) {
				if ( $rule == $cpt ) {
					if ( $db_child_rule[ $key ] == 'all' ) {
						if ( is_singular( $cpt ) ) {
							return true;
						}
					} else {

						if ( $post_id == $db_child_rule[ $key ] ) {
							return true;
						}
					}
				}
			}
		}

		return false;
	}

	/**
	 * Make sure our admin menu item is highlighted.
	 */
	public function fix_current_item() {
		global $parent_file, $submenu_file, $post_type;

		if ( 'wpbf_hooks' === $post_type ) {
			$parent_file  = 'themes.php';
			$submenu_file = 'edit.php?post_type=wpbf_hooks';
		}
	}

	public function register_cpt() {
		$labels = array(
			'name'          => _x( 'Custom Sections', 'Post Type General Name', 'wpbfpremium' ),
			'singular_name' => _x( 'Section', 'Post Type Singular Name', 'wpbfpremium' ),
			'menu_name'     => __( 'Custom Sections', 'wpbfpremium' ),
			'all_items'     => __( 'All Sections', 'wpbfpremium' ),
			'add_new_item'  => __( 'Add New Section', 'wpbfpremium' ),
			'new_item'      => __( 'New Section', 'wpbfpremium' ),
			'edit_item'     => __( 'Edit Section', 'wpbfpremium' ),
			'update_item'   => __( 'Update Section', 'wpbfpremium' ),
			'search_items'  => __( 'Search Section', 'wpbfpremium' ),
		);

		$args = array(
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'show_in_rest'        => true,
		);

		register_post_type( 'wpbf_hooks', $args );

	}

	/**
	 * Register custom post type columns.
	 *
	 * @param array $columns Existing CPT columns.
	 *
	 * @return array All our CPT columns.
	 */
	public function register_columns( $columns ) {
		$columns['wpbf_hook_action'] = esc_html__( 'Location', 'wpbfpremium' );

		$new_columns = array();

		foreach ( $columns as $key => $value ) {
			if ( 'date' === $key ) {
				$new_columns['wpbf_hook_action'] = esc_html__( 'Location', 'wpbfpremium' );
			}

			$new_columns[ $key ] = $value;
		}

		return $new_columns;
	}

	/**
	 * Add content to our custom post type columns.
	 *
	 * @param string $column The name of the column.
	 * @param int    $post_id The ID of the post row.
	 */
	public function add_columns( $column, $post_id ) {
		if ( $column == 'wpbf_hook_action' ) {

			$location = get_post_meta( $post_id, '_wpbf_hook_location', true );
			$action   = get_post_meta( $post_id, '_wpbf_hook_action', true );

			if ( $location !== 'hooks' ) {
				echo ucfirst( $location );
			} else {
				echo $action;
			}
		}
	}

	/**
	 * CPT updates messages.
	 *
	 * @param array $messages Existing post update messages.
	 *
	 * @return array Amended wpbf_hooks CPT notices
	 */
	public function cpt_messages( $messages ) {
		$post = get_post();

		$messages['wpbf_hooks'] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'Section updated.', 'wpbfpremium' ),
			2  => __( 'Custom field updated.' ), // do not touch
			3  => __( 'Custom field deleted.' ), // do not touch
			4  => __( 'Section updated.', 'wpbfpremium' ),
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Section restored to revision from %s', 'wpbfpremium' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'Section published.', 'wpbfpremium' ),
			7  => __( 'Section saved.', 'wpbfpremium' ),
			8  => __( 'Section submitted.', 'wpbfpremium' ),
			9  => sprintf(
				__( 'Section scheduled for: <strong>%1$s</strong>.', 'wpbfpremium' ),
				date_i18n( __( 'M j, Y @ G:i', 'wpbfpremium' ), strtotime( $post->post_date ) )
			),
			10 => __( 'Section draft updated.', 'wpbfpremium' ),
		);

		return $messages;
	}

	public function meta_box() {
		add_meta_box(
			'wpbf_hooks_location',
			__( 'Location', 'wpbfpremium' ),
			[ $this, 'meta_box_callback' ],
			'wpbf_hooks'
		);

		add_meta_box(
			'wpbf_hooks_display_rules',
			__( 'Display Rules', 'wpbfpremium' ),
			[ $this, 'display_rules_meta_box_callback' ],
			'wpbf_hooks'
		);

		add_meta_box(
			'wpbf_hooks_is_logged_in',
			__( 'Advanced', 'wpbfpremium' ),
			[ $this, 'logged_in_meta_box_callback' ],
			'wpbf_hooks'
		);

		add_meta_box( 'wpbf_hook_sidebar_settings', esc_html__( 'Hooks', 'wpbfpremium' ), [ $this, 'meta_box_sidebar_callback' ], 'wpbf_hooks', 'side', 'default' );

	}

	public function hook_list() {
		return [
			__( 'General', 'wpbfpremium' )           => [
				'wpbf_body_open',
				'wpbf_content_open',
				'wpbf_inner_content_open',
				'wpbf_main_content_open',
				'wpbf_before_page_title',
				'wpbf_after_page_title',
				'wpbf_main_content_close',
				'wpbf_inner_content_close',
				'wpbf_content_close',
				'wpbf_body_close',
			],
			__( 'Pre Header', 'wpbfpremium' )        => [
				'wpbf_before_pre_header',
				'wpbf_pre_header_open',
				'wpbf_pre_header_left_open',
				'wpbf_pre_header_left_close',
				'wpbf_pre_header_right_open',
				'wpbf_pre_header_right_close',
				'wpbf_pre_header_close',
				'wpbf_after_pre_header',
			],
			__( 'Header', 'wpbfpremium' )            => [
				'wpbf_before_header',
				'wpbf_header_open',
				'wpbf_header_close',
				'wpbf_after_header',
			],
			__( 'Navigation', 'wpbfpremium' )        => [
				'wpbf_before_main_navigation',
				'wpbf_before_main_menu',
				'wpbf_main_menu_open',
				'wpbf_main_menu_close',
				'wpbf_after_main_menu',
				'wpbf_after_main_navigation',
			],
			__( 'Mobile Navigation', 'wpbfpremium' ) => [
				'wpbf_before_mobile_toggle',
				'wpbf_after_mobile_toggle',
			],
			__( 'Sidebar', 'wpbfpremium' )           => [
				'wpbf_before_sidebar',
				'wpbf_sidebar_open',
				'wpbf_after_sidebar',
				'wpbf_sidebar_close',
			],
			__( 'Footer', 'wpbfpremium' )            => [
				'wpbf_before_footer',
				'wpbf_footer_open',
				'wpbf_footer_close',
				'wpbf_after_footer',
			],
			__( 'Posts', 'wpbfpremium' )             => [
				'wpbf_before_article',
				'wpbf_before_article_meta',
				'wpbf_article_meta_open',
				'wpbf_before_author_meta',
				'wpbf_after_author_meta',
				'wpbf_before_date_meta',
				'wpbf_after_date_meta',
				'wpbf_before_comments_meta',
				'wpbf_after_comments_meta',
				'wpbf_article_meta_close',
				'wpbf_after_article_meta',
				'wpbf_before_comments',
				'wpbf_before_comment_form',
				'wpbf_after_comment_form',
				'wpbf_after_comments',
				'wpbf_before_post_links',
				'wpbf_after_post_links',
				'wpbf_after_article',
			],
		];
	}

	public function frontend_show_hooks() {
		if ( ! isset( $_GET['wpbf_hooks'] ) ) {
			return;
		}

		$actions = array_reduce(
			$this->hook_list(),
			function ( $carry, $item ) {
				$carry = array_merge( $carry, $item );

				return $carry;
			},
			[]
		);

		foreach ( $actions as $action ) {
			add_action(
				$action,
				function () use ( $action ) {
					echo '<div style="display: inline-block; font-family: Helvetica, Arial, sans-serif; padding: 8px; margin: 5px; line-height: 1; border-radius: 4px; font-size: 13px; font-weight: 700; color: #000; background: #f9e880;">' . $action . '</div>';
				}
			);
		}
	}

	public function display_hooks( $wp_admin_bar ) {

		if ( apply_filters( 'wpbf_disable_hooks_guide', false ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_theme_options' ) || is_admin() ) {
			return;
		}

		global $wp;
		$current_url = home_url( add_query_arg( array(), $wp->request ) );

		if ( ! isset( $_GET['wpbf_hooks'] ) ) {

			$args = array(
				'id'    => 'wpbf-hooks',
				'title' => __( 'Display Theme Hooks', 'wpbfpremium' ),
				'href'  => trailingslashit( $current_url ) . '?wpbf_hooks',
				'meta'  => array(
					'target' => '_self',
					'class'  => 'wpbf-hooks-inactive',
					'title'  => __( 'Display Theme Hooks', 'wpbfpremium' ),
				),
			);

		} else {

			$args = array(
				'id'    => 'wpbf-hooks',
				'title' => __( 'Hide Theme Hooks', 'wpbfpremium' ),
				'href'  => trailingslashit( $current_url ),
				'meta'  => array(
					'target' => '_self',
					'class'  => 'wpbf-hooks-active',
					'title'  => __( 'Hide Theme Hooks', 'wpbfpremium' ),
				),
			);

		}

		$wp_admin_bar->add_node( $args );

	}

	public function meta_box_callback( $post ) {
		wp_nonce_field( 'wpbf_hook_nonce', 'wpbf_hook_nonce' );

		$location = get_post_meta( $post->ID, '_wpbf_hook_location', true );
		$action   = get_post_meta( $post->ID, '_wpbf_hook_action', true );
		$priority = get_post_meta( $post->ID, '_wpbf_hook_priority', true );
		?>
		<table class="form-table wpbf-table">
			<tbody>
			<tr>
				<th class="wpbf-th">
					<label><?php esc_attr_e( 'Location', 'wpbfpremium' ); ?></label>
				</th>
				<td class="wpbf-td">
					<select id="wpbf_hook_location" name="wpbf_hook_location">
						<option value="header" <?php selected( 'header', $location ); ?>>Header</option>
						<option value="footer" <?php selected( 'footer', $location ); ?>>Footer</option>
						<option value="404" <?php selected( '404', $location ); ?>>404 Page</option>
						<option value="hooks" <?php selected( 'hooks', $location ); ?>>Hooks</option>
					</select>
				</td>
			</tr>
			<tr id="hooks-tr">
				<th class="wpbf-th">
					<label><?php esc_attr_e( 'Hooks', 'wpbfpremium' ); ?></label>
				</th>
				<td class="wpbf-td">
					<select name="wpbf_hook_action">
						<?php foreach ( $this->hook_list() as $optgroup => $hooks ) : ?>
							<optgroup label="<?php echo $optgroup; ?>">
								<?php foreach ( $hooks as $hook ) : ?>
									<option value="<?php echo $hook; ?>" <?php selected( $hook, $action ); ?>><?php echo $hook; ?></option>
								<?php endforeach; ?>
							</optgroup>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr id="hooks-priority-tr">
				<th class="wpbf-th">
					<label><?php esc_attr_e( 'Priority', 'wpbfpremium' ); ?></label>
				</th>
				<td class="wpbf-td">
					<input type="text" placeholder="10" name="wpbf_hook_priority" value="<?php echo $priority; ?>">
				</td>
			</tr>
			</tbody>
		</table>

		<script>

			jQuery(document).on('ready', function () {

				var contextual_display = function () {
					jQuery('#hooks-tr, #hooks-priority-tr').hide();
					if (this.value === 'hooks') {
						jQuery('#hooks-tr, #hooks-priority-tr').show();
					}
				};

				jQuery('#wpbf_hook_location').change(contextual_display).change();
			})
		</script>

		<?php
	}

	public function get_posts( $post_type = 'post' ) {
		$posts = get_posts(
			[
				'posts_per_page' => 1000,
				'post_type'      => $post_type,
			]
		);

		$all_label = sprintf( __( 'All %s', 'wpbfpremium' ), $this->get_post_types()[ $post_type ] );

		$posts = array_reduce(
			$posts,
			function ( $carry, $item ) {
				$carry[ $item->ID ] = $item->post_title;

				return $carry;
			},
			[ 'all' => $all_label ]
		);

		return $posts;
	}

	public function get_post_types() {
		$post_types = get_post_types( array( 'public' => true ), 'objects' );

		return array_reduce(
			$post_types,
			function ( $carry, \WP_Post_Type $item ) {
				$carry[ $item->name ] = $item->label;

				return $carry;
			}
		);
	}

	public function get_filtered_post_types() {
		 $post_types = $this->get_post_types();

		unset( $post_types['post'] );
		unset( $post_types['page'] );
		unset( $post_types['attachment'] );
		unset( $post_types['wpbf_hooks'] );
		unset( $post_types['fl-builder-template'] );
		unset( $post_types['elementor_library'] );
		unset( $post_types['mailpoet_page'] );

		return $post_types;
	}

	public function display_rules_js_templates() {
		$post_types = $this->get_filtered_post_types();

		$post_categories = get_categories(
			array(
				'hide_empty' => false,
			)
		);

		$post_tags = get_tags(
			array(
				'hide_empty' => false,
			)
		);

		$rules = [
			''        => __( 'Select...', 'wpbfpremium' ),
			'General' => [
				'entire_site'    => __( 'Entire Site', 'wpbfpremium' ),
				'blog_page'      => __( 'Blog Page', 'wpbfpremium' ),
				'all_archive'    => __( 'All Archive', 'wpbfpremium' ),
				'author_archive' => __( 'Author Archive', 'wpbfpremium' ),
				'date_archive'   => __( 'Date Archive', 'wpbfpremium' ),
				'search'         => __( 'Search Results', 'wpbfpremium' ),
				'404'            => __( '404 Page', 'wpbfpremium' ),
			],
			'Page'    => [
				'pages' => __( 'Pages', 'wpbfpremium' ),
			],
			'Post'    => [
				'posts'         => __( 'Posts', 'wpbfpremium' ),
				'post_category' => __( 'Post Category', 'wpbfpremium' ),
				'post_tag'      => __( 'Post Tag', 'wpbfpremium' ),
				'post_archive'  => __( 'Post Archive', 'wpbfpremium' ),
			],
		];

		$old_post_types = $post_types;

		if ( class_exists( 'Easy_Digital_Downloads' ) ) {
			unset( $post_types['download'] );
			$rules['Download']['download']          = __( 'Downloads', 'wpbfpremium' );
			$rules['Download']['download_category'] = __( 'Downloads Category', 'wpbfpremium' );
			$rules['Download']['download_tag']      = __( 'Downloads Tag', 'wpbfpremium' );
		}

		if ( class_exists( 'WooCommerce' ) ) {
			unset( $post_types['product'] );
			$rules['Product']['product']          = __( 'Products', 'wpbfpremium' );
			$rules['Product']['product_category'] = __( 'Product Category', 'wpbfpremium' );
			$rules['Product']['product_tag']      = __( 'Product Tag', 'wpbfpremium' );
		}

		foreach ( $post_types as $key => $value ) {
			$rules[ $value ][ $key ] = $value;
		}

		// restore old post types value.
		$post_types = $old_post_types;

		$posts = $this->get_posts();

		$pages = $this->get_posts( 'page' );

		$authors = get_users( [ 'fields' => [ 'ID', 'user_login' ] ] );

		?>
		<script type="text/html" id="tmpl-display-rule-wrapper">
			<div class="rule-wrapper {{data.kind}}" data-index="{{data.index}}">
				<div class="parent-rule-select">
					{{{ data.parent_rule_tmp }}}
				</div>
				<div class="child-rule-select">
					{{{ data.child_rule_tmp }}}
				</div>
				<div class="rule-remove">
					<i class="remove-rule dashicons dashicons-no-alt"></i>
				</div>
			</div>
		</script>

		<script type="text/html" id="tmpl-display-rule-parent">
			<# data.kind = typeof data.kind !=='undefined' && data.kind === 'exclusion' ? 'wpbf_exclusion_display_rule_parent' : 'wpbf_display_rule_parent'; #>
			<select class="{{data.kind}}" name="{{data.kind}}[{{data.index}}]">
				<?php foreach ( $rules as $key => $value ) { ?>
					<?php if ( is_array( $value ) ) { ?>
						<optgroup label="<?php echo $key; ?>">
							<?php foreach ( $value as $key2 => $value2 ) : ?>
								<option value="<?php echo $key2; ?>" <# if ( typeof data !== 'undefined' && data.saved_value == '<?php echo $key2; ?>') { #> selected <#}#>><?php echo $value2; ?></option>
							<?php endforeach; ?>
						</optgroup>
					<?php } else { ?>
						<option value="<?php echo $key; ?>" <# if ( typeof data !== 'undefined' && data.saved_value == '<?php echo $key; ?>') { #> selected <#}#>><?php echo $value; ?></option>

						<?php
					}
				}
				?>
			</select>
		</script>

		<script type="text/html" id="tmpl-display-rule-posts">
			<# data.kind = typeof data.kind !=='undefined' && data.kind === 'exclusion' ? 'wpbf_exclusion_display_rule_child' : 'wpbf_display_rule_child'; #>
			<select name="{{data.kind}}[{{data.index}}]">
				<?php foreach ( $posts as $key => $value ) : ?>
					<option value="<?php echo $key; ?>" <# if ( typeof data !== 'undefined' && data.saved_value == '<?php echo $key; ?>') { #> selected <#}#>><?php echo $value; ?></option>
				<?php endforeach; ?>
			</select>
		</script>

		<script type="text/html" id="tmpl-display-rule-post_category">
			<# data.kind = typeof data.kind !=='undefined' && data.kind === 'exclusion' ? 'wpbf_exclusion_display_rule_child' : 'wpbf_display_rule_child'; #>
			<select name="{{data.kind}}[{{data.index}}]">
				<option value="all"
				<# if ( typeof data !== 'undefined' && data.saved_value == 'all') { #> selected <#}#>><?php _e( 'All Post Categories', 'wpbfpremium' ); ?></option>
				<?php foreach ( $post_categories as $post_category ) : ?>
					<option value="<?php echo $post_category->term_id; ?>" <# if ( typeof data !== 'undefined' && data.saved_value == '<?php echo $post_category->term_id; ?>') { #> selected <#}#>><?php echo $post_category->name; ?></option>
				<?php endforeach; ?>
			</select>
		</script>

		<script type="text/html" id="tmpl-display-rule-post_tag">
			<# data.kind = typeof data.kind !=='undefined' && data.kind === 'exclusion' ? 'wpbf_exclusion_display_rule_child' : 'wpbf_display_rule_child'; #>
			<select name="{{data.kind}}[{{data.index}}]">
				<option value="all"
				<# if ( typeof data !== 'undefined' && data.saved_value == 'all') { #> selected <#}#>><?php _e( 'All Post Tags', 'wpbfpremium' ); ?></option>
				<?php foreach ( $post_tags as $post_tag ) : ?>
					<option value="<?php echo $post_tag->term_id; ?>" <# if ( typeof data !== 'undefined' && data.saved_value == '<?php echo $post_tag->term_id; ?>') { #> selected <#}#>><?php echo $post_tag->name; ?></option>
				<?php endforeach; ?>
			</select>
		</script>

		<script type="text/html" id="tmpl-display-rule-pages">
			<# data.kind = typeof data.kind !=='undefined' && data.kind === 'exclusion' ? 'wpbf_exclusion_display_rule_child' : 'wpbf_display_rule_child'; #>
			<select name="{{data.kind}}[{{data.index}}]">
				<?php foreach ( $pages as $key => $value ) : ?>
					<option value="<?php echo $key; ?>" <# if ( typeof data !== 'undefined' && data.saved_value == '<?php echo $key; ?>') { #> selected <#}#>><?php echo $value; ?></option>
				<?php endforeach; ?>
			</select>
		</script>
		<?php

		foreach ( array_keys( $post_types ) as $post_type ) {
			?>
			<script type="text/html" id="tmpl-display-rule-<?php echo $post_type; ?>">
				<# data.kind = typeof data.kind !=='undefined' && data.kind === 'exclusion' ? 'wpbf_exclusion_display_rule_child' : 'wpbf_display_rule_child'; #>
				<select name="{{data.kind}}[{{data.index}}]">
					<?php foreach ( $this->get_posts( $post_type ) as $key => $value ) : ?>
						<option value="<?php echo $key; ?>" <# if ( typeof data !== 'undefined' && data.saved_value == '<?php echo $key; ?>') { #> selected <#}#>><?php echo $value; ?></option>
					<?php endforeach; ?>
				</select>
			</script>
			<?php
		}
		?>

		<script type="text/html" id="tmpl-display-rule-author_archive">
			<# data.kind = typeof data.kind !=='undefined' && data.kind === 'exclusion' ? 'wpbf_exclusion_display_rule_child' : 'wpbf_display_rule_child'; #>
			<select name="{{data.kind}}[{{data.index}}]">
				<option value="all"
				<# if ( typeof data !== 'undefined' && data.saved_value == 'all') { #> selected <#}#>><?php _e( 'All Authors', 'wpbfpremium' ); ?></option>
				<?php foreach ( $authors as $author ) : ?>
					<option value="<?php echo $author->ID; ?>" <# if ( typeof data !== 'undefined' && data.saved_value == '<?php echo $author->ID; ?>') { #> selected <#}#>><?php echo $author->user_login; ?></option>
				<?php endforeach; ?>
			</select>
		</script>
		<?php

		if ( class_exists( 'Easy_Digital_Downloads' ) ) {
			$edd_categories = get_terms(
				array(
					'taxonomy'   => 'download_category',
					'hide_empty' => false,
				)
			);

			$edd_tags = get_terms(
				array(
					'taxonomy'   => 'download_tag',
					'hide_empty' => false,
				)
			);

			?>
			<script type="text/html" id="tmpl-display-rule-download_category">
				<# data.kind = typeof data.kind !=='undefined' && data.kind === 'exclusion' ? 'wpbf_exclusion_display_rule_child' : 'wpbf_display_rule_child'; #>
				<select name="{{data.kind}}[{{data.index}}]">
					<option value="all"
					<# if ( typeof data !== 'undefined' && data.saved_value == 'all') { #> selected <#}#>><?php _e( 'All Downloads Categories', 'wpbfpremium' ); ?></option>
					<?php foreach ( $edd_categories as $edd_category ) : ?>
						<option value="<?php echo $edd_category->term_id; ?>" <# if ( typeof data !== 'undefined' && data.saved_value == '<?php echo $edd_category->term_id; ?>') { #> selected <#}#>><?php echo $edd_category->name; ?></option>
					<?php endforeach; ?>
				</select>
			</script>
			<script type="text/html" id="tmpl-display-rule-download_tag">
				<# data.kind = typeof data.kind !=='undefined' && data.kind === 'exclusion' ? 'wpbf_exclusion_display_rule_child' : 'wpbf_display_rule_child'; #>
				<select name="{{data.kind}}[{{data.index}}]">
					<option value="all"
					<# if ( typeof data !== 'undefined' && data.saved_value == 'all') { #> selected <#}#>><?php _e( 'All Downloads Tags', 'wpbfpremium' ); ?></option>
					<?php foreach ( $edd_tags as $edd_tag ) : ?>
						<option value="<?php echo $edd_tag->term_id; ?>" <# if ( typeof data !== 'undefined' && data.saved_value == '<?php echo $edd_tag->term_id; ?>') { #> selected <#}#>><?php echo $edd_tag->name; ?></option>
					<?php endforeach; ?>
				</select>
			</script>
			<?php
		}

		if ( class_exists( 'WooCommerce' ) ) {
			$woo_categories = get_terms(
				array(
					'taxonomy'   => 'product_cat',
					'hide_empty' => false,
				)
			);

			$woo_tags = get_terms(
				array(
					'taxonomy'   => 'product_tag',
					'hide_empty' => false,
				)
			);

			?>
			<script type="text/html" id="tmpl-display-rule-product_category">
				<# data.kind = typeof data.kind !=='undefined' && data.kind === 'exclusion' ? 'wpbf_exclusion_display_rule_child' : 'wpbf_display_rule_child'; #>
				<select name="{{data.kind}}[{{data.index}}]">
					<option value="all"
					<# if ( typeof data !== 'undefined' && data.saved_value == 'all') { #> selected <#}#>><?php _e( 'All Product Categories', 'wpbfpremium' ); ?></option>
					<?php foreach ( $woo_categories as $woo_category ) : ?>
						<option value="<?php echo $woo_category->term_id; ?>" <# if ( typeof data !== 'undefined' && data.saved_value == '<?php echo $woo_category->term_id; ?>') { #> selected <#}#>><?php echo $woo_category->name; ?></option>
					<?php endforeach; ?>
				</select>
			</script>
			<script type="text/html" id="tmpl-display-rule-product_tag">
				<# data.kind = typeof data.kind !=='undefined' && data.kind === 'exclusion' ? 'wpbf_exclusion_display_rule_child' : 'wpbf_display_rule_child'; #>
				<select name="{{data.kind}}[{{data.index}}]">
					<option value="all"
					<# if ( typeof data !== 'undefined' && data.saved_value == 'all') { #> selected <#}#>><?php _e( 'All Post Tags', 'wpbfpremium' ); ?></option>
					<?php foreach ( $woo_tags as $woo_tag ) : ?>
						<option value="<?php echo $woo_tag->term_id; ?>" <# if ( typeof data !== 'undefined' && data.saved_value == '<?php echo $woo_tag->term_id; ?>') { #> selected <#}#>><?php echo $woo_tag->name; ?></option>
					<?php endforeach; ?>
				</select>
			</script>
			<?php
		}
	}

	public function display_rules_script( $post_id ) {
		$db_parent_rule = get_post_meta( $post_id, '_wpbf_display_rule_parent', true );
		if ( empty( $db_parent_rule ) || ! is_array( $db_parent_rule ) ) {
			$db_parent_rule = [ 1 => 'entire_site' ];
		}

		$db_exclusion_parent_rule = get_post_meta( $post_id, '_wpbf_exclusion_display_rule_parent', true );
		if ( empty( $db_exclusion_parent_rule ) || ! is_array( $db_exclusion_parent_rule ) ) {
			$db_exclusion_parent_rule = [ 1 => '' ];
		}

		$db_child_rule = get_post_meta( $post_id, '_wpbf_display_rule_child', true );
		if ( empty( $db_child_rule ) || ! is_array( $db_child_rule ) ) {
			$db_child_rule = [];
		}

		$db_exclusion_child_rule = get_post_meta( $post_id, '_wpbf_exclusion_display_rule_child', true );
		if ( empty( $db_exclusion_child_rule ) || ! is_array( $db_exclusion_child_rule ) ) {
			$db_exclusion_child_rule = [];
		}
		?>
		<script type="text/javascript">
			(function ($) {
				var db_parent_rule = JSON.parse('<?php echo json_encode( $db_parent_rule ); ?>');
				var db_child_rule = JSON.parse('<?php echo json_encode( $db_child_rule ); ?>');

				var db_exclusion_parent_rule = JSON.parse('<?php echo json_encode( $db_exclusion_parent_rule ); ?>');
				var db_exclusion_child_rule = JSON.parse('<?php echo json_encode( $db_exclusion_child_rule ); ?>');

				var create_rule_field = function (index, kind, parent_rule_saved_value, child_rule_value_saved_value) {
					parent_rule_saved_value = parent_rule_saved_value || '';
					kind = kind || 'inclusion';
					child_rule_value_saved_value = child_rule_value_saved_value || '';

					var child_rule_tmp = '',
						get_child_rule_tmp,
						parent_rule_tmp = wp.template('display-rule-parent'),
						rule_wrapper = wp.template('display-rule-wrapper');

					if (parent_rule_saved_value !== '' && _.contains(['entire_site', 'search', 'all_archive', 'date_archive', 'blog_page', '404', 'post_archive'], parent_rule_saved_value) === false) {
						get_child_rule_tmp = wp.template('display-rule-' + parent_rule_saved_value);

						child_rule_tmp = get_child_rule_tmp({
							saved_value: child_rule_value_saved_value,
							kind: kind,
							index: index
						});
					}

					$('.container-' + kind).append(rule_wrapper({
						parent_rule_tmp: parent_rule_tmp({
							saved_value: parent_rule_saved_value,
							index: index,
							kind: kind
						}),
						child_rule_tmp: child_rule_tmp,
						index: index,
						kind: kind
					}));
				};

				var repeater = function () {
					$('.add-include-rule').click(function (e) {
						e.preventDefault();
						var last_index = $('.rule-wrapper.inclusion').eq(-1).data('index');
						if (typeof last_index === 'undefined') {
							last_index = 0;
						}
						create_rule_field(last_index + 1);
					});

					$('.add-exclude-rule').click(function (e) {
						e.preventDefault();
						var last_index = $('.rule-wrapper.exclusion').eq(-1).data('index');
						if (typeof last_index === 'undefined') {
							last_index = 0;
						}
						create_rule_field(last_index + 1, 'exclusion');
					});
				};

				var remove_rule_listener = function () {
					$(document).on('click', '.remove-rule', function (e) {
						e.preventDefault();
						$(this).parents('.rule-wrapper').remove();
					});
				};

				var parent_rule_change_listener = function () {
					$(document).on('change', '.wpbf_display_rule_parent, .wpbf_exclusion_display_rule_parent', function (e) {
						var template,
							rule_wrapper_obj,
							index,
							kind = 'inclusion',
							select_display_rule = this.value;

						rule_wrapper_obj = $(this).parents('.rule-wrapper');
						index = rule_wrapper_obj.data('index');

						if (e.currentTarget.className == 'wpbf_exclusion_display_rule_parent') {
							kind = 'exclusion';
						}

						template = '';
						if (_.contains(['entire_site', 'search', 'all_archive', 'date_archive', 'blog_page', '404', 'post_archive'], select_display_rule) === false) {
							template = wp.template('display-rule-' + select_display_rule)({index: index, kind: kind});
						}

						rule_wrapper_obj.find('.child-rule-select').html(template);
					})
				};

				var on_load = function () {
					// inclusion
					$.each(db_parent_rule, function (index, parent_rule_saved_value) {
						create_rule_field(index, 'inclusion', parent_rule_saved_value, db_child_rule[index]);
					});

					// exclusion
					$.each(db_exclusion_parent_rule, function (index, parent_rule_saved_value) {
						create_rule_field(index, 'exclusion', parent_rule_saved_value, db_exclusion_child_rule[index]);
					});
				};

				$(function () {
					on_load();
					parent_rule_change_listener();
					repeater();
					remove_rule_listener();
				});
			})(jQuery)
		</script>
		<?php
	}

	public function display_rules_meta_box_callback( $post ) {
		wp_nonce_field( 'wpbf_hook_nonce', 'wpbf_hook_nonce' );
		?>
		<table class="form-table wpbf-table">
			<tbody>
			<tr>
				<th class="wpbf-th">
					<label><?php esc_attr_e( 'Include', 'wpbfpremium' ); ?></label>
				</th>
				<td class="wpbf-td">
					<div class="container-inclusion">
					</div>
					<button class="button add-include-rule"><?php _e( 'Add Inclusion Rule', 'wpbfpremium' ); ?></button>
				</td>
			</tr>
			<tr>
				<th class="wpbf-th">
					<label><?php esc_attr_e( 'Exclude', 'wpbfpremium' ); ?></label>
				</th>
				<td class="wpbf-td">
					<div class="container-exclusion">
					</div>
					<button class="button add-exclude-rule"><?php _e( 'Add Exclusion Rule', 'wpbfpremium' ); ?></button>
				</td>
			</tr>
			</tbody>
		</table>
		<?php
		$this->display_rules_script( $post->ID );
		$this->display_rules_js_templates();
	}

	public function logged_in_meta_box_callback( $post ) {
		wp_nonce_field( 'wpbf_hook_nonce', 'wpbf_hook_nonce' );
		$db_value = get_post_meta( $post->ID, '_wpbf_restrict_logged_users', true );
		?>
		<table class="form-table wpbf-table">
			<tbody>
			<tr>
				<th class="wpbf-th">
					<label for="wpbf_restrict_logged_users"><?php esc_attr_e( 'Restrict to Logged-In Users', 'wpbfpremium' ); ?></label>
				</th>
				<td class="wpbf-td">
					<input type="hidden" name="wpbf_restrict_logged_users" value="false">
					<input id="wpbf_restrict_logged_users" style="width: auto" type="checkbox" name="wpbf_restrict_logged_users" value="true" <?php checked( $db_value, 'true' ); ?>>
				</td>
			</tr>
			</tbody>
		</table>
		<?php
	}


	public function meta_box_sidebar_callback() {
		?>
		<a style="margin-top: 1em" target="_blank" href="<?php echo home_url( '?wpbf_hooks' ); ?>" class="button button-large">
			<?php _e( 'Display Hooks', 'wpbfpremium' ); ?>
		</a>
		<?php
	}

	public function save_meta_box_data( $post_id ) {
		if ( ! isset( $_POST['wpbf_hook_nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['wpbf_hook_nonce'], 'wpbf_hook_nonce' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$this->save_hooks_metadata( $post_id );
		$this->save_hooks_display_rules_metadata( $post_id );

		$restrict_logged_users = sanitize_text_field( $_POST['wpbf_restrict_logged_users'] );

		update_post_meta( $post_id, '_wpbf_restrict_logged_users', $restrict_logged_users );
	}

	public function save_hooks_metadata( $post_id ) {
		update_post_meta( $post_id, '_wpbf_hook_location', sanitize_text_field( $_POST['wpbf_hook_location'] ) );

		if ( ! isset( $_POST['wpbf_hook_action'] ) ) {
			return;
		}

		$action   = sanitize_text_field( $_POST['wpbf_hook_action'] );
		$priority = sanitize_text_field( $_POST['wpbf_hook_priority'] );

		update_post_meta( $post_id, '_wpbf_hook_action', $action );
		update_post_meta( $post_id, '_wpbf_hook_priority', $priority );
	}

	public function save_hooks_display_rules_metadata( $post_id ) {
		$display_rule_parent = array_map( 'sanitize_text_field', $_POST['wpbf_display_rule_parent'] );
		$display_rule_child  = array_map( 'sanitize_text_field', $_POST['wpbf_display_rule_child'] );

		$exclusion_display_rule_parent = array_map( 'sanitize_text_field', $_POST['wpbf_exclusion_display_rule_parent'] );
		$exclusion_display_rule_child  = array_map( 'sanitize_text_field', $_POST['wpbf_exclusion_display_rule_child'] );

		update_post_meta( $post_id, '_wpbf_display_rule_parent', $display_rule_parent );
		update_post_meta( $post_id, '_wpbf_display_rule_child', $display_rule_child );

		update_post_meta( $post_id, '_wpbf_exclusion_display_rule_parent', $exclusion_display_rule_parent );
		update_post_meta( $post_id, '_wpbf_exclusion_display_rule_child', $exclusion_display_rule_child );
	}

	/**
	 * Create our admin menu item.
	 *
	 * @since 1.7
	 */
	public function menu_item() {
		add_submenu_page(
			'themes.php',
			esc_html__( 'Custom Sections', 'wpbfpremium' ),
			esc_html__( 'Custom Sections', 'wpbfpremium' ),
			'manage_options',
			'edit.php?post_type=wpbf_hooks'
		);
	}

	public static function get_instance() {
		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self();
		}

		return $instance;
	}

	public function cpt_redirect() {
		if ( is_singular( 'wpbf_hooks' ) && ! current_user_can( 'edit_posts' ) ) {
			wp_redirect( site_url(), 301 );
			die;
		}
	}

}

Custom_Sections::get_instance();
