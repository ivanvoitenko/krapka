<?php
/*
Plugin Name: Russian Date by Axelnsk
Description: Русские даты. Русские названия месяцев и дней недели для WordPress. Что бы не склонять названия месяцев используйте "--"
Version: 1.0
Author: Axelnsk
Author URI: https://vk.com/axelnsk
*/


function axel_russian_date($timedate = '') {
	if ( substr_count($timedate , '--') > 0 ) return str_replace('--', '', $timedate);

	$rus_date_array = array (
	"Январь" => "Января",
	"Февраль" => "Февраля",
	"Март" => "Марта",
	"Апрель" => "Апреля",
	"Май" => "Мая",
	"Июнь" => "Ииюня",
	"Июль" => "Июля",
	"Август" => "Августа",
	"Сентябрь" => "Сентября",
	"Октябрь" => "Октября",
	"Ноябрь" => "Ноября",
	"Декабрь" => "Декабря",
	"January" => "Января",
	"February" => "Февраля",
	"March" => "Марта",
	"April" => "Апреля",
	"May" => "Мая",
	"June" => "Июня",
	"July" => "Июля",
	"August" => "Августа",
	"September" => "Сентября",
	"October" => "Октября",
	"November" => "Ноября",
	"December" => "Декабря",
	"Sunday" => "Воскресенье",
	"Monday" => "Понедельник",
	"Tuesday" => "Вторник",
	"Wednesday" => "Среда",
	"Thursday" => "Четверг",
	"Friday" => "Пятница",
	"Saturday" => "Суббота",
	"Sun" => "Воскресенье",
	"Mon" => "Понедельник",
	"Tue" => "Вторник",
	"Wed" => "Среда",
	"Thu" => "Четверг",
	"Fri" => "Пятница",
	"Sat" => "Суббота",
	"th" => "",
	"st" => "",
	"nd" => "",
	"rd" => ""

	);
   	return strtr($timedate, $rus_date_array);
}

add_filter('the_time', 'axel_russian_date');
add_filter('get_the_time', 'axel_russian_date');
add_filter('the_date', 'axel_russian_date');
add_filter('get_the_date', 'axel_russian_date');
add_filter('the_modified_time', 'axel_russian_date');
add_filter('get_the_modified_date', 'axel_russian_date');
add_filter('get_post_time', 'axel_russian_date');
add_filter('get_comment_date', 'axel_russian_date');

