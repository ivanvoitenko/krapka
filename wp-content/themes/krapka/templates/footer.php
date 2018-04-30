<? use Roots\Sage\Assets; ?>
<div class="footer" style="padding-top: 30px">
  <?php if(0) : //hidden top footer ?>
    <div class="top container visible-md visible-lg">
        <div class="flexWrapper">
            <div class="flexItem">
                <i class="zmdi zmdi-email"></i>
                <div class="text">
                    <div class="title">Присылайте вопросы</div>
                    <p>Задавайте вопросы и получайте экспертную оценку</p>
                </div>

            </div>
            <div class="flexItem">
                <i class="zmdi zmdi-favorite"></i>
                <div class="text">
                    <div class="title">Сохраняйте факты</div>
                    <p>Храните все важные факты в одном месте</p>
                </div>
            </div>
            <a href="<? the_permalink(15) ?>" class="but">Прислать информацию</a>
        </div>
    </div>
  <?php endif; // end hidden top footer ?>

    <? wp_nav_menu([
        'theme_location'  => 'footer_mobile_navigation',
        'menu_class' => 'mobile-menu visible-sm visible-xs',
    ]) ?>

    <hr class="visible-sm visible-xs">
    <div class="bottom container">
        <div class="flexWrapper bottom-block">
            <div class="flexItem footer-logo">
                <a class="logo" href="<?= home_url() ?>"><img src="<?= Assets\asset_path('images/logo-white.svg') ?>" alt=""></a>
                <?php if(0) : ?>
                    <div class="social">
                        <a href="#" class="zmdi zmdi-facebook"></a>
                        <a href="#" class="zmdi zmdi-twitter twitter"></a>
                    </div>
                <?php endif; ?>
            </div>

          <?php if(0): //hidden 3 sidebars ?>
            <div class="visible-md visible-lg flexItem">
                <? dynamic_sidebar('sidebar-footer-1') ?>
            </div>
            <div class="visible-md visible-lg flexItem">
                <? dynamic_sidebar('sidebar-footer-2') ?>
            </div>
            <div class="visible-md visible-lg flexItem">
                <? dynamic_sidebar('sidebar-footer-3') ?>
            </div>
          <?php endif; //end hidden 3 sidebars ?>
            <div class="visible-md visible-lg flexItem" style="width: auto">
                <? dynamic_sidebar('sidebar-footer-4') ?>
            </div>
        </div>
    </div>
</div>

<div id="facebook-validate" class="white-popup-block fb-login-popup mfp-hide">
    <div class="facebook-done-block">
        <div class="title">Добро пожаловать в Krapka.club, <span class="name"></span>!</div>
        <p>Мы создали <b>Krapka.club</b> аккаунт, основанный на вашей информации в Facebook.</p>
        <div class="user-block">
            <div class="img"></div>
            <p class="name"></p>
        </div>

        <p>Если все правильно, «Подтвердить».</p>
        <a href="#" class="uk-button uk-button-default but">Подтвердить</a>
        <span class="cancel">Отмена</span>

    </div>
</div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/<?= get_locale() ?>/sdk.js#xfbml=1&version=v2.10&appId=1611419339112410";
    fjs.parentNode.insertBefore(js, fjs);

    window.fbAsyncInit = function() {
        FB.init({
            appId      : '1611419339112410',
            cookie     : true,  // enable cookies to allow the server to access
                                // the session
            xfbml      : true,  // parse social plugins on this page
            version    : 'v2.8' // use graph api version 2.8
        });
    }
}(document, 'script', 'facebook-jssdk'));
</script>
