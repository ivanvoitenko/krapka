<div class="fullwidth image-wide-block image-wide">

    <a href="<? the_permalink() ?>" style="background-image: url(<? the_post_thumbnail_url('full') ?>)" class="article-block__image"></a>

    <div class="block">
        <div class="col-md-7">
            <div class="block-bottom">
                <?
                get_template_part('templates/post', 'meta');
                get_template_part('templates/post', 'author');
                ?>
            </div>
        </div>
    </div>
</div>
