<div class="filled-section">
    <div class="edit-profile-section profile-section container">
        <div class="edit-profile-main-form">
            <form action="<?= admin_url('admin-post.php') ?>" method="post" class="uk-form">
                <input type="hidden" name="action" value="edit_profile">
                <? wp_nonce_field('edit_profile') ?>
                <div class="uk-form-row">
                    <div class="uk-form-column uk-form-column-6">
                        <div class="uk-form-margin">
                            <label class="uk-form-label" for="form-stacked-text">Имя</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" name="first_name" value="<?= get_user_meta(get_current_user_id(), 'first_name', true) ?>">
                            </div>
                        </div>

                        <div class="uk-form-margin">
                            <label class="uk-form-label" for="form-stacked-text">Должность</label>
                            <div class="uk-form-controls">
                                <input name="position" value="<? the_field('position', 'user_' . get_current_user_id()) ?>" class="uk-input" id="form-stacked-text" type="text">
                            </div>
                        </div>
                        <div class="uk-form-margin">
                            <label class="uk-form-label" for="form-stacked-text">Страна</label>
                            <div class="uk-form-controls">
                                <select class="uk-select" name="country">
                                    <option value="">Выбрать</option>
                                    <? foreach(get_countries_array() as $country): ?>
                                        <option <?= get_field('country', 'user_' . get_current_user_id()) == $country ? 'selected' : '' ?> value="<?= $country ?>"><?= $country ?></option>
                                    <? endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="uk-form-column uk-form-column-6">
                        <div class="uk-form-margin">
                            <label class="uk-form-label" for="form-stacked-text">Фамилия</label>
                            <div class="uk-form-controls">
                                <input name="last_name" class="uk-input" type="text" value="<?= get_user_meta(get_current_user_id(), 'last_name', true) ?>">
                            </div>
                        </div>

                        <div class="uk-form-margin">
                            <label class="uk-form-label" for="form-stacked-text">Организация</label>
                            <div class="uk-form-controls">
                                <input value="<? the_field('organization', 'user_' . get_current_user_id()) ?>" name="organization" class="uk-input" id="form-stacked-text" type="text">
                            </div>
                        </div>
                        <div class="uk-form-margin">
                            <label class="uk-form-label" for="form-stacked-text">Город</label>
                            <div class="uk-form-controls">
                                <input value="<? the_field('city', 'user_' . get_current_user_id()) ?>" name="city" class="uk-input" id="form-stacked-text" type="text">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="settings-params">
                    <div class="tags-list uk-form-column  uk-form-column-12">
                        <label class="uk-form-label">Интересы</label>
                        <div class="uk-form-margin">
                            <div class="tags-list__content">
                                <?
                                $user_tags = [];
                                $tags = get_field('tags', 'user_' . get_current_user_id());
                                if ($tags) foreach($tags as $tag):
                                    $user_tags[] = $tag->term_id;
                                    ?>
                                    <div class="item" data-id="<?= $tag->term_id ?>">
                                        <input checked type="checkbox" style="display: none;" name="tags[]" value="<?= $tag->term_id ?>">
                                        <span class="tag">#<?= $tag->name ?> <i class="zmdi zmdi-close"></i></span>
                                    </div>
                                <? endforeach ?>
                            </div>

                            <a onclick="return false" href="#" class="dropbtn-2 add-tags">Добавить интересы <i class="zmdi zmdi-plus-circle-o"></i></a>
                        </div>
                        <div class="dropdown">
                            <div class="dropdown-content all-tags-content">
                                <div class="all-checkbox row">
                                    <? foreach(get_tags(['posts_per_page' => -1]) as $term): ?>
                                        <div class="item col-md-4 col-sm-6 col-xs-12">
                                            <input value="<?= $term->term_id ?>" id="all-checkbox-<?= $term->term_id ?>" class="uk-checkbox" type="checkbox" <?= in_array($term->term_id, $user_tags) ? 'checked' : '' ?>>
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

                <div class="uk-form-margin uk-form-column uk-form-column-12">
                    <label class="uk-form-label" for="form-stacked-text">О себе</label>
                    <div class="uk-form-controls">
                        <textarea class="uk-textarea" name="description" id="form-stacked-text" placeholder="Максимум 5000 слов..." type="text"><?= get_user_meta(get_current_user_id(), 'description', true) ?></textarea>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="but but--inline">Сохранить</button>
                    <br>
                    <a href="<? the_permalink(151) ?>" class="back">Отмена</a>
                </div>
            </form>
        </div>
    </div>
</div>