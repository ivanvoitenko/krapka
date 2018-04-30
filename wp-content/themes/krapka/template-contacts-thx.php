<?
/**
 * Template Name: Contacts Thx
 */
while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/page', 'header'); ?>
    <div class="about-page">
        <div class="container">
            <div class="contacts-thx-block">
                <div class="title">Ваше сообщение отправлено!</div>
                <p>Спасибо! Мы получили вашу информацию и свяжемся с вами в ближайшее время!</p>
                <a href="<?= home_url() ?>" class="back-home-link">Вернуться на главную</a>
            </div>
        </div>
    </div>
<?php endwhile; ?>
