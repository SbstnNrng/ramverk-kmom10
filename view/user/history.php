<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$topic = isset($topic) ? $topic : null;
$answers = isset($answers) ? $answers : null;
$questioncomments = isset($questioncomments) ? $questioncomments : null;
$answercomments = isset($answercomments) ? $answercomments : null;

?>
<div>
<b>Topics <?= $acr ?> has posted</b><br>
<?php foreach ($topic as $op) : ?>
    <?php if ($acr == $op->acronym) : ?>
<a href="<?= url("forum/topic/{$op->id}"); ?>"><?= $op->topic ?></a><br>
    <?php endif; ?>
<?php endforeach; ?>
</div><br>

<div>
<b>Topics <?= $acr ?> has answerd</b><br>
<?php foreach ($answers as $ans) : ?>
    <?php if ($acr == $ans->acronym) : ?>
        <?php foreach ($topic as $op) : ?>
            <?php if ($ans->questionid == $op->id) : ?>
    <a href="<?= url("forum/topic/{$op->id}"); ?>"><?= $op->topic ?></a><br>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endforeach; ?>
</div>


