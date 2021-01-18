<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$topic = isset($topic) ? $topic : null;
$answers = isset($answers) ? $answers : null;
$questioncomments = isset($questioncomments) ? $questioncomments : null;
$answercomments = isset($answercomments) ? $answercomments : null;

// Create urls for navigation
$urlToForum = url("forum");

?>

<?php foreach ($topic as $op) : ?>
    <?php if ($curid == $op->id) : ?>
<h1>
    Topic: <?= $op->topic ?>
</h1>
<p>
<a href="<?= $urlToForum ?>">Back</a>
</p>
<div style="background-color: white;
            padding: 1rem;
            border: 2px solid black;" >
    <p>
        <b>User: </b><?= $op->acronym ?><br>
        <b>Question:</b><br>
        <?= $op->question ?><br>
        <b>Comments:</b><br>
        <?php foreach ($questioncomments as $com) : ?>
            <?php if ($curid == $com->questionid) : ?>
                <?= $com->acronym ?>: <?= $com->comment ?><br>
            <?php endif; ?>
        <?php endforeach; ?>
    </p>
    <p><a href="<?= url("forum/answer/{$curid}"); ?>">Answer</a> <a href="<?= url("forum/questioncomment/{$curid}"); ?>">Comment</a></p>
        <?php foreach ($answers as $ans) : ?>
            <?php if ($curid == $ans->questionid) : ?>
        <div style="background-color: lightgray; 
            padding-left: 2rem; 
            border: 2px solid black;
            margin-bottom: 1rem;
            padding: 1rem;">
        <b>User:</b> <?= $ans->acronym ?><br> <b>Answer:</b><br> <?= $ans->answer ?><br>
        <b>Comments:</b><br>
                <?php foreach ($answercomments as $com) : ?>
                    <?php if ($ans->id == $com->answerid) : ?>
                        <?= $com->acronym ?>: <?= $com->comment ?><br>
                    <?php endif; ?>
                <?php endforeach; ?>
        <a href="<?= url("forum/answercomment/{$curid}/{$ans->id}"); ?>">Comment</a><br>
        </div>
            <?php endif; ?>
        <?php endforeach; ?>
</div>
    <?php endif; ?>
<?php endforeach; ?>




