<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Ankit Mahajan 
 */

class Login_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', 'login/index');
		$this->assertContains('<title>News Portal: Login</title>', $output);
	}

	public function test_method_404()
	{
		$this->request('GET', 'login/method_not_exist');
		$this->assertResponseCode(404);
	}
	// Check no direct access to dashboard
	public function test_logout_no_direct_access()
	{
		$this->request('GET', 'login/logout');
		$this->assertResponseCode(302);
		
	}
	

}
