<form class="footer-bottom follow" style="justify-content: flex-start">
    <input type="hidden" name="action" value="subscribe">
    <div class="form-controls" style="margin-right: 15px">
        <input id="follow" name="email" class="input" type="text" placeholder="Введите ваш адрес...">
        <span class="error" style="display: none;">Пожалуйста, введите действительный адрес</span>
    </div>

    <a href="#" class="subscribe-btn but">Подписаться</a>

    <div class="tags-list">
        <div class="dropdown">
            <div class="dropdown-content dropdown-subscribe-content">
                <div class="content-header">
                    <p>Если вас интересует конкретная тема, отметьте ее в форме, и мы будем присылать актуальную для вас информацию.</p>
                    <div class="all-checkbox">
                        <div class="item">
                            <input value="<?= $term->term_id ?>" id="all-checkbox" class="main-checkbox uk-checkbox" type="checkbox">
                            <label for="all-checkbox">
                                <i class="zmdi zmdi-check"></i>
                            </label>
                            <span>Все</span>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="all-checkbox row">
                    <? foreach(get_tags(['posts_per_page' => -1]) as $term): ?>
                        <div class="item col-md-4 col-sm-6 col-xs-12">
                            <input name="email_tags[]" value="<?= $term->name ?>" id="all-checkbox-<?= $term->term_id ?>" class="uk-checkbox" type="checkbox">
                            <label for="all-checkbox-<?= $term->term_id ?>">
                                <i class="zmdi zmdi-check"></i>
                            </label>
                            <span><?= $term->name ?></span>
                        </div>
                    <? endforeach ?>
                </div>
                <a href="#" class="checkbox-but close-dropdown">Сохранить</a>
            </div>
        </div>
    </div>
</form>

