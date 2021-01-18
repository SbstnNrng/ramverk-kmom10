<?php

namespace Seb\Profile;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Anax\Response\ResponseUtility;

/**
 * IpCheck test class.
 */
class ProfileTest extends TestCase
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

    public function testQuestionComments()
    {
        $profile = new Profile();
        $profile->setDb($this->di->get("dbqb"));
        $this->assertIsObject($profile);
    }

    public function testUpdateForm()
    {
        $profile = new Profile();
        $profile->setDb($this->di->get("dbqb"));
        $profileForm = new HTMLForm\UpdateForm($this->di, 2);
        $this->assertIsObject($profileForm);
    }

    public function testProfileController()
    {
        $profile = new Profile();
        $profile->setDb($this->di->get("dbqb"));
        $profileController = new ProfileController();
        $profileController->setDI($this->di);
        $session = $this->di->get("session");
        $session->set("acronym", null);
        $res = $profileController->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $session->set("acronym", "Olle");
        $res = $profileController->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $res = $profileController->updateAction(2);
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $profileController->logoutAction();
        $this->assertEquals($session->get("acronym"), null);
    }
}
