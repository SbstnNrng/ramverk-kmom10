<?php
/**
 * Mount the controller onto a mountpoint.
 */
return [
    "routes" => [
        [
            "info" => "Tags",
            "mount" => "tags",
            "handler" => "\Seb\Tags\TagsController",
        ],
    ]
];
