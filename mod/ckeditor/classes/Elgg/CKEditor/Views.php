<?php

namespace Elgg\CKEditor;

/**
 * Event callbacks for views
 *
 * @since 4.0
 * @internal
 */
class Views {

	/**
	 * Adds an ID to the view vars if not set
	 *
	 * @param \Elgg\Event $event 'view_vars', 'input/longtext'
	 *
	 * @return array
	 */
	public static function setInputLongTextIDViewVar(\Elgg\Event $event) {
		$vars = $event->getValue();
		$id = elgg_extract('id', $vars);
		if ($id !== null) {
			return;
		}
		
		// input/longtext view vars need to contain an id for editors to be initialized
		// random id generator is the same as in input/longtext
		$vars['id'] = 'elgg-input-' . base_convert(mt_rand(), 10, 36);
	
		return $vars;
	}
}
