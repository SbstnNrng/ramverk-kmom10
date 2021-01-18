<?php
/**
 * Mount the controller onto a mountpoint.
 */
return [
    "routes" => [
        [
            "info" => "Forum",
            "mount" => "forum",
            "handler" => "\Seb\Questions\QuestionsController",
        ],
    ]
];
