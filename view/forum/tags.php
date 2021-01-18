<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$tags = isset($tags) ? $tags : null;

?>

<h1>Tags</h1>

<table>
<tr>
    <th>Tags</th>
</tr>
<?php foreach ($tags as $tag) : ?>
<tr>
    <td><a href="<?= url("tags/exists/{$tag->tag}"); ?>"><?= $tag->tag ?></a></td>
</tr>
<?php endforeach; ?>
</table>

 