<?php

namespace Seb\Home;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Anax\Response\ResponseUtility;
use Seb\Questions\Questions;
use Seb\User\User;
use Seb\Tags\Tags;
use Seb\Home\HomeModel;

/**
 * IpCheck test class.
 */
class HomeTest extends TestCase
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

    public function testHomeModel()
    {
        $home = new HomeModel();
        $tags = new Tags();
        $tags->setDb($this->di->get("dbqb"));
        $questions = new Questions();
        $questions->setDb($this->di->get("dbqb"));
        $users = new User();
        $users->setDb($this->di->get("dbqb"));

        $recentTopics = $home->recentTopics($questions->findAll());
        $topUsers = $home->topUsers($users->findAll());
        $topTags = $home->topTags($tags->findAll(), $questions->findAll());
        $this->assertIsArray($recentTopics);
        $this->assertIsArray($topUsers);
        $this->assertIsArray($topTags);
    }

    public function testHomeController()
    {
        $homeController = new HomeController();
        $homeController->setDI($this->di);
        $res = $homeController->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
