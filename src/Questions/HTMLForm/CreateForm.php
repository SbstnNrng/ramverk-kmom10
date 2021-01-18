<?php

namespace Seb\Questions\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Seb\Questions\Questions;
use Seb\Tags\Tags;
use Seb\User\User;

/**
 * Form to create an item.
 */
class CreateForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Details of the item",
            ],
            [
                "topic" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                ],

                "question" => [
                    "type" => "textarea",
                    "validation" => ["not_empty"],
                ],

                "tag1" => [
                    "type" => "select",
                    "label"       => "tag1",
                    "options"     => $this->getAllItems(),
                ],

                "tag2" => [
                    "type" => "select",
                    "label"       => "tag2",
                    "options"     => $this->getAllItems(),
                ],

                "tag3" => [
                    "type" => "select",
                    "label"       => "tag3",
                    "options"     => $this->getAllItems(),
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
     * Get all items as array suitable for display in select option dropdown.
     *
     * @return array with key value of all items.
     */
    protected function getAllItems() : array
    {
        $tags = new Tags();
        $tags->setDb($this->di->get("dbqb"));

        $items = ["" => "Select an item..."];
        foreach ($tags->findAll() as $obj) {
            $items[$obj->tag] = "{$obj->tag}";
        }

        return $items;
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
        $questions = new Questions();
        $questions->setDb($this->di->get("dbqb"));
        $questions->acronym = $session->get("acronym");
        $questions->userid = $session->get("userid");
        $questions->topic = $this->form->value("topic");
        $questions->question = $this->form->value("question");
        $questions->tag1 = $this->form->value("tag1");
        $questions->tag2 = $this->form->value("tag2");
        $questions->tag3 = $this->form->value("tag3");
        $questions->save();
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
        $this->di->get("response")->redirect("forum")->send();
    }
}
