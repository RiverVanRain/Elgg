<?php

namespace Elgg\Groups\Actions\Membership;

use Elgg\ActionResponseTestCase;

class InviteTest extends ActionResponseTestCase {
	
	/**
	 * @var \ElggGroup
	 */
	protected $group;
	
	/**
	 * @var \ElggUser
	 */
	protected $user;
	
	public function up() {
		parent::up();
		
		$this->group = $this->createGroup();
		$this->user = $this->createUser();
		elgg_get_session()->setLoggedInUser($this->group->getOwnerEntity());
	}
	
	public function down() {
		// make sure no system/error messages are left behind
		_elgg_services()->system_messages->dumpRegister();
	}
	
	public function testLoggedInUserRequired() {
		elgg_get_session()->removeLoggedInUser();
		
		$this->expectException(\Elgg\Exceptions\Http\Gatekeeper\LoggedInGatekeeperException::class);
		$this->executeAction('groups/invite');
	}
	
	public function testNoUsersProvided() {
		$response = $this->executeAction('groups/invite');
		
		$this->assertInstanceOf(\Elgg\Http\ErrorResponse::class, $response);
		$this->assertEquals(elgg_echo('error:missing_data'), $response->getContent());
	}
	
	public function testNoGroupProvided() {
		$response = $this->executeAction('groups/invite', [
			'user_guid' => $this->user->guid,
		]);
		
		$this->assertInstanceOf(\Elgg\Http\ErrorResponse::class, $response);
		$this->assertEquals(elgg_echo('actionunauthorized'), $response->getContent());
	}
	
	public function testNormalUserTriesInvite() {
		elgg_get_session()->setLoggedInUser($this->user);
		
		$response = $this->executeAction('groups/invite', [
			'user_guid' => $this->user->guid,
			'group_guid' => $this->group->guid,
		]);
		
		$this->assertInstanceOf(\Elgg\Http\ErrorResponse::class, $response);
		$this->assertEquals(elgg_echo('actionunauthorized'), $response->getContent());
	}
	
	public function testNonUserGuidProvided() {
		$response = $this->executeAction('groups/invite', [
			'user_guid' => $this->group->guid,
			'group_guid' => $this->group->guid,
		]);
		
		$this->assertInstanceOf(\Elgg\Http\OkResponse::class, $response);
		
		$system_messages = _elgg_services()->system_messages->dumpRegister();
		$this->assertIsArray($system_messages);
		$this->assertArrayNotHasKey('success', $system_messages);
		$this->assertArrayNotHasKey('error', $system_messages);
	}
	
	public function testAlreadyInvitedUser() {
		$this->group->addRelationship($this->user->guid, 'invited');
		
		$response = $this->executeAction('groups/invite', [
			'user_guid' => $this->user->guid,
			'group_guid' => $this->group->guid,
		]);
		
		$this->assertInstanceOf(\Elgg\Http\OkResponse::class, $response);
		
		$system_messages = _elgg_services()->system_messages->dumpRegister();
		$this->assertIsArray($system_messages);
		$this->assertArrayHasKey('error', $system_messages);
		$this->assertContains(elgg_echo('groups:useralreadyinvited'), $system_messages['error']);
	}
	
	public function testAlreadyInvitedUserWithResendInvite() {
		$this->group->addRelationship($this->user->guid, 'invited');
		
		$response = $this->executeAction('groups/invite', [
			'user_guid' => $this->user->guid,
			'group_guid' => $this->group->guid,
			'resend' => 1,
		]);
		
		$this->assertInstanceOf(\Elgg\Http\OkResponse::class, $response);
		
		$system_messages = _elgg_services()->system_messages->dumpRegister();
		$this->assertIsArray($system_messages);
		$this->assertArrayHasKey('success', $system_messages);
		$this->assertContains(elgg_echo('groups:userinvited'), $system_messages['success']);
	}
	
	public function testInviteGroupMember() {
		$this->group->join($this->user);
		
		$response = $this->executeAction('groups/invite', [
			'user_guid' => $this->user->guid,
			'group_guid' => $this->group->guid,
		]);
		
		$this->assertInstanceOf(\Elgg\Http\OkResponse::class, $response);
		
		$system_messages = _elgg_services()->system_messages->dumpRegister();
		$this->assertIsArray($system_messages);
		$this->assertArrayNotHasKey('success', $system_messages);
		$this->assertArrayNotHasKey('error', $system_messages);
	}
	
	public function testInviteUser() {
		$this->assertFalse(check_entity_relationship($this->group->guid, 'invited', $this->user->guid));
		
		$response = $this->executeAction('groups/invite', [
			'user_guid' => $this->user->guid,
			'group_guid' => $this->group->guid,
		]);
		
		$this->assertInstanceOf(\Elgg\Http\OkResponse::class, $response);
		
		$system_messages = _elgg_services()->system_messages->dumpRegister();
		$this->assertIsArray($system_messages);
		$this->assertArrayHasKey('success', $system_messages);
		$this->assertContains(elgg_echo('groups:userinvited'), $system_messages['success']);
		
		$this->assertNotFalse(check_entity_relationship($this->group->guid, 'invited', $this->user->guid));
	}
}
