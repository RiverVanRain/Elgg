<?php
/**
 * Returns content for the "popular" page
 */

$content = elgg_list_entities_from_relationship_count([
	'type' => 'user',
	'relationship' => 'friend',
	'inverse_relationship' => false,
]);

$title = elgg_echo('members:title:popular');

$body = elgg_view_layout('default', [
	'content' => $content,
	'sidebar' => elgg_view('members/sidebar'),
	'title' => $title,
	'filter_id' => 'members',
]);

echo elgg_view_page($title, $body);
