<?php
/**
 * @file
 * Returns the HTML for a single Drupal page.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728148
 */
?>

<div id="page">

  <header class="header" id="header" role="banner">

     <?php if ($logo): ?>
      <a href="http://www.nal.usda.gov" title="<?php print t('United States Department of Agriculture'); ?>" class="header__logo" id="logo"><img src="<?php print $logo; ?>" alt="<?php print t('United States Department of Agriculture'); ?>" class="header__logo-image" /></a>
    <?php endif; ?>

    <?php if ($site_name || $site_slogan): ?>
      <div class="header__name-and-slogan" id="name-and-slogan">

        <?php if ($site_slogan): ?>
		<div>
          <div class="header__site-slogan" id="site-slogan">
		    <a href="http://www.nal.usda.gov" title="<?php print t('United States Department of Agriculture'); ?>"><span><?php print $site_slogan; ?></span></a>
		 </div>
		</div>
        <?php endif; ?>

		<?php if ($site_name): ?>
          <div>
		  <div class="header__site-name" id="site-name">
          <a href="http://www.nal.usda.gov" title="<?php print t('National Agricultural Library'); ?>" class="header__site-link" rel="home"><span><?php print $site_name; ?></span></a>
          </div>
		  </div>
        <?php endif; ?>


      </div>
    <?php endif; ?>

    <div id="sub-nav-container">
	<nav class="header__secondary-menu" id="sub-links" role="navigation">
        <?php
		$menu = menu_navigation_links('menu-secondary-links');
		print theme('links__menu_secondary_links', array(
		'links' => $menu,
        'attributes' => array(
		  'id' => 'secondary-menu-sub-links',
		'class' => array('links', 'inline', 'clearfix'),
		  )
        )); ?>
	</nav>

    <?php if ($secondary_menu): ?>
      <nav class="header--secondary-menu" id="secondary-menu" role="navigation">
        <?php print theme('links__system_secondary_menu', array(
          'links' => $secondary_menu,
          'attributes' => array(
            'class' => array('links', 'inline', 'clearfix'),
          ),
          'heading' => array(
            'text' => $secondary_menu_heading,
            'level' => 'h2',
            'class' => array('element-invisible'),
          ),
        )); ?>
      </nav>
    <?php endif; ?>
	</div>

    <?php print render($page['header']); ?>
      <?php if (isset($page['info_center_path'])): ?>
        <div id="info-center-heading">
            <span><a href="/<?php print $page['info_center_path']; ?>"><?php print $page['info_center_header']; ?></a></span>
        </div>
      <?php endif; ?>
  </header>

  <div id="main">
    <div id="content" class="column" role="main">
      <?php print render($page['highlighted']); ?>
      <a id="main-content"></a>
     <?php  //@TODO - TEMPORARY FIX PUT IN MY NNEKA HECTOR AND SHOULD BE REMOVED AS SOON AS PANELIZER HAS BEEN ADDED FOR THESE CONTENT TYPES.  TEMPORARY HACK FOR PARTIAL DELIVERY OF PANELIZER IMPLEMENTATION.  ?>
      <?php if (isset($node) and ($node->type == 'advanced_article'  || $node->type == 'article')) { ?>
        <?php print $breadcrumb; ?>
      <?php } ?>
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1 class="page__title title" id="page-title"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php print $messages; ?>
      <?php print render($tabs); ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
    </div>

    <?php
      // Render the sidebars to see if there's anything in them.
      $sidebar_first  = render($page['sidebar_first']);
      $sidebar_second = render($page['sidebar_second']);
    ?>

    <?php if ($sidebar_first || $sidebar_second): ?>
      <aside class="sidebars">
        <?php print $sidebar_first; ?>
        <?php print $sidebar_second; ?>
      </aside>
    <?php endif; ?>

  </div>

  <?php print render($page['footer']); ?>

</div>
<?php include drupal_get_path('theme', 'nalr_hdgdc') . "/templates/google.inc" ?>
<?php print render($page['bottom']); ?>
