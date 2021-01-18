<?php

namespace Seb\AnswerComments;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * IpCheck test class.
 */
class AnswerCommentsTest extends TestCase
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

    public function testAnswerComments()
    {
        $answers = new AnswerComments();
        $answers->setDb($this->di->get("dbqb"));
        $this->assertIsObject($answers);
    }

    public function testCreateAnswerCommentsForm()
    {
        $answers = new AnswerComments();
        $answers->setDb($this->di->get("dbqb"));
        $answersForm = new HTMLForm\CreateAnswerCommentsForm($this->di, 2, 2);
        $this->assertIsObject($answersForm);
    }
}
