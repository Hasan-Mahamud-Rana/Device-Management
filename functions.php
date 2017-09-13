<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'library/menu-walkers.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );

/** Change WP's sticky post class */
require_once( 'library/sticky-posts.php' );

/** Configure responsive image sizes */
require_once( 'library/responsive-images.php' );

/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/protocol-relative-theme-assets.php' );
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
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('Previous'),
    'next_text'       => __('Next'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );
  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<nav class='custom-pagination'>";
     // echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav>";
  }

}