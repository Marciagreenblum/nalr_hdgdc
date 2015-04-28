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
