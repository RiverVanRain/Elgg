<?php
/**
 * Elgg custom index page
 *
 * You can edit the content of this page with your own layout and style.
 * Whatever you put in this view will appear on the front page of your site.
 */

if (elgg_is_logged_in()) {
	$title = elgg_echo('welcome:user', [elgg_get_logged_in_user_entity()->getDisplayName()]);
} else {
	$title = elgg_echo('welcome');
}

echo elgg_view_page($title, [
	'content' => elgg_view('custom_index/content', $vars),
	'sidebar' => false,
]);
