<?php

namespace Seb\Tags;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Seb\Questions\Questions;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class TagsController implements ContainerInjectableInterface
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
        $tags = new Tags();
        $tags->setDb($this->di->get("dbqb"));

        $session = $this->di->get("session");
        if (!$session->get("acronym")) {
            $page->add("user/please");
            return $page->render();
        }

        $page->add("forum/tags", [
            "tags" => $tags->findAll()
        ]);

        return $page->render([
            "title" => "Tags",
        ]);
    }

    /**
     * Show all items.
     *
     * @return object as a response object
     */
    public function existsAction(string $tag) : object
    {
        $page = $this->di->get("page");
        $topic = new Questions();
        $topic->setDb($this->di->get("dbqb"));

        $page->add("forum/exists", [
            "topic" => $topic->findAll(),
            "tag" => $tag
        ]);

        return $page->render([
            "title" => "Users",
        ]);
    }
}
