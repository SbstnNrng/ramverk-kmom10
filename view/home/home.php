<?php

namespace Anax\View;

$questions = isset($questions) ? $questions : null;
$users = isset($users) ? $users : null;
$tags = isset($tags) ? $tags : null;

?>

<h1>Mechanical Heaven</h1>

<h2>Most recent topics</h2>
<?php foreach ($questions as $q) : ?>
    <p><?= $q ?></p>
<?php endforeach; ?>

<h2>Most active users</h2>
<?php foreach (array_keys($users) as $u) : ?>
    <p><?= $u ?></p>
<?php endforeach; ?>

<h2>Most popular tags</h2>
<?php foreach (array_keys($tags) as $t) : ?>
    <p><?= $t ?></p>
<?php endforeach; ?>
