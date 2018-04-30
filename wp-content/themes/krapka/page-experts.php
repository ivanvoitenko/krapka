<?
/**
 * Template Name: Experts
 */
$number = 12;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $number;
$users = (['role__in' => 'Editor', 'Author']);
$total_users = count($users);
$total_pages = intval($total_users / $number);
$args = [
    'role__in' => 'Editor', 'Author',
    'number'   => $number,
    'offset'   => $offset
];
$query = new WP_User_Query($args);
$total_query = count($query);
?>
<div class="page-section">
    <div class="container">
        <div class="row author-row">
            <?
            foreach($query->get_results() as $authordata): ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="author-item">
                        <div class="author-item-box">
                            <? get_template_part('templates/author', 'entry') ?>
                            <div class="expert-block-hover">
                                <div class="hover-parent-block">
                                    <div class="block-hover-title">
                                        <? the_author() ?>
                                    </div>
                                    <div class="orange-line"></div>
                                    <div class="block-hover-description">
                                        <?= $authordata->description ?>
                                    </div>
                                    <a class="read-more" href="<? author_url() ?>">Подробнее об эксперте <i class="zmdi zmdi-caret-right zmdi-hc-lg"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <? endforeach ?>

        </div>
        <div class="row">
            <?php wp_pagenavi( array( 'type' => 'users', 'query' => $query) ); ?>
        </div>
    </div>
</div>