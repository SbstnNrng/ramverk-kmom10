<?php

namespace Seb\User;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Anax\Response\ResponseUtility;

/**
 * IpCheck test class.
 */
class UserTest extends TestCase
{
    protected $di;

    protected function setUp()
    {
        global $di;

        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $this->di = $di;
    }

    public function testUser()
    {
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $this->assertIsObject($user);
        $user->setPassword("hej");
        $this->assertIsBool($user->verifyPassword("hej", "hej"));
    }

    public function testCreateUserForm()
    {
        $userForm = new HTMLForm\CreateUserForm($this->di);
        $this->assertIsObject($userForm);
    }

    public function testUserLoginForm()
    {
        $userForm = new HTMLForm\UserLoginForm($this->di);
        $this->assertIsObject($userForm);
    }

    public function testUserController()
    {
        $userController = new UserController();
        $userController->setDI($this->di);
        $res = $userController->indexActionGet();
        $session = $this->di->get("session");
        $session->set("acronym", null);
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $res = $userController->loginAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $res = $userController->createAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    public function testUsersController()
    {
        $userController = new UsersController();
        $userController->setDI($this->di);
        $res = $userController->indexActionGet();
        $session = $this->di->get("session");
        $session->set("acronym", null);
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $res = $userController->historyAction("hej");
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $session->set("acronym", "hej");
        $res = $userController->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
