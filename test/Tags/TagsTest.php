<?php

namespace Seb\Tags;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Anax\Response\ResponseUtility;

/**
 * IpCheck test class.
 */
class TagsTest extends TestCase
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

    public function testTagsController()
    {
        $tagsController = new TagsController();
        $tagsController->setDI($this->di);
        $session = $this->di->get("session");
        $session->set("acronym", null);
        $res = $tagsController->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $session->set("acronym", "Olle");
        $res = $tagsController->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $res = $tagsController->existsAction("hej");
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
