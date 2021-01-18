<?php

namespace Anax\View;

/**
 * View to create a new book.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$userInfo = isset($userInfo) ? $userInfo : null;

// Create urls for navigation
$urlToView = url("profile");



?><h1>Update Profile</h1>

<?= $form ?>

<p>
    <a href="<?= $urlToView ?>">Back to Profile</a>
</p>
