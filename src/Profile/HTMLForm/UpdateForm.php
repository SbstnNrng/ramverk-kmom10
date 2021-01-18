<?php

namespace Seb\Profile\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Seb\Profile\Profile;

/**
 * Form to update an item.
 */
class UpdateForm extends FormModel
{
    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     * @param integer             $id to update
     */
    public function __construct(ContainerInterface $di, $id)
    {
        parent::__construct($di);
        $profile = $this->getProfileDetails($id);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Update {$profile->acronym}",
            ],
            [
                "id" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $profile->id,
                ],

                "acronym" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $profile->acronym,
                ],

                "password" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $profile->password,
                ],

                "country" => [
                    "type" => "text",
                    "value" => $profile->country,
                ],

                "city" => [
                    "type" => "text",
                    "value" => $profile->city,
                ],

                "email" => [
                    "type" => "text",
                    "value" => $profile->email,
                ],

                "score" => [
                    "type" => "hidden",
                    "readonly" => true,
                    "value" => $profile->score,
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Save",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }

    /**
     * Get details on item to load form with.
     *
     * @param integer $id get details on item with id.
     *
     * @return Book
     */
    public function getProfileDetails($id) : object
    {
        $profile = new Profile();
        $profile->setDb($this->di->get("dbqb"));
        $profile->find("id", $id);
        return $profile;
    }

    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {
        $profile = new Profile();
        $profile->setDb($this->di->get("dbqb"));
        $profile->find("id", $this->form->value("id"));
        $profile->acronym = $this->form->value("acronym");
        $profile->password = $this->form->value("password");
        $profile->country = $this->form->value("country");
        $profile->city = $this->form->value("city");
        $profile->email = $this->form->value("email");
        $profile->score = $this->form->value("score");
        $profile->save();
        return true;
    }
}
