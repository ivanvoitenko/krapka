<div id="section-collapse" class="section-1 section-breadcrums panel-collapse collapse in">
    <div class="container">
        <? if(function_exists('yoast_breadcrumb')) yoast_breadcrumb('<nav class="breadcrumb breadcrumb-uk">', '</nav>') ?>
        <div class="row">
            <div class="col-md-12 expert-introduce">
                <div class="author-img"><?= get_wp_user_avatar('', 'thumbnail') ?></div>
                <h1><? the_author() ?></h1>
                <div class="specialization">
                    <span>Cпециализация: </span><div class="cat"><? the_field('специализация', $authordata) ?></div>
                </div>
                <div class="sub-title">
                    <?= get_the_author_meta('description', $authordata->ID) ?>
                    <span class="oval"></span>
                </div>
                <div class="social-icons">
                    <? foreach(['facebook', 'twitter', 'google'] as $key): ?>
                        <? if($link = esc_url( get_the_author_meta($key) )): ?>
                            <a href="<?= $link ?>"><i class="zmdi zmdi-<?= $key ?>"></i></a>
                        <? endif ?>

                    <? endforeach ?>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="expert-page">
    <div class="spacer-30"></div>
    <div class="container">
        <? if($desc = get_field('описание', $authordata)): ?>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="expert-about-block">
                    <?= apply_filters('the_content', $desc)  ?>
                </div>
            </div>
        </div>
        <? endif ?>
        <? if(have_rows('видео_с_автором', $authordata)): ?>
            <div class="row video-row">
                <div class="Label">Видео с экспертом</div>
                <? while(have_rows('видео_с_автором', $authordata)): the_row(); ?>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="video-article article-block image-top">
                            <? $data = get_sub_field('видео') ?>
                            <a href="<?= $data['url'] ?>" style="background-image: url(<?= $data['thumbnail'] ?>)" class="open-video article-block__image">
                                <span class="playtime"><? the_sub_field('длительность') ?></span>
                                <i class="zmdi zmdi-play"></i>
                            </a>
                            <div class="block">
                                <a href="<?= $data['url'] ?>" class="open-video block-header"><? the_sub_field('заголовок') ?></a>
                            </div>
                        </div>
                    </div>
                <? endwhile ?>
            </div>
        <? endif ?>

        <div class="row">
          <?php
            $current_post_index = 0;
            if (have_posts()) :
              while (have_posts()) : the_post(); ?>
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <?php if($current_post_index == 0): ?>
                    <div class="Label">эксперты</div>
                  <? endif ?>
                  <?php get_template_part('templates/post', 'top-image') ?>
                </div>
              <?php
                $current_post_index++;
              endwhile;
            endif;
          ?>
        </div>
      <?php get_template_part('templates/pagination'); ?>
      <div class="spacer-30"></div>
    </div>
</div>
