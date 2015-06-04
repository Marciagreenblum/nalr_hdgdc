<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */

function nalr_hdgdc_preprocess_page(&$variables, $hook) {
  if (true) {
    drupal_add_js(drupal_get_path('theme', 'nalr') . '/js/tabbedsearch.js');
	//drupal_add_js(drupal_get_path('theme', 'nalr') . '/js/dynamicHeight.js');
	drupal_add_js(drupal_get_path('theme', 'nalr') . '/js/views_slideshow2.js');
	drupal_add_js(drupal_get_path('theme', 'nalr') . '/js/listdropdown2.js');
	drupal_add_js(drupal_get_path('theme', 'nalr') . '/js/collapsable.js');

    $variables['scripts'] = drupal_get_js(); // necessary in D7?
  }


  // Hide the node title on the front page
  $variables['title_hidden'] = FALSE;

  $nid = arg(1);
  if (arg(0) == 'node' && is_numeric($nid)) {
    if (isset($variables['page']['content']['system_main']['content']['nodes'][$nid])) {
      $variables['node_content'] = & $variables['page']['content']['system_main']['content']['nodes'][$nid];
    }
  }

   //find the node id of the page i.e. nid = 2
   if($nid == 30) {  //For node id# for the ask a question page
    $variables['theme_hook_suggestions'][] =  'page__wide';   //dashes in name of template file become underscores
   }

  // Get the entire main menu tree
  $main_menu_tree = menu_tree_all_data('main-menu');
  //If there is a need to customize the links array before render, try
  //menu_tree_page_data('main-menu');

  // Add the rendered output to the $main_menu_expanded variable
  $variables['main_menu_expanded'] = menu_tree_output($main_menu_tree);

  //dpm($variables['page']);

}

function nalr_hdgdc_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  $output = '';

  // Determine if we are to display the breadcrumb.
  $show_breadcrumb = theme_get_setting('zen_breadcrumb');
  if ($show_breadcrumb == 'yes' || $show_breadcrumb == 'admin' && arg(0) == 'admin') {

    // Optionally get rid of the homepage link.
    $show_breadcrumb_home = theme_get_setting('zen_breadcrumb_home');
    if (!$show_breadcrumb_home) {
      array_shift($breadcrumb);
    }

    // Return the breadcrumb with separators.
    if (!empty($breadcrumb)) {
      $breadcrumb_separator = filter_xss_admin(theme_get_setting('zen_breadcrumb_separator'));
      $trailing_separator = $title = '';
      if (theme_get_setting('zen_breadcrumb_title')) {
        $item = menu_get_item();
        if (!empty($item['tab_parent'])) {
          // If we are on a non-default tab, use the tab's title.
          $breadcrumb[] = check_plain($item['title']);
        }
        else {
          // Don't add the page title to the breadcrumb trail if the Facet API
          // has already added it.
          $page_title_exists = FALSE;
          $page_title = drupal_get_title();
          foreach ($breadcrumb as $key => $title) {
            if (strip_tags($title) == $page_title) {
              $page_title_exists = TRUE;
            }
          }
          if (!$page_title_exists) {
            $breadcrumb[] = $page_title;
          }
        }
      }
      elseif (theme_get_setting('zen_breadcrumb_trailing')) {
        $trailing_separator = $breadcrumb_separator;
      }

      // Provide a navigational heading to give context for breadcrumb links to
      // screen-reader users.
      if (empty($variables['title'])) {
        $variables['title'] = t('You are here');
      }
      // Unless overridden by a preprocess function, make the heading invisible.
      if (!isset($variables['title_attributes_array']['class'])) {
        $variables['title_attributes_array']['class'][] = 'element-invisible';
      }

      // Build the breadcrumb trail.
      $output = '<nav class="breadcrumb" role="navigation">';
      $output .= '<span' . drupal_attributes($variables['title_attributes_array']) . '>' . $variables['title'] . '</span>';
      $output .= '<ol><li>' . implode($breadcrumb_separator . '</li><li>', $breadcrumb) . $trailing_separator . '</li></ol>';
      $output .= '</nav>';
    }
  }

  return $output;
}
