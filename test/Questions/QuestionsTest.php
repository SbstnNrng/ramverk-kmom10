<?php

namespace Seb\Questions;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Anax\Response\ResponseUtility;

/**
 * IpCheck test class.
 */
class QuestionsTest extends TestCase
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

    public function testQuestions()
    {
        $questions = new Questions();
        $questions->setDb($this->di->get("dbqb"));
        $this->assertIsObject($questions);
    }

    public function testCreateForm()
    {
        $questions = new Questions();
        $questions->setDb($this->di->get("dbqb"));
        $questionsForm = new HTMLForm\CreateForm($this->di);
        $this->assertIsObject($questionsForm);
    }

    public function testProfileController()
    {
        $questionsController = new QuestionsController();
        $questionsController->setDI($this->di);
        $res = $questionsController->indexActionGet();
        $session = $this->di->get("session");
        $session->set("acronym", null);
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $session->set("acronym", "Olle");
        $res = $questionsController->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $res = $questionsController->createAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $res = $questionsController->topicAction(2);
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $res = $questionsController->answerAction(2);
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $res = $questionsController->questioncommentAction(2);
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $res = $questionsController->answercommentAction(2, 2);
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
