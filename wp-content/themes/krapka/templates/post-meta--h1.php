<div class="block-top">
    <?
    $cat = get_the_category()[0]  ?>
    <a class="cat" href="<?= get_term_link($cat) ?>"><?= $cat->name ?></a>
    <div class="time"><i class="zmdi zmdi-time"></i> <? human_time() ?></div>
</div>
<div class="block-center">
    <h1 class="article-head"><? the_title() ?></h1>
</div>
