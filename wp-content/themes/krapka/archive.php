<?php
  $queried_object = get_queried_object();
  $queried_object_id = get_queried_object_id();
  $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

  $slugs = [];

  if (is_category() && !$queried_object->parent) {
      foreach (get_term_children($queried_object_id, 'category') as $cat) {
          $cat = get_category($cat);
          $slugs[] = $cat->slug;
      }
  } else {
      $slugs[] = $queried_object->slug;
  }

  switch ($queried_object_id) {
    case 1:
      $grid = '1x3';
      $posts_per_page = 7;
      break;
    case 2:
      $grid = '2';
      $posts_per_page = 8;
      break;
    default:
      $grid = '3';
      $posts_per_page = 9;
  }

  $wp_query = new WP_Query(
    array(
      'post_type'     => 'post',
      'paged'         => $paged,
      'posts_per_page' => $posts_per_page,
      'orderby' => isset($_GET['sortby']) ? "post_views" : '',
      'category_name' => is_category() ? join(',', $slugs) : '',
      'tag' => is_tag() ? join(',', $slugs) : ''
    )
  );
?>

<div class="<?= $queried_object->parent ? 'topic-page-section exp' : 'exp' ?>">
    <div class="container">
        <? get_template_part('templates/archive', 'head') ?>
        <div class="row">
            <?php
              if ($wp_query->have_posts()) :
                while ($wp_query->have_posts()) : $wp_query->the_post();

                  get_template_part('templates/grid', $grid);

                endwhile;
              endif;
              //wp_reset_query();
            ?>
        </div>

      <?php if (is_category() || is_tag()) { get_template_part('templates/pagination');} ?>
    </div>
</div>
