<?php

namespace Seb\Answers\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Seb\Answers\Answers;
use Seb\User\User;

/**
 * Form to create an item.
 */
class CreateAnswersForm extends FormModel
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
                "legend" => "Create Answer",
            ],
            [
                
                "questionid" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $id,
                ],

                "answer" => [
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
        $answers = new Answers();
        $answers->setDb($this->di->get("dbqb"));
        $answers->acronym = $session->get("acronym");
        $answers->userid = $session->get("userid");
        $answers->answer = $this->form->value("answer");
        $answers->questionid = $this->form->value("questionid");
        $answers->save();
        return true;
    }

    /**
     * Callback what to do if the form was successfully submitted, this
     * happen when the submit callback method returns true. This method
     * can/should be implemented by the subclass for a different behaviour.
     */
    public function callbackSuccess()
    {
        $session = $this->di->get("session");
        $userid = $session->get("userid");
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find("id", $userid);
        $user->score += 1;
        $user->save();
        $this->di->get("response")->redirect("forum/topic/{$this->qid}")->send();
    }
}
