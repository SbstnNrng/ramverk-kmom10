<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$questions = isset($questions) ? $questions : null;

// Create urls for navigation
$urlToCreate = url("forum/create");

?><h1>Forum</h1>

<p>
    <a href="<?= $urlToCreate ?>">Start Thread</a>
</p>

<?php foreach ($questions as $question) : ?>
<div style="background-color: white;
        padding: 1rem;
        border: 2px solid black;
        margin-bottom: 1rem;">
<b>Topic:</b> <?= $question->topic ?><br>
<b>User:</b> <?= $question->acronym ?> <br>
<b>Tags:</b> <?= $question->tag1 ?> <?= $question->tag2 ?> <?= $question->tag3 ?> <br>
<a href="<?= url("forum/topic/{$question->id}"); ?>">Read</a><br>
</div>
<?php endforeach; ?>

