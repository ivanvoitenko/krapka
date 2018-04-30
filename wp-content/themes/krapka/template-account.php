<?
/*
 * Template Name: Account
 * */
?>
<? if(!is_page('settings')): ?>
    <div id="section-collapse" class="filled-section section-breadcrums panel-collapse collapse in">
        <div class="container">
            <? if(function_exists('yoast_breadcrumb')) yoast_breadcrumb('<ul class="breadcrumb">', '</ul>') ?>
            <div class="row">
                <div class="col-md-12 expert-introduce">
                    <? if(!is_page('edit')): ?>
                        <div class="author-img">
                            <?= get_wp_user_avatar($userdata->ID, 'thumbnail') ?>
                        </div>
                        <h1><?= $userdata->display_name ?></h1>
                    <? else: ?>
                        <a href="#" class="author-img author-img--change">
                            <?= get_wp_user_avatar($userdata->ID, 'thumbnail') ?>
                            <span class="change">Заменить<br>фото</span>
                        </a>
                        <input type="file" id="avatar" accept=".png, .jpeg, .jpeg, image/png, image/jpeg" style="display: none;">
                    <? endif ?>
                </div>
            </div>
        </div>
    </div>

<? endif ?>
<? get_template_part('templates/account', get_queried_object()->post_name) ?>
