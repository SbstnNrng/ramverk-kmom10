<?php

namespace Seb\Questions;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Seb\Questions\HTMLForm\CreateForm;
use Seb\Answers\HTMLForm\CreateAnswersForm;
use Seb\Answers\Answers;
use Seb\QuestionComments\QuestionComments;
use Seb\QuestionComments\HTMLForm\CreateQuestionCommentsForm;
use Seb\AnswerComments\AnswerComments;
use Seb\AnswerComments\HTMLForm\CreateAnswerCommentsForm;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class QuestionsController implements ContainerInjectableInterface
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
        $question = new Questions();
        $question->setDb($this->di->get("dbqb"));

        $session = $this->di->get("session");
        if (!$session->get("acronym")) {
            $page->add("user/please");
            return $page->render();
        }

        $page->add("forum/questions", [
            "questions" => $question->findAll(),
        ]);

        return $page->render([
            "title" => "Forum",
        ]);
    }

    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
    public function createAction() : object
    {
        $page = $this->di->get("page");
        $form = new CreateForm($this->di);
        $form->check();

        $page->add("forum/createQuestions", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "New Topic",
        ]);
    }

    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
    public function topicAction(int $id) : object
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

        $page->add("forum/topic", [
            "topic" => $topic->findAll(),
            "answers" => $answers->findAll(),
            "questioncomments" => $questioncomments->findAll(),
            "answercomments" => $answercomments->findAll(),
            "curid" => $id
        ]);

        return $page->render([
            "title" => "Topic",
        ]);
    }

    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
    public function answerAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new CreateAnswersForm($this->di, $id);
        $form->check();

        $page->add("forum/createAnswers", [
            "form" => $form->getHTML()
        ]);

        return $page->render([
            "title" => "New Answer",
        ]);
    }

    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
    public function questioncommentAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new CreateQuestionCommentsForm($this->di, $id);
        $form->check();

        $page->add("forum/createQuestionComments", [
            "form" => $form->getHTML()
        ]);

        return $page->render([
            "title" => "New Answer",
        ]);
    }

    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
    public function answercommentAction(int $qid, int $aid) : object
    {
        $page = $this->di->get("page");
        $form = new CreateAnswerCommentsForm($this->di, $qid, $aid);
        $form->check();

        $page->add("forum/createAnswerComments", [
            "form" => $form->getHTML()
        ]);

        return $page->render([
            "title" => "New Answer",
        ]);
    }
}
