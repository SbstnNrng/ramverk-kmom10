<?php

namespace Seb\Home;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class HomeModel
{

    /**
     * Show all items.
     *
     * @return object as a response object
     */
    public function recentTopics($topics)
    {
        $arrayRes = [];
        foreach (array_reverse($topics) as $q) {
            if (count($topics)-3 < $q->id) {
                array_push($arrayRes, $q->topic);
            }
        }
        return $arrayRes;
    }

    /**
     * Show all items.
     *
     * @return object as a response object
     */
    public function topUsers($users)
    {
        $arrayRes = [];
        $array = [];
        foreach ($users as $u) {
            $arrayRes[$u->acronym] = $u->score;
        }
        arsort($arrayRes);
        $array = array_slice($arrayRes, 0, 3);
        return $array;
    }

    /**
     * Show all items.
     *
     * @return object as a response object
     */
    public function topTags($tags, $questions)
    {
        $arrayRes = [];
        $tagFrequency = 0;
        foreach ($tags as $tag) {
            $tagFrequency = 0;
            foreach ($questions as $q) {
                if ($tag->tag == $q->tag1 || $tag->tag == $q->tag2 || $tag->tag == $q->tag3) {
                    $tagFrequency += 1;
                }
            }
            if ($tagFrequency == !0) {
                $arrayRes[$tag->tag] = $tagFrequency;
            }
        }
        arsort($arrayRes);
        $arrayRes = array_slice($arrayRes, 0, 3);
        return $arrayRes;
    }
}
