<? use Roots\Sage\Assets; ?>

<div class="page-section">
    <div class="expert">
        <div class="container">
            <div class="row">
                <div class="Label">эксперты</div>
                <?
                  $current_post_index = 0;
                  $parent_term = get_category(1);
                  $term_children = get_term_children($parent_term, $parent_term->taxonomy);

                  $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                  $args = array(
                    'posts_per_page' => 8,
                    'paged'          => $paged,
                    'tax_query' => [
                      [
                        'taxonomy' => $parent_term->taxonomy,
                        'field' => 'id',
                        'terms' => $term_children,
                        'operator' => 'IN',
                      ]
                    ]
                  );

                  $wp_query = new WP_Query( $args );

                  if ($wp_query->have_posts()) :
                    while ($wp_query->have_posts()) : $wp_query->the_post();

                      $current_post_index++;

                      get_template_part('templates/grid', '3x5');

                    endwhile;
                  endif;
                  wp_reset_query();
                ?>
            </div>
            <div class="spacer-30 hidden-xs hidden-sm"></div>
            <div class="spacer-10 visible-xs visible-sm"></div>
            <? if(get_field('enable_front_banner') && $p = get_field('front_banner_post')): ?>
        </div>
        <div class="container">
            <div class="row">
                <div class="Label">Важно!</div>
                <div class="hot-section col-md-12 col-sm-12 col-xs-12">
                    <div class="out-container large-block-col-12">
                        <div class="block">
                            <? if (0 && is_user_logged_in()): ?>
                                <a data-id="<?= $p->ID ?>" href=""><i class="zmdi zmdi-download action-save action-save--top"></i></a>
                            <? endif ?>
                            <div class="time time-center">
                                <i class="zmdi zmdi-time"></i> <? human_time($p) ?>
                            </div>
                            <div class="col-md-offset-2 col-md-8">
                                <a href="<? the_permalink($p) ?>" class="block-header">
                                    <?= get_the_title($p) ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="spacer-30 hidden-xs hidden-sm"></div>
            <div class="spacer-20 visible-xs visible-sm"></div>
            <? wp_reset_postdata(); endif ?>
        </div>
        <div class="container">
            <div class="row">

                <?
                $current_post_index = 0;
                $parent_term = get_category(2);
                $term_children = get_term_children($parent_term, $parent_term->taxonomy);

                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $args = array(
                  'posts_per_page' => 2,
                  'paged'          => $paged,
                  'tax_query' => [
                    [
                      'taxonomy' => $parent_term->taxonomy,
                      'field' => 'id',
                      'terms' => $term_children,
                      'operator' => 'IN',
                    ]
                  ]
                );

                 $wp_query = new WP_Query( $args );
                ?>

                <div class="Label"><?= $parent_term->name ?></div>

                <?
                  if ($wp_query->have_posts()) :
                    while ($wp_query->have_posts()) : $wp_query->the_post();

                      $current_post_index++;

                      get_template_part('templates/grid', '2');

                    endwhile;
                  endif;
                  wp_reset_query();
                ?>
            </div>
            <div class="spacer-30 hidden-xs hidden-sm"></div>
            <div class="spacer-10 visible-xs visible-sm"></div>

          <?php if(0): ?>
            <div class="row author-row">
                <div class="Label" style="display: none;">эксперты</div>
                <?
                $args = [
                    'role__in' => 'Editor', 'Author',
                    'number' => 5,
                    'meta_key' => 'отобразить_на_главной',
                    'meta_value' => 1
                ];

                foreach(get_users($args) as $authordata) { ?>
                    <div class="col-md-4 col-xs-12">
                        <? get_template_part('templates/author', 'entry') ?>
                    </div>
                <? } ?>

                <div class="col-md-4 col-xs-12">
                    <div class="moreExperts image-wide">
                        <div class="block">
                            <a href="<? the_permalink(11) ?>" class="block-header">
                                Все эксперты KRAPKA.club
                            </a>
                            <a href="<? the_permalink(11) ?>" class="experts">
                                <i class="zmdi zmdi-face"></i> Нас уже 125 человек
                            </a>
                        </div>
                    </div>
                </div>

            </div>
          <?php endif; // endif 0 ?>

        </div>

        <?php if(0): ?>
            <div class="spacer-30"></div>
            <div class="container">
                <div class="row">
                    <div class="Label">О проекте</div>
                    <div class="col-md-12 out-row">
                        <div class="large-block-col-12">

                            <div class="block">
                                <div class="spacer-30 visible-xs visible-sm"></div>
                                <div class="col-md-offset-2 col-md-8">
                                    <div class="block-header">Мы рассказываем правду</div>
                                    <p class="block-description">
                                        А еще мы не принадлежим ни к каким партиям и ассоциациям, поэтому существуем на ваши пожертвования для того, чтобы поддерживать сайт.
                                    </p>
                                    <? get_template_part('templates/donation-btn') ?>
                                </div>
                                <div class="spacer-30 visible-xs visible-sm"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; // endif 0 ?>

    </div>
</div>
