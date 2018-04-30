<?php
  global $article_class;
  $current_post_index = $wp_query->current_post;
?>
<div class="<?= $article_class ?>">
    <div class="block">

        <? get_template_part('templates/post', 'meta') ?>

        <? if (($current_post_index < 3 || $current_post_index > 7) && !is_single() ): ?>
            <p class="block-description">
                <? the_excerpt() ?>
            </p>
        <? endif ?>

        <div class="block-bottom">
            <? get_template_part('templates/post', 'author') ?>
            <? if (0 && is_user_logged_in()): ?>
            <a data-id="<? the_ID() ?>" href="#"><i class="zmdi zmdi-download action-save"></i></a>
            <? endif ?>
        </div>
    </div>
</div>
