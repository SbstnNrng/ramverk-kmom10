<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$topic = isset($topic) ? $topic : null;

?>
<div>
<b>Topics with tag: <?= $tag ?></b><br>
<?php foreach ($topic as $top) : ?>
    <?php if ($tag == $top->tag1 || $tag == $top->tag2 || $tag == $top->tag3) : ?>
<a href="<?= url("forum/topic/{$top->id}"); ?>"><?= $top->topic ?></a><br>
    <?php endif; ?>
<?php endforeach; ?>
</div><br>




