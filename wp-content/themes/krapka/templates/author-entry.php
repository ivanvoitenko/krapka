<? global $authordata ?>
<div class="article-block image-top author-block">
    <div style="background-image: url(<?= get_wp_user_avatar_src($authordata->ID, 'author-big') ?>)" class="article-block__image"></div>
    <div class="block">
        <div class="block-top">
            <span>Cпециализация: </span>
            <div class="cat"><?= get_user_meta($authordata->ID, 'специализация', true) ?></div>
        </div>
        <div class="block-center">
            <a href="<? author_url() ?>" class="block-header">
                <? the_author() ?>
            </a>
        </div>
        <div class="block-bottom">
            <a href="<? author_url() ?>" class="posts">
                <i class="zmdi zmdi-file-text"></i> <?= count_user_posts($authordata->ID) ?> публикаций</a>
        </div>
    </div>
</div>