<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$userInfo = isset($userInfo) ? $userInfo : null;

?>

<h1>Users</h1>

<table>
<tr>
        <th>Username</th>
        <th>Gravatar</th>
        <th>Score</th>
</tr>
<?php foreach ($userInfo as $info) : ?>
    <?php
    $urlToHistory = url("profile/update/{$info->acronym}");
    $email = $info->email;
    $default = "https://cdn.pixabay.com/photo/2012/04/12/20/12/x-30465_640.png";
    $size = 40;
    $grav_url = "https://www.gravatar.com/avatar/"
                . md5(strtolower(trim($email))) . "?d="
                . urlencode($default) . "&s=" . $size;
    ?>
<tr>
    <td><a href="<?= url("users/history/{$info->acronym}"); ?>"><?= $info->acronym ?></a></td>
    <td><img src="<?php echo $grav_url; ?>" alt="" width="40px" height="40px"/></td>
    <td><?= $info->score ?></td>
</tr>
<?php endforeach; ?>
</table>

 