<?php

namespace Seb\Home;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Seb\Questions\Questions;
use Seb\User\User;
use Seb\Tags\Tags;
use Seb\Home\HomeModel;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class HomeController implements ContainerInjectableInterface
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
        $questions = new Questions();
        $questions->setDb($this->di->get("dbqb"));
        $users = new User();
        $users->setDb($this->di->get("dbqb"));

        $homeModel = new HomeModel();
        $recentTopics = $homeModel->recentTopics($questions->findAll());
        $topUsers = $homeModel->topUsers($users->findAll());
        $topTags = $homeModel->topTags($tags->findAll(), $questions->findAll());

        $page->add("home/home", [
            "tags" => $topTags,
            "questions" => $recentTopics,
            "users" => $topUsers
        ]);

        return $page->render([
            "title" => "Home",
        ]);
    }
}
