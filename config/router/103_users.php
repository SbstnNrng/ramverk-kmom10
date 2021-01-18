<?php
/**
 * Mount the controller onto a mountpoint.
 */
return [
    "routes" => [
        [
            "info" => "Users",
            "mount" => "users",
            "handler" => "\Seb\User\UsersController",
        ],
    ]
];
