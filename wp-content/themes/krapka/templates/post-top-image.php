<? global $article_class;?>
<div data-id="<? the_ID() ?>" class="article-block h-550px image-top <?= $article_class ?>">
    <a href="<? the_permalink() ?>" style="background-image: url(<? the_post_thumbnail_url('post') ?>)" class="article-block__image"></a>
    <div class="block">
       <? get_template_part('templates/post', 'meta') ?>
        <p class="block-description">
            <? the_excerpt() ?>
        </p>
        <div class="block-bottom">
            <? get_template_part('templates/post', 'author') ?>
            <? if (0 && is_user_logged_in()): ?>
            <a data-id="<? the_ID() ?>" href="#" class="zmdi zmdi-download action-save"></a>
            <? endif ?>
        </div>
    </div>
</div>
