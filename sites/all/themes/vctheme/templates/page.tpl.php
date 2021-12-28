<header class="header">
  <div class="container">
    <div class="branding">
      <a href="<?php print $front_page ?>">
        <img src="<?php print $logo ?>" />
      </a>
    </div>

    <div class="menu">
      <?php if ($primary_nav): print $primary_nav; endif; ?>
      <?php if ($secondary_nav): print $secondary_nav; endif; ?>
    </div>
  </div>
</header>

<div class="page">
  <div class="container">
    <div class="content">
      <?php print render($title_prefix); ?>
      <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
      <?php print render($title_suffix); ?>

      <?php if (isset($tabs)): ?><?php print render($tabs); ?><?php endif; ?>
      <?php print $messages; ?>
      <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>


      <?php print render($page['content']); ?>
    </div>
  </div>
</div>
