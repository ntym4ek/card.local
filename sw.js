var dataCacheName = 'v2';
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(dataCacheName).then((cache) => {
      return cache.addAll([
        '/',
        '/modules/system/system.base.css',
        '/modules/system/system.menus.css',
        '/modules/system/system.messages.css',
        '/modules/system/system.theme.css',
        '/modules/field/theme/field.css',
        '/modules/node/node.css',
        '/modules/user/user.css',
        '/sites/all/themes/vctheme/css/vctheme.css',
        '/sites/all/modules/contrib/jquery_update/replace/jquery/2.1/jquery.min.js?v=2.1.4',
        '/misc/jquery-extend-3.4.0.js?v=2.1.4',
        '/misc/jquery-html-prefilter-3.5.0-backport.js?v=2.1.4',
        '/misc/jquery.once.js?v=1.2',
        '/misc/drupal.js',
        '/sites/all/modules/contrib/admin_menu/admin_devel/admin_devel.js',
        '/sites/all/themes/vctheme/js/vctheme.js',
        'https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;700&display=swap',
        // 'https://use.fontawesome.com/releases/v5.11.0/css/all.css',
        '/sites/all/themes/vctheme/logo.png',
        '/sites/all/themes/vctheme/images/hand.png',
        '/misc/favicon.ico',
        '/sites/default/files/logo/152.png',
        '/app.js',
        '/sw.js'
        // '/manifest.webmanifest'
      ]);
    })
  );
});

self.addEventListener('activate', function(e) {
  console.log('[ServiceWorker] Activate');
  e.waitUntil(
    caches.keys().then(function(keyList) {
      return Promise.all(keyList.map(function(key) {
        if (key !== dataCacheName) {
          console.log('[ServiceWorker] Removing old cache', key);
          return caches.delete(key);
        }
      }));
    })
  );
  return self.clients.claim();
});

self.addEventListener('fetch', function(e) {
  console.log('[Service Worker] Fetch', e.request.url);
  if (e.request.url.indexOf('edit') > -1) {
    e.respondWith(fetch(e.request));
  } else {
    e.respondWith(
      caches.open(dataCacheName).then(function(cache) {
        return fetch(e.request).then(function(response){
          cache.put(e.request.url, response.clone());
          return response;
        });
      })
    );
  }
});

