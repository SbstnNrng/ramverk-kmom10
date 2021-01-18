<?php

namespace Seb\QuestionComments;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * IpCheck test class.
 */
class QuestionCommentsTest extends TestCase
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
        $questions = new QuestionComments();
        $questions->setDb($this->di->get("dbqb"));
        $this->assertIsObject($questions);
    }

    public function testCreateQuestionCommentsForm()
    {
        $questions = new QuestionComments();
        $questions->setDb($this->di->get("dbqb"));
        $questionsForm = new HTMLForm\CreateQuestionCommentsForm($this->di, 2);
        $this->assertIsObject($questionsForm);
    }
}
