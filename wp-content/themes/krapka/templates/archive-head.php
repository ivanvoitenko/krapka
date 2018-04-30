<?php global $queried_object, $queried_object_id; ?>
<div class="row" style="padding-bottom: 10px;">
  <div class="expert-opinion-tags-block visible-md visible-lg">
      <? if ((!$queried_object->parent || !is_category())):
          $tags = get_field('актуальные_теги', 'option');
          if ($tags): ?>
          <span class="tags-block-title">Актуальные тэги: </span>
          <ul class="actual-tags">
              <? foreach($tags as $tag): ?>
                  <li><a href="<?= get_term_link($tag) ?>">#<?= $tag->name ?></a></li>
              <? endforeach ?>
          </ul>
          <? endif ?>
      <? else: ?>
          <a href="<?= get_term_link(1)?>" class="cat-block <?= $queried_object->parent == 1 ? 'active' : '' ?>">Экспертная оценка</a>
          <a href="<?= get_term_link(2)?>" class="cat-block <?= $queried_object->parent == 2 ? 'active' : '' ?>">Расследования</a>
          <?php if(0): ?>
             <a href="#" class="cat-block">Антиштраф</a>
             <a href="#" class="cat-block">Анализ работы судьи</a>
          <?php endif;?>
      <? endif ?>
      <div class="expert-opinion-right-tags">
          <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle sort" data-toggle="dropdown">Сортировать по... <span class="caret"></span></button>
              <ul class="dropdown-menu" role="menu">
                  <li><a href="<?= get_term_link($queried_object_id) ?>">Последним новостям</a></li>
                  <li><a href="<?= site_url(get_term_link($queried_object_id) . '?sortby=popular') ?>">Популярным новостям</a></li>
              </ul>
          </div>

          <?php if (0) : // hidden tags menu ?>
            <div class="btn-group">
                <a href="#" class="btn btn-default dropdown-toggle tags" data-toggle="dropdown">#Теги <span class="caret"></span></a>
                <ul class="dropdown-menu dropdown-tags" role="menu">
                    <? foreach(get_tags() as $tag): ?>
                        <li class="col-md-6 col-xs-12"><a href="<?= get_term_link($tag) ?>"><?= $tag->name ?></a></li>
                    <? endforeach ?>
                </ul>
            </div>
          <?php endif; // end hidden tags menu ?>
      </div>
  </div>
  <div class="expert-opinion-tags-block visible-sm visible-xs">
      <div class="text-center">
          <span>Сначала популярные</span>

          <div class="onoffswitch">
              <input <?= isset($_GET['sortby']) ? 'checked' : '' ?> onchange="if (this.checked) window.location.href = '<?= site_url(get_term_link($queried_object_id) . '?sortby=popular') ?>'; else window.location.href = '<?= get_term_link($queried_object_id) ?>'" type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="sort-popular">
              <label class="onoffswitch-label" for="sort-popular"></label>
          </div>
      </div>
  </div>
</div>
