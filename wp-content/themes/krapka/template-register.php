<?php
/**
 * Template Name: Register
 */
?>

<div class="registation-page">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 col-xs-12">
                <div class="hello-block">
                    <h1>Добро пожаловать в Krapka.club!</h1>
                    <h3>Когда вы присоединитесь к <b>Krapka.club</b>, вы можете оставлять комментарии, сохранять статьи и просто быть в хорошей компании.</h3>
                    <p>Уже зарегистрированы? <a class="login-popup orange" href="#login-form">Войти</a></p>
                </div>
            </div>
        </div>
        <div class="mfp-wrap register-block">
            <div class="mfp-content">
                <div class="white-popup-block clearfix">

                    <div class="popup-title">Авторизоваться в Krapka.club</div>
                    <div class="col-md-6 col-xs-12 social-btn-group">
                        <a href="<?= home_url('/?connect=facebook') ?>" class="face-btn"><i class="zmdi zmdi-facebook"></i> Войти через Facebook</a>
                        <a href="<?= home_url('/?connect=google') ?>" class="google-btn"><i class="zmdi zmdi-google"></i> Войти через Google</a>
                        <p class="disclaimer">Krapka.club не будет публиковать ничего в вашем Facebook аккаунте без вашего разрешения.</p>
                    </div>
                    <form method="post" id="register-form" class="col-md-6 col-xs-12 form-block">
                        <? wp_nonce_field('register') ?>
                        <input type="hidden" name="action" value="register">
                        <div class="form-controls">
                            <label class="uk-form-label" for="for-email">Имя</label>
                            <div class="uk-form-controls">
                                <input name="first_name" id="for-email" class="uk-input" type="text">
                            </div>
                        </div>
                        <div class="form-controls">
                            <label class="uk-form-label" for="for-email">Email</label>
                            <div class="uk-form-controls">
                                <input name="user_email" id="for-email" class="uk-input" type="text">
                            </div>
                        </div>

                        <div class="form-controls">
                            <label class="uk-form-label" for="form-pass">Пароль</label>
                            <div class="uk-form-controls">
                                <input name="user_pass" class="uk-input" id="form-pass" type="password">
                            </div>
                        </div>

                        <div class="enter-block">
                            <button type="submit" class="uk-button uk-button-default but">Создать аккаунт</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>