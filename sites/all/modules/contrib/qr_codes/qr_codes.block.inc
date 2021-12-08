<?php
/**
 * callback for block configure form
 */
function _qr_codes_block_configure_form($delta = 0) {
  $form = array();
  $form['qr_codes'] = array(
    '#type' => 'fieldset',
    '#title' => t('QR Codes Node Block'),
    '#collapsible' => FALSE,
  );
  
  $form['qr_codes']['qr_codes_block_data'] = array(
    '#type' => 'textarea',
    '#title' => t('Enter the text to embed in your barcode'),
    '#description' => t('Available token replacement patterns are listed below and will be applied on node or user pages.'),
    '#default_value' => variable_get('qr_codes_block_data', '')
  );
  
  if (module_exists('token')) {
    $form['qr_codes']['tokens'] = array(
      '#type' => 'fieldset',
      '#title' => t('Available Tokens'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    
    $form['qr_codes']['tokens']['help'] = array(
      '#type' => 'markup',
      '#markup' => theme('token_tree', array('token_types' => 'all', 'click_insert' => FALSE, 'show_restricted' => TRUE)),
    );
  }
  
  if(function_exists('image_styles')){
    $options = array('');
    $styles = image_styles();
    foreach((array)$styles as $style){
      $options[$style['name']] = $style['name'];
    }
    
    $form['qr_codes']['qr_codes_block_image_style'] = array(
      '#type' => 'select',
      '#title' => t('Select an Image style'),
      '#multiple' => FALSE,
      '#description' => t('If selected, this image style will be applied to the barcode image.'),
      '#options' => $options,
      '#default_value' => variable_get('qr_codes_block_image_style', -1),
    );
  }
  return $form;
}

/**
 * callback to handle save of block configure options
 */
function _qr_codes_block_configure_save($delta, $edit) {
  variable_set('qr_codes_block_data', $edit['qr_codes_block_data']);
  if (!empty($edit['qr_codes_block_image_style'])) {
    variable_set('qr_codes_block_image_style', $edit['qr_codes_block_image_style']);
  }
}

/**
 * callback to handle view of qr_codes block
 */
function _qr_codes_block_view($delta) {
  $block['subject'] = t('QR Codes');

  $text = variable_get('qr_codes_block_data', '');
  
  // use token replacement if available for nodes and users
  global $user;
  $data = array();

  if (arg(0) == 'node' && is_numeric(arg(1))) {
    $data['node'] = node_load(arg(1));
  }
  if ($user->uid) {
    $data['user'] = $user;
  }
  $data['path'] = 
  $text = token_replace($text, $data);

  $style = variable_get('qr_codes_block_image_style', '');
  $block['content'] = theme('qr_codes', array('data' => $text, 'width' => 150, 'height' => 150, 'margin' => 0, 'image_style' => $style));
  return $block;
}