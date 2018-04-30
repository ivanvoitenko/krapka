<?php
/**
 * Template Name: Donate Final
 */
?>

<div class="donate-page">
    <div class="container">

        <? if(function_exists('yoast_breadcrumb')) yoast_breadcrumb('<nav class="breadcrumb">', '</nav>') ?>

        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <h1>Пожертвования</h1>
                <div class="content">
                    <p>У нас есть штат сотрудников, которые обеспечивают жизнедеятельность проекта: технический и контент отдел. Для этого мы просим вашей помощи в виде пожертвований. Нам поможет любая сумма.</p>
                </div>
                <? get_template_part('templates/' . get_queried_object()->post_name) ?>
            </div>

        </div>



    </div>
</div>
