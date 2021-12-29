(function ($) {
  Drupal.behaviors.vctheme = {
    attach: function (context, settings) {

      $(".field-name-field-user-name input").on("keyup", function () {
        $(".p-card-name").text($(".field-name-field-user-name input").val() + " " + $(".field-name-field-user-surname input").val());
      });
      $(".field-name-field-user-surname input").on("keyup", function () {
        $(".p-card-name").text($(".field-name-field-user-name input").val() + " " + $(".field-name-field-user-surname input").val());
      });
      $(".field-name-field-company-name input").on("keyup", function () {
        $(".p-card-company-name").text($(this).val());
      });
      $(".field-name-field-company-office input").on("keyup", function () {
        $(".p-card-company-office").text($(this).val());
      });

      function preparePhone(phone) {
        phone = phone.replace(/[^\d]/, "");
        return phone.replace(/^[8]/, "7");
      }

      // телефон
      $(".field-name-field-user-phone input").on("keyup", function () {
        var value = $(this).val();
        if (value) {
          value = preparePhone(value);
          $(".p-card-user-phone").replaceWith('<div class="p-card-user-phone filled"><a href="tel:+' + value + '" target="_blank" title="Позвонить"><i class="fas fa-phone-alt"></i></a></div>');
        } else {
          $(".p-card-user-phone").removeClass("filled");
        }
      });

      // почта
      $(".field-name-field-user-email input").on("keyup", function () {
        var value = $(this).val();
        if (value) {
          $(".p-card-user-email").replaceWith('<div class="p-card-user-email filled"><a class="em" href="mailto:' + value + '" rel="nofollow" target="_blank" title="Написать"><i class="far fa-envelope-open"></i></a></div>');
        } else {
          $(".p-card-user-email").removeClass("filled");
        }
      });


      // в течение 10 сек проверять наличие ФОТО и продублировать в визитку
      $(".field-name-field-user-photo [type=submit]").on("mousedown", function () {
        let timerIdPh = setInterval(checkPhoto, 1000);
        setTimeout(() => { clearInterval(timerIdPh); }, 10000);
      });
      function checkPhoto() {
        if ($(".field-name-field-user-photo .file-upload-content img").is("img")) {
          var src = $(".field-name-field-user-photo .file-upload-content img").attr("src");
          if (src) {
            $(".p-card-photo").html("<img src=\"" + src + "\" />");
          }
          else $(".p-card-photo img").remove();
        }
      }

      // в течение 10 сек проверять наличие ЛОГО и продублировать в визитку
      $(".field-name-field-company-logo [type=submit]").on("mousedown", function () {
        let timerIdL = setInterval(checkLogo, 1000);
        setTimeout(() => { clearInterval(timerIdL); }, 10000);
      });
      function checkLogo() {
        if ($(".field-name-field-company-logo .file-upload-content img").is("img")) {
          var src = $(".field-name-field-company-logo .file-upload-content img").attr("src");
          if (src) {
            $(".p-card-logo").html("<img src=\"" + src + "\" />");
          }
          else {
            $(".p-card-logo img").remove();
          }
        }
      }

      // WhatsApp
      // добавить кнопку
      if (!$(".field-name-field-user-wa .copy-text").is("div")) {
        $(".field-name-field-user-wa").append("<div class=\"copy-text\"><a title=\"Скопировать поле Телефон\"><i class=\"far fa-copy\"></i></a></div>");
      }
      setTimeout(() => {
        $(".field-name-field-user-wa .copy-text a").on("click", function () {
           $(".field-name-field-user-wa input").val($(".field-name-field-user-phone input").val()).trigger("keyup");
        })
      }, 100);
      // WA в макет
      $(".field-name-field-user-wa input").on("keyup", function () {
        var value = $(this).val();
        if (value) {
          value = preparePhone(value);
          $(".p-card-social .wa").replaceWith('<a class="wa filled" href="https://wa.me/' + value + '" rel="nofollow" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>');
        } else {
          $(".p-card-social .wa").removeClass("filled");
        }
      });

      // Inst
      $(".field-name-field-user-in input").on("keyup", function () {
        var value = $(this).val();
        if (value) {
          $(".p-card-social .in").replaceWith('<a class="in filled" href="' + value + '" rel="nofollow" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>');
        } else {
          $(".p-card-social .in").removeClass("filled");
        }
      });

      // FB
      $(".field-name-field-user-fb input").on("keyup", function () {
        var value = $(this).val();
        if (value) {
          $(".p-card-social .fb").replaceWith('<a class="fb filled" href="' + value + '" rel="nofollow" target="_blank" title="Facebook"><i class="fab fa-facebook"></i></a>');
        } else {
          $(".p-card-social .fb").removeClass("filled");
        }
      });

      // VK
      $(".field-name-field-user-vk input").on("keyup", function () {
        var value = $(this).val();
        if (value) {
          $(".p-card-social .vk").replaceWith('<a class="vk filled" href="' + value + '" rel="nofollow" target="_blank" title="ВКонтакте"><i class="fab fa-vk"></i></a>');
        } else {
          $(".p-card-social .vk").removeClass("filled");
        }
      });


      // виджет загрузки Фото --------------------------------------------------
      function removeUpload(button) {
        var wrap = $(button).closest(".file-upload");

        // wrap.find('[type=file]').val(null);
        wrap.find('[type=file]').replaceWith(wrap.find('[type=file]').clone());
        wrap.find('.file-upload-content').hide();
        wrap.find('.image-upload-wrap').show();
        wrap.find("[name*=remove_button]").mousedown();
        setTimeout(() => { Drupal.attachBehaviors(context, settings); }, 100);
      }

      function readURL(input) {
        if (input.files && input.files[0]) {
          var wrap = $(input).closest(".file-upload");

          var reader = new FileReader();
          reader.onload = function(e) {
            wrap.find('.image-upload-wrap').hide();
            wrap.find('.file-upload-image').attr('src', e.target.result);
            wrap.find('.file-upload-content').show();
          };
          reader.readAsDataURL(input.files[0]);

          wrap.find("[name*=upload_button]").mousedown();
          setTimeout(() => { Drupal.attachBehaviors(context, settings); }, 100);
        } else {
          removeUpload(this);
        }
      }

      $('.remove-btn').on('click', function () {
        removeUpload(this);
      });
      $('[type=file]').on('change', function () {
        readURL(this);
      });

      $('.image-upload-wrap').bind('dragover', function () {
        $('.image-upload-wrap').addClass('image-dropping');
      });
      $('.image-upload-wrap').bind('dragleave', function () {
        $('.image-upload-wrap').removeClass('image-dropping');
      });

      // определение клиента ---------------------------------------------------
      var isMobile = {
        Android: function () {
          return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function () {
          return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function () {
          return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function () {
          return navigator.userAgent.match(/Opera Mini/i);
        },
        Yandex: function () {
          return navigator.userAgent.match(/YaBrowser/i);
        },
        Chrome: function () {
          return navigator.userAgent.match(/Mobile Safari/i);
        },
        Samsung: function () {
          return navigator.userAgent.match(
            /SAMSUNG|Samsung|SGH-[I|N|T]|GT-[I|N]|SM-[A|N|P|T|Z]|SHV-E|SCH-[I|J|R|S]|SPH-L/i,
          );
        },
        Windows: function () {
          return (
            navigator.userAgent.match(/IEMobile/i) ||
            navigator.userAgent.match(/WPDesktop/i)
          );
        },
        any: function () {
          return (
            isMobile.Android() ||
            isMobile.BlackBerry() ||
            isMobile.iOS() ||
            isMobile.Opera() ||
            isMobile.Windows()
          );
        },
      };

      // use this to check if the user is already using your PWA - no need to prompt if in standalone
      function isStandalone() {
        const isStandalone = window.matchMedia("(display-mode: standalone)").matches;
        if (document.referrer.startsWith("android-app://")) {
          return true; // Trusted web app
        } else if ("standalone" in navigator || isStandalone) {
          return true;
        }
        return false;
      }

      // popover ---------------------------------------------------------------
      if ($(".p-card-make-icon").is("div")) {
        alert(navigator.userAgent);
        if (navigator.userAgent.match(/YaBrowser/i)) {
          $(".popover").addClass("popover bottom-right");
          $(".popover-inner-content").html("Для добавления иконки быстрого доступа на экран устройства нажмите <i class=\"fas fa-ellipsis-v\"></i> , а затем \"Добавить ярлык\"");
        } else {
          if (navigator.userAgent.match(/Mobile Safari/i)) {
            $(".popover").addClass("popover top-right");
            $(".popover-inner-content").html("Для добавления иконки быстрого доступа на экран устройства нажмите <i class=\"fas fa-ellipsis-v\"></i> , а затем \"Добавить на гл. экран\"");
          } else {
            if (navigator.userAgent.match(/iPhone|iPad/i)) {
              $(".popover").addClass("popover bottom-center");
              $(".popover-inner-content").html("Для добавления иконки быстрого доступа на экран устройства нажмите <i class=\"fas fa-ellipsis-v\"></i> , а затем \"Добавить на гл. экран\"");
            }
          }
        }

        $(".p-card-make-icon").on("click", function (e) {
          $(".popover").addClass("pop");
          e.stopPropagation();
        });
        $("body").on("click", function () {
          if ($(".popover").hasClass("pop")) {
            $(".popover").removeClass("pop");
          }
        });
      }

    }
  };
})(jQuery);
