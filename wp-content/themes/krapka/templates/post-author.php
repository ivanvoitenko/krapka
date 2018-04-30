<?php if ( class_exists( 'coauthors_plus' ) ) :
  $co_authors = get_coauthors();

  foreach ( $co_authors as $key => $co_author ) :
    $co_author_classes = array(
      'author',
      'co-author-number-' . ( $key + 1 ),
    ); ?>

    <div class="<?php echo implode( ' ', $co_author_classes ); ?>" style="margin-bottom: 4px;">
      <a href="<?php echo get_author_posts_url( $co_author->ID ); ?>">
        <span class="img"><?php echo get_wp_user_avatar($co_author->ID, 'thumbnail'); ?></span>
        <span class="name"><?php echo $co_author->display_name; ?></span>
      </a>
    </div>

  <?php endforeach; else : ?>

  <div class="author">
    <a href="<? author_url() ?>">
      <span class="img">
          <?= get_wp_user_avatar("", 'thumbnail') ?>
      </span>
      <span class="name"><? the_author() ?></span>
    </a>
  </div>

<?php endif;?>
