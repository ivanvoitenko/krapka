<?php
    global $article_class;
    $current_post_index = $wp_query->current_post;

    $container_class = 'col-md-4';

    if ($current_post_index <= 2) {
        $article_class = 'image-top  article-block';
    } else {
        $container_class = 'col-md-6';
    }

?>

<div class="<?= $container_class ?> col-xs-12">
    <? get_template_part('templates/post', $current_post_index <= 2 ? 'top-image' : 'with-bg'); ?>
</div>
<? if($current_post_index == 7) echo '</div>' ?>

