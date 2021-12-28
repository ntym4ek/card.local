
<div class="main">
  <div class="background"></div>
  <div class="row-1">
    <div class="name">
      <? print drupal_render($form['profile_main']['field_user_name']); ?>
      <? print drupal_render($form['profile_main']['field_user_surname']); ?>
      <? print drupal_render($form['profile_main']['field_company_name']); ?>
      <? print drupal_render($form['profile_main']['field_company_office']); ?>
    </div>
    <div class="images">
      <? print drupal_render($form['profile_main']['field_user_photo']); ?>
      <? print drupal_render($form['profile_main']['field_company_logo']); ?>
    </div>
    <div class="mockup">
      <? $card = card_get_card($form["#user"]->uid);
      print render($card); ?>
    </div>
  </div>
  <div class="row-2">
    <div class="contacts">
      <h3>Контакты</h3>
      <? print drupal_render($form['profile_main']['field_user_email']); ?>
      <? print drupal_render($form['profile_main']['field_user_phone']); ?>
    </div>
    <div class="social">
      <h3>Социальные сети</h3>
      <? print drupal_render($form['profile_main']['field_user_wa']); ?>
      <? print drupal_render($form['profile_main']['field_user_fb']); ?>
      <? print drupal_render($form['profile_main']['field_user_in']); ?>
      <? print drupal_render($form['profile_main']['field_user_vk']); ?>
    </div>
    <? print drupal_render_children($form); ?>
  </div>
</div>
