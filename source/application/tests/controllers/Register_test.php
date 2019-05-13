<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Ankit Mahajan 
 */

class Register_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', 'Register/index/');
		$this->assertContains('The Encrypt library requires the Mcrypt extension.', $output);
	}

	public function test_method_404()
	{
		$this->request('GET', 'Register/method_not_exist');
		$this->assertResponseCode(404);
	}

}
