<? use Roots\Sage\Assets; ?>
<nav class="hidden-md hidden-lg navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a href="#" class="navbar-toggle pull-right">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <a href="<?= home_url() ?>" class="logo navbar-brand"><img src="<?= Assets\asset_path('images/logo.svg') ?>" alt=""></a>
            <a class="logo-white navbar-brand" href="<?= home_url() ?>"><img src="<?= Assets\asset_path('images/logo-white.svg') ?>" alt=""></a>
        </div>

        <!-- Навигационное меню -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <div class="text-center" style="display: none;">
                <? get_search_form() ?>
            </div>

            <?php if(0): ?>
              <div class="lang">
                  <a href="<?php echo qtranxf_get_url_for_language('', 'ru', true); ?>" <?= get_locale() == 'ru_RU' ? 'class="orange"' : '' ?>>RUS</a><!--
                  -->|<a href="<?php echo qtranxf_get_url_for_language('', 'ua', true); ?>" <?= get_locale() == 'uk' ? 'class="orange"' : '' ?>>UKR</a><!--
                  -->|<a href="<?php echo qtranxf_get_url_for_language('', 'en', true); ?>" <?= get_locale() == 'en_US' ? 'class="orange"' : '' ?>>ENG</a>
              </div>
              <div class="user-nav">
                  <? if(is_user_logged_in()): ?>
                  <div class="user__logged">
                      <a href="<? the_permalink(151) ?>" class="user__avatar">
                          <div class="image"><img src="<?= get_wp_user_avatar_src(get_current_user_id(), 'thumbnail') ?>" alt=""></div>
                      </a>
                  </div>
                  <? else: ?>
                      <div class="login">
                          <a class="login-popup" href="#login-form">Войти</a>
                      </div>
                  <? endif ?>
              </div>
            <?php endif; // endif 0 ?>
            <? wp_nav_menu([
                'theme_location' => 'primary_navigation',
                'menu_class' => 'nav navbar-nav',
                'container' => false,
            ]) ?>
        </div>
    </div>
</nav>
<div class="topbar visible-md visible-lg">
    <div class="container">
        <div class="logo pull-left">
            <a href="<?= site_url() ?>" class=""><img src="<?= Assets\asset_path('images/logo.svg') ?>" alt=""></a>
        </div>
        <?php if(0) : ?>
          <div class="pull-left lang">
              <a href="<?php echo qtranxf_get_url_for_language('', 'ru', true); ?>" <?= get_locale() == 'ru_RU' ? 'class="orange"' : '' ?>>RUS</a><!--
                  --><a href="<?php echo qtranxf_get_url_for_language('', 'ua', true); ?>" <?= get_locale() == 'uk' ? 'class="orange"' : '' ?>>UKR</a><!--
                  --><a href="<?php echo qtranxf_get_url_for_language('', 'en', true); ?>" <?= get_locale() == 'en_US' ? 'class="orange"' : '' ?>>ENG</a>
          </div>
        <?php endif; // endif 0 ?>
        <div class="pull-right send"> <a href="<? the_permalink(15) ?>" class="but">Прислать информацию</a></div>
        <?php if(0) : ?>
          <div class="user pull-right">
              <? if(is_user_logged_in()): ?>
                  <div class="user__logged">
                      <div data-toggle="dropdown" class="dropdown-toggle user__avatar">
                          <div class="image"><img src="<?= get_wp_user_avatar_src(get_current_user_id(), 'thumbnail') ?>" alt=""></div>
                      </div>
                      <ul role="menu" class="dropdown-menu user-menu">
                          <li>Здравствуйте, <span class="user-name"><?= wp_get_current_user()->display_name ?></span>!</li>
                          <li><a href="<? the_permalink(153) ?>">Сохраненные статьи</a></li>
                          <li><a href="<? the_permalink(155) ?>">Понравившиеся статьи</a></li>
                          <li><a href="<? the_permalink(151) ?>">Ваш профиль</a></li>
                          <li><a href="<? the_permalink(157) ?>">Настройки</a></li>
                          <li><a href="<?php echo wp_logout_url( home_url() ); ?>">Выйти</a></li>

                      </ul>
                  </div>
              <? else: ?>
                  <div class="login">
                      <a class="login-popup" href="#login-form">Войти</a>
                  </div>
                  <div id="login-form" class="white-popup-block mfp-hide">
                      <div class="login-block">
                          <div class="popup-title">Авторизоваться в Krapka.club</div>
                          <div class="col-md-6 col-xs-12 social-btn-group">
                              <a href="<?= site_url('?connect=facebook') ?>" class="face-btn"><i class="zmdi zmdi-facebook"></i> Войти через Facebook</a>
                              <a href="<?= site_url('?connect=google') ?>" class="google-btn"><i class="zmdi zmdi-google"></i> Войти через Google</a>
                          </div>
                          <form method="post" id="loginform" class="col-md-6 col-xs-12 form-block">
                              <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
                              <input type="hidden" name="action" value="ajaxlogin">
                              <div class="form-controls">
                                  <label class="uk-form-label" for="for-email">Email</label>
                                  <div class="uk-form-controls">
                                      <input name="user_login" id="for-email" class="uk-input" type="text" placeholder="Введите ваше email...">
                                      <span style="display: none;" class="error"></span>
                                  </div>
                              </div>

                              <div class="form-controls">
                                  <label class="uk-form-label" for="form-pass">Пароль</label>
                                  <div class="uk-form-controls">
                                      <input name="user_password" class="uk-input" id="form-pass" type="password" placeholder="Введите ваш пароль...">
                                  </div>
                              </div>
                              <div class="form-controls uk-checkbox-control  margin-checkbox">
                                  <div class="uk-form-controls">
                                      <input class="uk-checkbox" id="login-remember" type="checkbox">
                                      <label for="login-remember"></label>
                                  </div>
                                  <label class="uk-form-label" for="login-remember">Запомнить</label>

                              </div>
                              <div class="enter-block">
                                  <button type="submit" class="uk-button uk-button-default but">Войти</button>
                                  <span>
                                      Еще не создали аккаунт? <br>
                                      <a class="orange" href="/register">Зарегистрироваться</a>
                                  </span>
                              </div>
                          </form>
                      </div>
                  </div>
              <? endif ?>
          </div>
          <div class="search-bl pull-right" style="display: none;">
              <? get_search_form() ?>
          </div>
        <?php endif; // endif 0 ?>
    </div>
