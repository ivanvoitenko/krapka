<? use Roots\Sage\Assets; ?>

<div class="col-md-12 donate-stages">
    <div class="donate-stage-1-block">
        <h3>Я хочу пожертвовать</h3>
        <div class="donate-section">
            <div class="donate-block">
                <img src="<?= Assets\asset_path('images/donate-UAH20.png') ?>" alt="">
                <img class="active-img" src="<?= Assets\asset_path('images/donate-UAH20-active.png') ?>" alt="">
                <span class="value">20<i class="hidden-md hidden-lg"></i> грн</span>
            </div>
            <div class="donate-block">
                <img src="<?= Assets\asset_path('images/donate-UAH50.png') ?>" alt="">
                <img class="active-img" src="<?= Assets\asset_path('images/donate-UAH50-active.png') ?>" alt="">
                <span class="value">50<i class="hidden-md hidden-lg"></i> грн</span>
            </div>
            <div class="donate-block">
                <img src="<?= Assets\asset_path('images/donate-UAH100.png') ?>" alt="">
                <img class="active-img" src="<?= Assets\asset_path('images/donate-UAH100-active.png') ?>" alt="">
                <span class="value">100<i class="hidden-md hidden-lg"></i> грн</span>
            </div>
            <div class="donate-block">
                <img src="<?= Assets\asset_path('images/donate-anotherUAH.png') ?>" alt="">
                <img class="active-img" src="<?= Assets\asset_path('images/donate-anotherUAH-active.png') ?>" alt="">
                <span>другая<i class="hidden-md hidden-lg"></i> сумма</span>
            </div>
        </div>
        <form id="liqpay-form" method="POST" action="https://www.liqpay.com/api/3/checkout" accept-charset="utf-8">
            <input id="liqpay-data" type="hidden" name="data" value=""/>
            <input id="liqpay-sign" type="hidden" name="signature" value=""/>
            <button type="submit" disabled class="but">Пожертвовать</button>
        </form>

    </div>

</div>
					