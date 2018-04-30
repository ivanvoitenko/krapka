<? global $parent_term ?>
<div class="image-wide-block image-wide">
    <? if (0 && is_user_logged_in()): ?>
    <a data-id="<? the_ID() ?>" href="#" class="zmdi zmdi-download action-save action-save--top"></a>
    <? endif ?>
    <a href="<? the_permalink() ?>" style="background-image: url(<? the_post_thumbnail_url('post') ?>)" class="article-block__image"></a>

    <div class="block-bottom">
        <? get_template_part('templates/post', 'meta') ?>
    </div>

</div>
