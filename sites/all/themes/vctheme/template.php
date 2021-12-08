<?php
/**
 * @file
 * The primary PHP file for this theme.
 */

/**
 * Implements hook_theme().
 */
function vctheme_theme()
{
  return array(
    'visit_card' => array(
      'render element' => 'element',
      'template' => 'templates/visit-card',
    ),
  );
}

/**
 * Pre-processes variables for the "region" theme hook.
 */
function vctheme_preprocess_region(array &$vars)
{
  $region = $vars['region'];

  // Content region.
  if ($region === 'content') {
    // @todo is this actually used properly?
    $vars['theme_hook_suggestions'][] = 'region__no_wrapper';
  }
}

/**
 * Returns HTML for a region.
 */
function vctheme_region__no_wrapper(&$vars)
{
  $elements = $vars['elements'];

  return $elements['#children'];
}

/**
 * Implements hook_preprocess_page().
 */
function vctheme_preprocess_page(&$vars)
{
  // сменить шаблон страницы на пустой
  if (arg(0) == 'card') {
    $vars['theme_hook_suggestions'][] = 'page__empty';
  }

  if (isset($vars['main_menu'])) {
    $vars['primary_nav'] = theme('links__system_main_menu', array(
      'links' => $vars['main_menu'],
      'attributes' => array(
        'class' => array('links', 'inline', 'main-menu'),
      ),
      'heading' => array()
    ));
  }
  else {
    $vars['primary_nav'] = FALSE;
  }

  if (isset($vars['secondary_menu'])) {
    $vars['secondary_nav'] = theme('links__system_secondary_menu', array(
      'links' => $vars['secondary_menu'],
      'attributes' => array(
        'class' => array('links', 'inline', 'secondary-menu'),
      ),
      'heading' => array()
    ));
  }
  else {
    $vars['secondary_nav'] = FALSE;
  }

  /** --------------------------  подключить FontAwesome 5 - */
  drupal_add_css('https://use.fontawesome.com/releases/v5.11.0/css/all.css', array('type' => 'external'));

  /** --------------------------  подключить Ubuntu - */
  drupal_add_css('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap', array('type' => 'external'));
}


/**
 * Pre-processes variables for the "block" theme hook.
 */
function vctheme_preprocess_block(array &$vars)
{
  // Use a bare template for the page's main content.
  if ($vars['block_html_id'] == 'block-system-main') {
    $vars['theme_hook_suggestions'][] = 'block__no_wrapper';
  }
  $vars['title_attributes_array']['class'][] = 'block-title';
}

/**
 * Returns HTML for a block.
 */
function vctheme_block__no_wrapper(&$vars)
{
  $elements = $vars['elements'];

  return $elements['#children'];
}
