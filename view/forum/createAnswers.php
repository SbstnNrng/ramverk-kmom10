<?php

namespace Anax\View;

/**
 * View to create a new book.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$answers = isset($answers) ? $answers : null;

// Create urls for navigation
$urlToViewItems = url("forum");



?><h1>Create answer</h1>

<p>
    <a href="<?= $urlToViewItems ?>">Back</a>
</p>

<?= $form ?>
