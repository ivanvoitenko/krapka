<div class="row">
    <?
    $current_post_index_item = 0;

    $parent_term = get_category(wp_get_post_categories(get_the_ID())[0]);
    $term_children = get_term_children($parent_term, $parent_term->taxonomy);

    foreach(get_posts([
        'posts_per_page' => 5,
        'post__not_in' => [get_the_ID()],
        'tax_query' => [
            [
                'taxonomy' => $parent_term->taxonomy,
                'field' => 'id',
                'terms' => $term_children,
                'operator' => 'IN',
            ]
        ]
    ]) as $post) {
        setup_postdata($post);
        $current_post_index_item++;
        get_template_part('templates/grid', '3x2');
    }
    wp_reset_postdata();
    ?>
</div>
