<?php
$current_post_index = $wp_query->current_post;
$container_class = ( $current_post_index  === 0 ) ? 'col-md-12 section-picture' : 'col-md-4 col-sm-6 col-xs-12';
$container_class .= ' article';
?>

<div class="<?= $container_class ?>">
    <? if ($current_post_index  === 0) {
        global $with_author, $thumb;
        $thumb = 'full';
        $with_author = true;
        get_template_part('templates/post', 'fullwidth');
    } else {
        get_template_part('templates/post', 'top-image');
    } ?>
</div>
