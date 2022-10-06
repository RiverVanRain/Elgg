<?php

namespace Elgg\Menus;

use Elgg\Menu\MenuItems;

/**
 * Register menu items to the topbar menu
 *
 * @since 4.0
 * @internal
 */
class Topbar {
	
	/**
	 * Register menu items for the topbar menu
	 *
	 * @param \Elgg\Event $event 'register', 'menu:topbar'
	 *
	 * @return void|MenuItems
	 */
	public static function registerUserLinks(\Elgg\Event $event) {
		$user = elgg_get_logged_in_user_entity();
		if (!$user instanceof \ElggUser) {
			return;
		}
		
		/* @var $return MenuItems */
		$return = $event->getValue();
		
		$return[] = \ElggMenuItem::factory([
			'name' => 'account',
			'icon' => elgg_view('output/img', [
				'src' => $user->getIconURL('small'),
				'alt' => $user->getDisplayName(),
			]),
			'text' => elgg_echo('account'),
			'href' => false,
			'link_class' => 'elgg-avatar-small',
			'icon_alt' => 'angle-down',
			'priority' => 800,
			'section' => 'alt',
		]);
		
		$return[] = \ElggMenuItem::factory([
			'name' => 'usersettings',
			'icon' => 'sliders-h',
			'text' => elgg_echo('settings'),
			'href' => elgg_generate_url('settings:account', [
				'username' => $user->username,
			]),
			'priority' => 300,
			'section' => 'alt',
			'parent_name' => 'account',
		]);
		
		if ($user->isAdmin()) {
			$return[] = \ElggMenuItem::factory([
				'name' => 'administration',
				'icon' => 'cogs',
				'text' => elgg_echo('admin'),
				'href' => 'admin',
				'priority' => 800,
				'section' => 'alt',
				'parent_name' => 'account',
			]);
		}
		
		$return[] = \ElggMenuItem::factory([
			'name' => 'logout',
			'icon' => 'sign-out-alt',
			'text' => elgg_echo('logout'),
			'href' => elgg_generate_action_url('logout'),
			'priority' => 900,
			'section' => 'alt',
			'parent_name' => 'account',
		]);
		
		return $return;
	}
	
	/**
	 * Register a link to the maintenance page
	 *
	 * @param \Elgg\Event $event 'register', 'menu:topbar'
	 *
	 * @return void|MenuItems
	 */
	public static function registerMaintenance(\Elgg\Event $event) {
		if (!elgg_is_admin_logged_in() || !_elgg_services()->config->elgg_maintenance_mode) {
			return;
		}
		
		/* @var $return MenuItems */
		$return = $event->getValue();
		
		$return[] = \ElggMenuItem::factory( [
			'name' => 'maintenance_mode',
			'icon' => 'wrench',
			'text' => elgg_echo('admin:maintenance_mode:indicator_menu_item'),
			'href' => 'admin/configure_utilities/maintenance',
			'priority' => 900,
		]);
		
		return $return;
	}
	
	/**
	 * Register a action to logout out as the temporarily logged in user
	 *
	 * @param \Elgg\Event $event 'register', 'menu:topbar'
	 *
	 * @return void|MenuItems
	 */
	public static function registerLogoutAs(\Elgg\Event $event) {
		$original_user_guid = elgg_get_session()->get('login_as_original_user_guid');
		
		// quick return if not logged in as someone else.
		if (!$original_user_guid) {
			return;
		}
		
		$original_user = get_user($original_user_guid);
		if (!$original_user instanceof \ElggUser) {
			return;
		}
		
		$icon = elgg_view('output/img', [
			'src' => $original_user->getIconURL(['size' => 'tiny']),
			'alt' => 'original user photo',
		]);
		$icon = elgg_format_element('span', ['class' => ['elgg-avatar', 'elgg-avatar-tiny', 'elgg-anchor-icon']], $icon);
		
		$menu = $event->getValue();
		
		$menu[] = \ElggMenuItem::factory([
			'name' => 'logout_as',
			'icon' => $icon,
			'text' => elgg_echo('action:user:logout_as', [$original_user->getDisplayName()]),
			'href' => elgg_generate_action_url('admin/user/logout_as'),
			'link_class' => 'login-as-topbar',
			'priority' => -100, // make sure it is the first
			'section' => 'alt',
			'parent_name' => 'account',
		]);
		
		return $menu;
	}
}
