<?
/**
 * Template Name: Contacts
 */
the_post();
get_template_part('templates/page', 'head'); ?>
<div class="page-section">
    <div class="contact-page">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="col-md-6 form-block">
                        <?= do_shortcode('[contact-form-7 id="82" title="Контакты"]') ?>
                    </div>
                    <div class="col-md-6 contact-block">
                        <? the_content() ?>
                    </div>
                </div>
            </div>
            <div class="spacer-30"></div>
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2541.2804084220875!2d30.535065365730862!3d50.43587742947331!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4cf07b074a259%3A0x5929bb4b0c53dd9c!2z0JHRltC30L3QtdGBLdGG0LXQvdGC0YAg0JHQsNGI0YLQsCDihJY1LCDQstGD0LvQuNGG0Y8g0KDQuNCx0LDQu9GM0YHRjNC60LAsIDIyLCDQmtC40ZfQsiwgMDIwMDA!5e0!3m2!1sru!2sua!4v1519593428438" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>

    </div>

</div>
<script>
    document.addEventListener( 'wpcf7mailsent', function( event ) {
        location = '<? the_permalink(117) ?>';
    }, false );
</script>
