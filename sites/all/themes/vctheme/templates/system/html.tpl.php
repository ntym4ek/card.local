<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" version="XHTML+RDFa 1.0" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="profile" href="<?php print $grddl_profile; ?>" />

  <link rel="manifest" href="/manifest.ru.webmanifest">
  <meta name="msapplication-TileImage" content="/sites/default/files/logo/icon-192x192.png">
  <meta name="msapplication-TileColor" content="#2F3BA2">
  <link rel="apple-touch-icon" href="/sites/default/files/logo/icon-192x192.png">

  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
<!--  <script src="/app.js"></script>-->
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
<?php print $page_top; ?>
<?php print $page; ?>
<?php print $page_bottom; ?>
</body>
</html>
