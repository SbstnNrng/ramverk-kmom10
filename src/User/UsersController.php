<?php

namespace Seb\User;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Seb\Questions\Questions;
use Seb\Answers\Answers;
use Seb\QuestionComments\QuestionComments;
use Seb\AnswerComments\AnswerComments;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class UsersController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * Show all items.
     *
     * @return object as a response object
     */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $users = new User();
        $users->setDb($this->di->get("dbqb"));

        $session = $this->di->get("session");
        if (!$session->get("acronym")) {
            $page->add("user/please");
            return $page->render();
        }

        $page->add("user/users", [
            "userInfo" => $users->findAll()
        ]);

        return $page->render([
            "title" => "Users",
        ]);
    }

    /**
     * Show all items.
     *
     * @return object as a response object
     */
    public function historyAction(string $user) : object
    {
        $page = $this->di->get("page");
        $topic = new Questions();
        $topic->setDb($this->di->get("dbqb"));
        $answers = new Answers();
        $answers->setDb($this->di->get("dbqb"));
        $questioncomments = new QuestionComments();
        $questioncomments->setDb($this->di->get("dbqb"));
        $answercomments = new AnswerComments();
        $answercomments->setDb($this->di->get("dbqb"));

        $page->add("user/history", [
            "topic" => $topic->findAll(),
            "answers" => $answers->findAll(),
            "questioncomments" => $questioncomments->findAll(),
            "answercomments" => $answercomments->findAll(),
            "acr" => $user
        ]);

        return $page->render([
            "title" => "Users",
        ]);
    }
}
