<div class="settings-section">
    <div class="container">
        <? if(function_exists('yoast_breadcrumb')) yoast_breadcrumb('<ul class="breadcrumb">', '</ul>') ?>
        <div class="row">
            <div class="col-md-offset-5 col-md-5 col-xs-12">
                <h1><? the_title() ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="settings-menu col-md-offset-2 col-md-3 col-xs-12">
                <ul>
                    <li id="mail-and-pass" class="orange">Почта и пароль</li>
                    <li id="email-send">Email рассылка</li>
                    <li id="privacy">Приватность</li>
                </ul>
            </div>
            <div class="settings-params col-md-5 col-xs-12">
                <form method="post" class="uk-form form__user-settings form-block">
                    <input type="hidden" name="action" value="save_user_settings">
                    <? wp_nonce_field('save_user_settings') ?>
                    <div class="mainDiv mail-and-pass">
                        <h2>Почта и пароль</h2>
                        <div class="uk-form-stacked">
                            <div class="uk-margin">
                                <label class="uk-form-label" for="form-stacked-text">Email</label>
                                <div class="form-controls">
                                    <input class="uk-input" name="user_email" type="email">
                                </div>
                            </div>

                            <div class="uk-margin">
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <label class="uk-form-label" for="form-stacked-text">Новый пароль</label>
                                        <div class="form-controls">
                                            <input class="uk-input clear-after-submit" id="form-stacked-text" name="pass" type="password">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <label class="uk-form-label" for="form-stacked-text">Старый пароль</label>
                                        <div class="form-controls">
                                            <input class="uk-input clear-after-submit" id="form-stacked-text" name="pass2" type="password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mainDiv email-send">
                        <? $tags = get_user_meta(get_current_user_id(), 'subscribe_tags', true); ?>
                        <h2>Email рассылка <a href="#" class="orange pull-right <?= !$tags ? 'disabled' : '' ?>" data-toggle="off">Отписаться</a></h2>
                        <div class="tags-list">
                            <? if ($tags = get_user_meta(get_current_user_id(), 'subscribe_tags', true)): ?>
                                <p>Вы подписаны на темы:</p>
                            <? else: ?>
                                <p>Вы не подписаны на рассылку. Добавьте интересующие вас темы, чтобы получать свежие новости.</p>
                            <? endif ?>
                            <div class="tags-list__content uk-form-margin">
                                <?
                                $user_tags = [];
                                $tags = get_user_meta(get_current_user_id(), 'subscribe_tags', true);
                                if ($tags) {
                                    foreach($tags as $tag_id) {
                                        $user_tags[] = $tag_id;
                                        $tag = get_term($tag_id);
                                        ?>
                                        <div class="item" data-id="<?= $tag->term_id ?>">
                                            <input checked type="checkbox" style="display: none;" name="tags[]" value="<?= $tag->term_id ?>">
                                            <span class="tag remove-tag">#<?= $tag->name ?> <i class="zmdi zmdi-close"></i></span>
                                        </div>
                                    <? }
                                } ?>
                                <a onclick="return false" href="#" class="dropbtn-2 add-tags">Добавить интересы <i class="zmdi zmdi-plus-circle-o"></i></a>
                            </div>

                            <div class="dropdown">
                                <div class="dropdown-content all-tags-content">
                                    <div class="all-checkbox row">
                                        <? foreach(get_tags(['posts_per_page' => -1]) as $term): ?>
                                            <div class="item col-md-4 col-sm-6 col-xs-12">
                                                <input value="<?= $term->term_id ?>" id="all-checkbox-<?= $term->term_id ?>" class="uk-checkbox col-md-4 col-sm-6 col-xs-12" type="checkbox" <?= in_array($term->term_id, $user_tags) ? 'checked' : '' ?>>
                                                <label for="all-checkbox-<?= $term->term_id ?>">
                                                    <i class="zmdi zmdi-check"></i>
                                                </label>
                                                <span><?= $term->name ?></span>
                                            </div>
                                        <? endforeach ?>
                                    </div>
                                    <a href="#" class="checkbox-but save-close">Сохранить</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mainDiv privacy">
                        <h2>Приватность</h2>
                        <p>Кто будет видеть ваш профиль?</p>
                        <? $privacy = get_user_meta(get_current_user_id(), 'privacy', true); ?>
                        <div class="radio-line">
                            <input type="radio" id="r1" value="all" name="privacy" <?= $privacy == 'all' || !$privacy ? 'checked' : '' ?> />
                            <label for="r1"><span></span>Все</label>
                        </div>
                        <div class="radio-line">

                            <input type="radio" id="r2" value="register" <?= $privacy == 'register' ? 'checked' : '' ?> name="privacy" />
                            <label for="r2"><span></span>Только зарегистрированные прользователи Krapka.club</label>
                        </div>
                        <div class="radio-line">

                            <input type="radio" id="r3" value="hide" <?= $privacy == 'hide' ? 'checked' : '' ?> name="privacy" />
                            <label for="r3"><span></span>Только вы (скрытый профиль)</label>
                        </div>

                    </div>
                    <button class="black-but">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</div>