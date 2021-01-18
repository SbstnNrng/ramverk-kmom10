<?php
/**
 * Mount the controller onto a mountpoint.
 */
return [
    "routes" => [
        [
            "info" => "Profile",
            "mount" => "profile",
            "handler" => "\Seb\Profile\ProfileController",
        ],
    ]
];
