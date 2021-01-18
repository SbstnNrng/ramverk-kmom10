<?php

namespace Seb\Profile;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Seb\Profile\HTMLForm\UpdateForm;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class ProfileController implements ContainerInjectableInterface
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
        $session = $this->di->get("session");
        $acronym = $session->get("acronym");
        $profile = new Profile();
        $profile->setDb($this->di->get("dbqb"));

        if (!$session->get("acronym")) {
            $page->add("user/please");
            return $page->render();
        }

        $page->add("user/profile", [
            "userInfo" => $profile->findAll(),
            "acro" => $acronym
        ]);

        return $page->render([
            "title" => "Profile",
        ]);
    }

    /**
     * Handler with form to update an item.
     *
     * @param int $id the id to update.
     *
     * @return object as a response object
     */
    public function updateAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new UpdateForm($this->di, $id);
        $form->check();

        $page->add("user/update", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Update an item",
        ]);
    }

    /**
     * Handler with form to update an item.
     *
     * @param int $id the id to update.
     *
     * @return object as a response object
     */
    public function logoutAction()
    {
        $session = $this->di->get("session");
        $session->set("acronym", null);
        $session->set("userid", null);
        $this->di->get("response")->redirect("user/login")->send();
    }
}
