
<div class="card-wrapper">
  <div class="p-card">

    <div class="p-card-top">

      <div class="p-card-im">
        <div class="p-card-photo">
          <img src="<?php print $element['photo_url']; ?>" />
        </div>
        <div class="p-card-logo">
          <? if ($element['logo_url']): ?>
            <img src="<?php print $element['logo_url']; ?>" />
          <? endif; ?>
        </div>
      </div>
      <div class="p-card-name"><? print $element['name']; ?></div>
      <div class="p-card-office"><? print $element['office']; ?></div>

    </div>

    <div class="p-card-content">
      <? if ($element['share']): ?>
      <div class="p-card-qr">
        <div class="p-card-border">
          <a href="/card/<? print $element['uid']; ?>"><?php print $element['qr']; ?></a>
        </div>
      </div>
      <? else: ?>
      <div class="p-card-links">

        <div class="p-card-contact">
          <? if (isset($element['phone'])): ?>
            <div><a class="ph" href="tel:<? print $element['phone']; ?>" rel="nofollow" target="_blank" title="Позвонить"><i class="fas fa-phone-alt"></i></a></div>
          <? endif; ?>
          <div><a class="em" href="mailto:<? print $element['email']; ?>" rel="nofollow" target="_blank" title="Написать"><i class="far fa-envelope-open"></i></a></div>
        </div>

        <div class="p-card-social">
          <a class="wa" href="https://wa.me/<? print $element['phone']; ?>" rel="nofollow" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
          <a class="fb" href="http://www.facebook.com/kccc.ru" rel="nofollow" target="_blank" title="Facebook"><i class="fab fa-facebook"></i></a>
          <a class="in" href="https://www.instagram.com/td_kccc/" rel="nofollow" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
        <div class="p-card-add">
<!--          <span class="add-card">Добавить в контакты</span>-->
        </div>
        <div class="p-card-share">
          <a href="/card/<? print $element['uid']; ?>/share">
            <i class="far fa-share-square"></i>
            <div>Поделиться<br>контактом</div>
            <div class="p-card-qr-sm"><img src="/sites/all/themes/vctheme/images/qr_sm.png" /></div>
          </a>
        </div>
      <? endif; ?>
    </div>

  </div>
</div>


