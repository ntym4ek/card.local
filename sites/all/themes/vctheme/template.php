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
  return [
    'visit_card' => array(
      'render element' => 'element',
      'template' => 'templates/card',
    ),
    'card_user_profile_form' => array(
      'render element' => 'form',
      'template' => 'templates/card-user-profile-form',
    ),
  ];
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
  drupal_add_css('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;700&display=swap', array('type' => 'external'));
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

/**
 * Returns HTML for an image field widget.
 *
 * @param $variables
 *   An associative array containing:
 *   - element: A render element representing the image field widget.
 *
 * @ingroup themeable
 */
function vctheme_image_widget($variables)
{
  // виджет на базе https://csshint.com/file-upload-field-snippets/
  $element = $variables['element'];

  $class = '';
  if (isset($element['preview'])) {
    $preview = drupal_render($element['preview']);
    $class = ' uploaded';
  } else {
    $preview = '<img class="file-upload-image" src="" />';
  }
//while (true) { $a = 1; };
  $output = '<div class="file-upload' . $class . '">';
//  $output .=   '<button class="file-upload-btn" type="button" onclick="$(\'.file-upload-input\').trigger( \'click\' )">Add Image</button>';
  $output .=   '<div class="image-upload-wrap">';
  hide($element['filename']);
  $output .=   drupal_render_children($element);
//  $output .=     '<input class="file-upload-input" type=\'file\' accept="image/*" />';
  $output .=     '<div class="drag-text"><i class="fas fa-plus"></i></div>';
  $output .=   '</div>';
  $output .=   '<div class="file-upload-content">';
  $output .=      $preview;
//  $output .=     '<div class="image-title-wrap">';
  $output .=       '<button type="button" class="remove-btn"><i class="far fa-trash-alt"></i></button>';
//  $output .=       '<button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>';
//  $output .=     '</div>';
  $output .=   '</div>';
  $output .= '</div>';

  return $output;
}

function vctheme_preprocess_menu_link(&$vars)
{
  if ($vars["element"]["#href"] == 'user' && user_is_logged_in()) {
    // сменить Аккаунт на Имя пользователя
    $vars["element"]["#title"] = $GLOBALS['user']->name;
  }
}
