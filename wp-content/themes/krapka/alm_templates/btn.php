<? global $repeater ?>
<div class="<?= $repeater != 'template_2' ? 'col-md-4' : 'col-md-6' ?> col-sm-12 col-xs-12">
    <div class="moreExperts image-wide">
        <div class="block">
            <img class="img" src="<?= \Roots\Sage\Assets\asset_path('images/more-icon.svg') ?>">
            <button id="loadmore" class="but"><i class="zmdi zmdi-format-valign-bottom"></i> Загрузить больше статей</button>
        </div>
    </div>
</div>