</div>

<div class="topbarMenu visible-lg visible-md">
    <div class="container">
        <? wp_nav_menu([
            'theme_location' => 'primary_navigation',
            'container' => false,
        ]) ?>
    </div>
</div>

<? if(!is_single() && !is_author() && !in_array(get_the_ID(), [104, 110, 108, 106, 112, 17, 148, 151, 161, 153,155,157, 180, 182])): ?>
<div class="section-1 <?= (get_field('включить_бекграунд')) ? 'section-picture' : '' ?>"
    <? if (get_field('включить_бекграунд') && $bg = get_field('bg')) echo 'style="background-image:url('.$bg.')"' ?>>
    <div class="container">
        <div class="row">
           <?php if(!isset($_COOKIE['front_banner'])): ?>
           <div class="panel-collapse collapse in content text-center" id="section-collapse">
               <a data-toggle="collapse" href="#section-collapse" class="closeIcon"
                  onclick="document.querySelector('.page-content').removeAttribute('hidden')">
                 <i class="zmdi zmdi-close"></i>
               </a>
               <?php $h1 = "Независимое бюро <br> экспертизы и расследований";
                    echo is_front_page() ? "<h1>$h1</h1>" : "<div class='h1'>$h1</div>"
               ?>
               <p>Мы создали этот проект, чтобы говорить о волнующих вопросах правду <span class="oval"></span></p>
               <a href="<? the_permalink(9) ?>" class="but col-md-12">Подробнее о проекте</a>
           </div>
           <?php endif; ?>

           <?php if(!is_front_page()): ?>
           <div class="page-content col-xs-12" <?php if(!isset($_COOKIE['front_banner'])) echo 'hidden' ?>>
               <? if(function_exists('yoast_breadcrumb')) yoast_breadcrumb('<ul class="breadcrumb breadcrumb-uk">', '</ul>') ?>
               <h1>
               <? if(is_page()) {
                    the_title();
               } else if(is_archive()) {
                   echo get_queried_object()->name;
               } ?>
               </h1>
               <p>
                   <? if(is_page()) {
                       $content = get_field('краткое_описание');
                   } else if (is_archive()) {
                       $content = apply_filters('gettext', get_queried_object()->description);
                   } ?>
                   <?= strip_tags($content, '<br>') ?> <span class="oval"></span>
               </p>
           </div>
           <?php endif; ?>
        </div>
    </div>
</div>
<? endif ?>
