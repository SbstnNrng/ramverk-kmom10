<?php

namespace Seb\Answers;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * IpCheck test class.
 */
class AnswersTest extends TestCase
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

    public function testAnswers()
    {
        $answers = new Answers();
        $answers->setDb($this->di->get("dbqb"));
        $this->assertIsObject($answers);
    }

    public function testCreateAnswersForm()
    {
        $answers = new Answers();
        $answers->setDb($this->di->get("dbqb"));
        $answersForm = new HTMLForm\CreateAnswersForm($this->di, 2);
        $this->assertIsObject($answersForm);
    }
}
