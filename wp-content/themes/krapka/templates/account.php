<? global $userdata ?>
<div class="filled-profile-section topic-page-section account-page">
    <div class="container">
        <? get_template_part('templates/account', 'head') ?>

        <? if (get_user_meta(get_current_user_id(), 'filled', true)): ?>
            <div class="profile-section filled-profile-text-block clearfix">
                <div class="filled-profile-top">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p><b>Должность: </b> <? the_field('position', $userdata) ?></p>
                            <p><b>Организация: </b> <? the_field('organization', $userdata) ?></p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p><b class="small-length">Страна: </b> <? the_field('country', $userdata) ?></p>
                            <p><b class="small-length">Город: </b> <? the_field('city', $userdata) ?></p>
                        </div>
                    </div>
                </div>
                <div class="tags-list">
                    <b>Интересы: </b>
                    <div class="actual-tags tags-list__content clearfix">
                        <?
                        $tags = get_field('tags', 'user_' . get_current_user_id());
                        if ($tags) foreach($tags as $tag): ?>
                            <div class="item" data-id="<?= $tag->term_id ?>">
                                <input type="checkbox" style="display: none;" name="tags[]" value="<?= $tag->term_id ?>">
                                <span class="tag remove-user-tag">#<?= $tag->name ?> <i class="zmdi zmdi-close"></i></span>
                            </div>
                        <? endforeach ?>
                    </div>
                </div>
                <div class="filled-profile-about">
                    <b>Обо мне: </b>
                    <?= apply_filters('the_content', get_user_meta(get_current_user_id(), 'description', true)) ?>
                </div>
            </div>
        <? else: ?>
        <div class="row">
            <div class="col-md-offset-2 col-md-8 col-xs-12">
                <div class="articles-empty">
                    <h2>Вы очень скромны</h2>
                    <p><?= wp_get_current_user()->display_name ?>, вы еще ничего о себе не рассказали. Посмотрите, что о себе пишут <a class="orange" href="#">другие пользователи</a>.</p>
                </div>
            </div>
        </div>

        <? endif ?>
    </div>
</div>