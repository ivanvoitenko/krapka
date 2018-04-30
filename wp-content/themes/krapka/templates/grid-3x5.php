<?
    global $article_class;
    $current_post_index = $wp_query->current_post;

    $container_class = 'col-md-4';

    if ($current_post_index <= 2) {
        $article_class = 'image-top h-550px article-block';
    } else if ($current_post_index == 3) {
        $container_class = 'col-md-5';
        $article_class = 'large-block';
    } else if ($current_post_index >= 4 && $current_post_index <= 5 ) {
        $container_class = 'col-md-6';
        $article_class = 'small-block-228px';
    } else if ($current_post_index >= 6 && $current_post_index <=7 ) {
        $container_class = 'col-md-6';
        $article_class = 'small-block-275px';
    }

?>
<? if($current_post_index == 4) echo '<div class="col-md-7 col-sm-12 reset-padding">' ?>
<div class="<?= $container_class ?> col-xs-12">
    <? get_template_part('templates/post', $current_post_index <= 2 ? 'top-image' : ''); ?>
</div>
<? if($current_post_index == 7) echo '</div>' ?>

