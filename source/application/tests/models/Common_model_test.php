<?php

class Common_model_test extends TestCase
{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('Common_model');
        $this->obj = $this->CI->Common_model;

        //fake data
        $this->first_name = "testunitcase_fname";
        $this->last_name = "testunitcase_lname";
        $this->email = "testunitcase_email_xyz@mailinator.com";
        $this->password = "123456";
        $this->password_encoded = "e10adc3949ba59abbe56e057f20f883e";
        $this->wrong_email = "testunitcase_email_xyz+test#again@mailinator.com";
        $this->user_id = 0;
        $this->slug = "test-unitcase-article";
        $this->title = "Test Unit Case Title";
        $this->text = "Test Text content...";

    }

    public function test_user_registration()
    {
    	$fakeData = array("first_name" => $this->first_name,
    					 "last_name" => $this->last_name,
    					 "email" => $this->email,
    					 "password" => $this->password_encoded,
    					 "created_date" => date("Y-m-d H:i:s"),
    					 "email_verify" => 1);

        $user_id = $this->obj->register($fakeData);
        $this->user_id = $user_id;
        $this->assertGreaterThan(0, $user_id);
    }

    public function test_login_successfull()
    {
        $expected = true;
        $email = $this->email;
        $password = $this->password;
        $response = $this->obj->login($email, $password);
        $this->assertEquals($expected, $response);
    }

    public function test_update_user()
    {
        $expected = true;
        $where = array("email" => $this->email);
        $data = array("first_name" => $this->first_name."xyz");
        $response = $this->obj->updateUser($where, $data);
        $this->assertEquals($expected, $response);
    }

    public function test_get_user()
    {
        $expected = 1;
        $where = array("email" => $this->email);
        $response = $this->obj->getUser($where);
        $this->assertEquals($expected, count($response));
    }

    public function test_delete_user()
    {
        $expected = true;
        $response = $this->obj->deleteUser($this->email);
        $this->assertEquals($expected, $response);
    }

    public function test_addnews()
    {
        $fakeData = array("slug" => $this->slug, 
                    "title" => $this->title,
                    "text" => $this->text,
                    "user_id" => $this->user_id,
                    "status" => 1,
                    "created_date" => date("Y-m-d H:i:s"), 
                    "photo" => ""); 

        $news_id = $this->obj->addNews($fakeData);
        $this->assertGreaterThan(0, $news_id);
    }

    public function test_get_news_list()
    {
        $expected = 0;
        
        $response = $this->obj->getLatestNewsList();
        $this->assertGreaterThan($expected, count($response));

        $response = $this->obj->getNewsBySlug($this->slug);
        $this->assertGreaterThan($expected, count($response));
    }


    public function test_update_news()
    {
        $expected = true;
        $where = array("slug" => $this->slug);
        $data = array("title" => $this->title."xxx",
                    "text" => $this->text."xxx");
        $response = $this->obj->updateNews($where, $data);
        $this->assertEquals($expected, $response);
    }

    public function test_delete_slug()
    {
        $expected = true;
        $response = $this->obj->deleteNewsBySlug($this->slug);
        $this->assertEquals($expected, $response);
    }
    
}