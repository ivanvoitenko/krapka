<div class="filled-profile-section exp topic-page-section">
    <div class="container">
        <? get_template_part('templates/account', 'head') ?>
        <div class="row profile-articles">

            <?
            $current_post_index_item = 0;

            $user_posts = get_user_meta(get_current_user_id(), '_posts_favorite', true);
            if ($user_posts) {
                foreach(get_posts([
                    'posts_per_page' => -1,
                    'post__in' => $user_posts

                ]) as $post) {
                    setup_postdata($post);
                    $current_post_index_item++;
                    get_template_part('templates/grid', '3');
                }
                wp_reset_postdata();
            } else { ?>
                <style>.expert-opinion-right-tags {display: none !important;}</style>
                <div class="col-md-offset-2 col-md-8 col-xs-12">
                    <div class="articles-empty">
                        <h2>Вы не сохранили ни одной статьи</h2>
                        <p>Сохраняйте статьи, чтобы прочитать их позже.</p>
                    </div>
                </div>
            <? } ?>
        </div>
    </div>
</div>
