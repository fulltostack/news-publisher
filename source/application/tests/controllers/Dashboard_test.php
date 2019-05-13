<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Ankit Mahajan 
 */

class Dashboard_test extends TestCase
{

	public function test_method_404()
	{
		$this->request('GET', 'Dashboard/method_not_exist');
		$this->assertResponseCode(404);
	}

	// Check no direct access to dashboard
	public function test_dashboard_no_direct_access()
	{
		$this->request('GET', 'Dashboard/index');
		$this->assertResponseCode(302);

		$this->request('GET', 'Dashboard/addNews');
		$this->assertResponseCode(302);

		$this->request('GET', 'Dashboard/publishNews');
		$this->assertResponseCode(302);

		$this->request('GET', 'Dashboard/deleteNews');
		$this->assertResponseCode(302);
		
	}

}
