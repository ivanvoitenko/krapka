<?
$number = 12;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $number;
$users = (['role__in' => 'Editor', 'Author', 'Subscriber']);
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
<div class="community-page">
    <div class="container">
        <div class="row">
            <?
            foreach($query->get_results() as $authordata): ?>
                <div class="user-item col-md-2 col-xs-6">
                    <div class="author-img"><?= get_wp_user_avatar('', 'thumbnail') ?></div>
                    <div class="h2"><? the_author() ?></div>
                </div>
            <? endforeach ?>
        </div>
        <div class="row">
            <?php wp_pagenavi( array( 'type' => 'users', 'query' => $query) ); ?>
        </div>
    </div>
</div>