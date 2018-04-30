<div class="expert-opinion-tags-block out-container account-page__head">
    <a href="<? the_permalink(151) ?>" class="cat-block <? if(is_page('account')) echo 'active' ?>">
        Ваш профиль <i class="zmdi zmdi-caret-down hidden-md hidden-lg"></i>
    </a>
    <a href="<? the_permalink(153) ?>" class="cat-block <? if(is_page('saved-articles')) echo 'active' ?>">
        Сохраненные статьи <i class="zmdi zmdi-caret-down hidden-md hidden-lg"></i>
    </a>
    <a href="<? the_permalink(155) ?>" class="cat-block <? if(is_page('liked-articles')) echo 'active' ?>">
        Понравившиеся статьи <i class="zmdi zmdi-caret-down hidden-md hidden-lg"></i>
    </a>

    <? if (is_page(151)): ?>
        <div class="hidden-sm hidden-xs expert-opinion-right-tags orange">
            <a href="<?= get_permalink(161) ?>">
                <span>Редактировать <?= mb_strtolower(get_the_title()) ?></span>
                <i class="zmdi zmdi-edit"></i>
            </a>
        </div>
    <? else: ?>
        <div class="hidden-sm hidden-xs edit-save-posts expert-opinion-right-tags">
            <a href="#" class="edit-articles-but orange">
                <span>Редактировать <?= mb_strtolower(get_the_title()) ?></span>
                <i class="zmdi zmdi-edit"></i>
            </a>
            <div class="edit-secondary-but">
                <input id="checkAll" class="uk-checkbox" type="checkbox">
                <label class="check-all" for="checkAll"></label>
                <a class="check-all" href="#">Выделить все</a>
                <a href="#" class="remove-articles orange">
                    <i class="zmdi zmdi-delete"></i>
                    <span class="orange cancel-edit">Удалить</span>
                </a>
            </div>
        </div>
    <? endif ?>
</div>

<? if (is_page(151)): ?>
    <div class="hidden-md hidden-lg account-page__mobile-edit">
        <div class="spacer-10"></div>
        <a class="orange" href="<?= get_permalink(161) ?>">
            <span>Редактировать <?= mb_strtolower(get_the_title()) ?></span>
            <i class="zmdi zmdi-edit"></i>
        </a>
        <div class="spacer-20"></div>
    </div>
<? endif ?>

