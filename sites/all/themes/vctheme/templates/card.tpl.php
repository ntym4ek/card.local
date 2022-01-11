
<div class="card-wrapper">
  <div class="p-card<? print $element['edit'] ? ' edit' : ''; ?>">

    <div class="p-card-top">

      <div class="p-card-im">
        <div class="p-card-photo">
          <div>
            <img src="<?php print $element['photo_url']; ?>" />
          </div>
        </div>
        <div class="p-card-logo">
            <div>
            <? if ($element['logo_url']): ?>
              <img src="<?php print $element['logo_url']; ?>" />
            <? endif; ?>
          </div>
        </div>
      </div>
      <div class="p-card-name"><? print $element['name']; ?></div>
      <div class="p-card-company-office"><? print $element['office']; ?></div>
      <div class="p-card-company-name"><? print $element['company']; ?></div>

    </div>

    <div class="p-card-content">
      <? if ($element['share']): ?>
      <div class="p-card-qr">
        <div class="p-card-border">
          <a href="/card/<? print $element['uid']; ?>"><?php print $element['qr']; ?></a>
        </div>
      </div>
        <div class="p-card-make-icon"><a href="#">быстрый доступ к визитке</a></div>
        <div class="popover">
          <div class="popover-content">
            <div class="popover-arrow"><span></span></div>
            <div class="popover-inner" role="tooltip">
              <div class="popover-title">
                <span>Быстрый доступ к визитке</span>
              </div>
              <div class="popover-inner-content">
                <div>Для добавления иконки быстрого доступа на экран устройства нажмите <i class="fas fa-ellipsis-v"></i> , а затем "Добавить ярлык"</div>
              </div>
            </div>
          </div>
        </div>
      <? else: ?>
      <div class="p-card-links">
        <div class="p-card-contact">
          <div class="p-card-user-phone<? print empty($element['phone']) ? '' : ' filled'; ?>"><a class="ph" href="tel:<? print $element['phone']; ?>" rel="nofollow" target="_blank" title="Позвонить"><i class="fas fa-phone-alt"></i></a></div>
          <div class="p-card-user-email filled"><a class="em" href="mailto:<? print $element['email']; ?>" rel="nofollow" target="_blank" title="Написать"><i class="far fa-envelope-open"></i></a></div>
        </div>

        <div class="p-card-social">
          <a class="wa<? print empty($element['wa']) ? '' : ' filled'; ?>" href="https://wa.me/<? print $element['wa']; ?>" rel="nofollow" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
          <a class="fb<? print empty($element['fb']) ? '' : ' filled'; ?>" href="<? print $element['fb']; ?>" rel="nofollow" target="_blank" title="Facebook"><i class="fab fa-facebook"></i></a>
          <a class="in<? print empty($element['in']) ? '' : ' filled'; ?>" href="<? print $element['in']; ?>" rel="nofollow" target="_blank" title="Инстаграм"><i class="fab fa-instagram"></i></a>
          <a class="vk<? print empty($element['vk']) ? '' : ' filled'; ?>" href="<? print $element['vk']; ?>" rel="nofollow" target="_blank" title="ВКонтакте"><i class="fab fa-vk"></i></a>
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
        <div class="p-card-make">
          <? if ($element['logged']): ?>
            <a href="/user/<? print $element['uid'] ?>/edit/main"><img src="/sites/all/themes/vctheme/logo.png">редактировать</a>
          <? else: ?>
            <a href="/"><img src="/sites/all/themes/vctheme/logo.png">хочу такую же</a>
          <? endif; ?>
        </div>
      <? endif; ?>
    </div>

  </div>
</div>


