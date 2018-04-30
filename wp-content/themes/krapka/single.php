<?
the_post();
?>
<div class="expert-opinion-page" style="padding-bottom: 0">
    <div class="expert">
        <? if(get_field('отобразить_обложку')): ?>
        <div id="section-collapse" class="section-1 section-picture expert-header panel-collapse collapse in" style="background-image: url(<? the_field('обложка') ?>)">
            <div class="container">
                <? if (function_exists('yoast_breadcrumb')) { yoast_breadcrumb('<nav class="breadcrumb">', '</nav>'); } ?>
                <div class="row">
                    <? if (0 && is_user_logged_in()): ?>
                    <a data-id="<? the_ID() ?>" class="action-save" href=""><i class="zmdi zmdi-download"></i></a>
                    <? endif ?>
                    <div class="col-md-7 col-xs-12 block">

                        <? get_template_part('templates/post', 'meta--h1') ?>

                        <div class="block-bottom">
                            <? get_template_part('templates/post', 'author') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="spacer-30 visible-lg visible-md"></div>
        <div class="spacer-10 visible-sm visible-xs"></div>
        <? endif ?>
        <div class="container article-content">
            <? if(!get_field('отобразить_обложку')): ?>
                <?  if (function_exists('yoast_breadcrumb')) { yoast_breadcrumb('<nav class="breadcrumb space-10">', '</nav>'); } ?>
            <? endif ?>
            <div class="row">

              <?php $content = get_the_content();
                $is_auto_generate_toc = get_field('is_auto_generate_toc');
                $pattern =  $is_auto_generate_toc ?
                  '@<h2([^>]*)>(<a[^>]*>)?([^<]*)(</a>)?</h2>@' :
                  '@<h2([^>]*)><a[^>]*>(.*)</a></h2>@';

                if ( $if_sidebar = preg_match_all($pattern, $content, $matches)) : ?>
                <div class="col-md-4 visible-md visible-lg">
                    <div class="sidebar">
                        <h3 class="sidebar-title">Содержание</h3>
                        <ol class="sidebar-text">
                            <?
                                $headers = $is_auto_generate_toc ? $matches[3] : $matches[2];

                                foreach($headers as $key => $zag) { ?>
                                    <li><a href="#title-<?= $key ?>"><?= $zag ?></a></li>
                                <?
                                    $content = preg_replace('@'. preg_quote($matches[0][$key]).'@', '<h2 id="title-' . $key . '"' . $matches[1][$key] . '>'.$zag.'</h2>', $content);
                                }
                            ?>
                        </ol>
                    </div>
                </div>
                <?php endif; ?>

                  <div class="col-md-8 <?php echo $if_sidebar ? '' : 'col-md-offset-2'?>">
                    <? if(!get_field('отобразить_обложку')) { ?>
                        <div class="article-header article-without-bg">
                            <div class="block">

                                <? get_template_part('templates/post', 'meta--h1') ?>

                                <div class="block-bottom">
                                    <? get_template_part('templates/post', 'author') ?>
                                </div>
                            </div>
                        </div>
                    <? } ?>
                    <div class="article-text">
                        <?= apply_filters('the_content', $content) ?>
                        <div class="tags">
                            <style>
                              .tags a {
                                display: inline-block;
                                margin: 0 8px 4px 0;
                                padding: 4px 8px;
                                border: 1px solid;
                                font-size: 12px;
                                line-height: 1.33;
                                text-transform: uppercase;
                              }
                            </style>
                            <?php the_tags('<span style="display: inline-block; margin-right: 8px; font-size: 13px; text-transform: uppercase">Метки:</span>', '' ,''); ?>
                            <div class="spacer-30"></div>
                        </div
                    </div>



                    <div class="article-bottom">
                        <hr>
                        <? get_template_part('templates/post', 'author') ?>
                        <div class="social">
                            <a data-social="facebook" href="#">
                                <i class="zmdi zmdi-facebook"></i>
                                <span data-counter="facebook">0</span>
                            </a>
                            <a href="#" data-social="twitter">
                                <i class="zmdi zmdi-twitter"></i>
                                <span data-counter="twitter">0</span>
                            </a>
                            <a class="hidden-sm hidden-xs" href="<? the_permalink(15) ?>">
                                <i class="zmdi zmdi-email"></i>
                                <span> Прислать информацию</span>
                            </a>
                            <? if(0 && is_user_logged_in()): ?>
                            <a data-id="<? the_ID() ?>" href="#" class="action-save">
                                <i class="zmdi zmdi-download"></i>
                                <span>Сохранить</span>
                            </a>
                            <a data-id="<? the_ID() ?>" class="action-favorite" href="#">
                                <i class="zmdi zmdi-favorite"></i>
                                <span>Понравилось</span>
                            </a>
                            <? endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-8 <?php echo $if_sidebar ? 'col-md-offset-4' : 'col-md-offset-2'?>">
                <?php if (0) : ?>
                    <div class="comments">
                        <div class="comments-header">
                            <i class="zmdi zmdi-comments"></i>
                            Комментарии
                        </div>
                        <div class="comments-area">
                            <div class="fb-comments" data-href="<?= esc_url(get_permalink()) ?>" data-width="100%" data-numposts="10"></div>
                        </div>
                    </div>
                <?php endif; ?>
                </div>
            </div>

            <?php if(0) : ?>
                <div class="row">
                    <div class="col-md-8 <?php echo $if_sidebar ? 'col-md-offset-4' : 'col-md-offset-2'?>">
                        <div class="donate">
                            <div class="block">
                                <div class="block-header">Участвуйте в развитии проекта</div>
                                <p class="block-description">
                                    Хотите нам помочь? Присылайте свои пожертвования! <span class="orange">Узнать больше <i class="zmdi zmdi-chevron-right"></i></span>
                                </p>
                                <? get_template_part('templates/donation-btn') ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="spacer-30 visible-lg visible-md"></div>
            <div class="spacer-10 visible-sm visible-xs"></div>
           <div class="features-posts">
               <? get_template_part('templates/featured') ?>
           </div>

          <div class="spacer-30 visible-lg visible-md"></div>
          <div class="spacer-10 visible-sm visible-xs"></div>
        </div>
    </div>
</div>
