<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop",
 
    // Here comes the menu items
    "items" => [
        [
            "text" => "Home",
            "url" => "",
            "title" => "Home",
        ],
        [
            "text" => "About",
            "url" => "about",
            "title" => "About",
        ],
        [
            "text" => "Login",
            "url" => "user/login",
            "title" => "Login",
        ],
        [
            "text" => "Register",
            "url" => "user/create",
            "title" => "Register",
        ],
        [
            "text" => "Forum",
            "url" => "forum",
            "title" => "Forum",
        ],
        [
            "text" => "Tags",
            "url" => "tags",
            "title" => "Tags",
        ],
        [
            "text" => "Profile",
            "url" => "profile",
            "title" => "Profile",
        ],
        [
            "text" => "Users",
            "url" => "users",
            "title" => "Users",
        ]
    ],
];
