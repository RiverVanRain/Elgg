<?php

namespace Elgg\GarbageCollector;

/**
 * Garbagecollector cron job
 */
class CronRunner {

	/**
	 * Garbagecollector cron job
	 *
	 * @param \Elgg\Event $event event
	 *
	 * @return void
	 */
	public function __invoke(\Elgg\Event $event): void {
		$period = $event->getType();
		if ($period !== elgg_get_plugin_setting('period', 'garbagecollector')) {
			return;
		}
		
		/* @var $cron_logger \Elgg\Logger\Cron */
		$cron_logger = $event->getParam('logger');
		
		// Now, because we are nice, trigger an event to let other plugins do some GC
		$params = $event->getParams();
		$params['period'] = $period;
		elgg_trigger_event_results('gc', 'system', $params);
		
		// optimize database tables
		$instance = GarbageCollector::instance();
		$instance->setLogger($cron_logger);
		
		$instance->optimize(true);
	}
}
