<?php

namespace Seb\QuestionComments\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Seb\QuestionComments\QuestionComments;

/**
 * Form to create an item.
 */
class CreateQuestionCommentsForm extends FormModel
{
    public $qid;
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di, int $id)
    {
        $this->qid = $id;
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Create Comment",
            ],
            [
                
                "questionid" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $id,
                ],

                "comment" => [
                    "type" => "textarea",
                    "validation" => ["not_empty"],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Create item",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }

    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {
        $session = $this->di->get("session");
        $comments = new QuestionComments();
        $comments->setDb($this->di->get("dbqb"));
        $comments->acronym = $session->get("acronym");
        $comments->userid = $session->get("userid");
        $comments->comment = $this->form->value("comment");
        $comments->questionid = $this->form->value("questionid");
        $comments->save();
        return true;
    }

    /**
     * Callback what to do if the form was successfully submitted, this
     * happen when the submit callback method returns true. This method
     * can/should be implemented by the subclass for a different behaviour.
     */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("forum/topic/{$this->qid}")->send();
    }
}
