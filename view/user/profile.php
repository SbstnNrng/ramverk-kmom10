<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$userInfo = isset($userInfo) ? $userInfo : null;

?>

<h1>Profile</h1>

<?php foreach ($userInfo as $info) : ?>
    <?php if ($acro == $info->acronym) : ?>
        <?php
        $urlToUpdate = url("profile/update/{$info->id}");
        $urlToLogout = url("profile/logout");
        $email = $info->email;
        $default = "https://cdn.pixabay.com/photo/2012/04/12/20/12/x-30465_640.png";
        $size = 40;
        $grav_url = "https://www.gravatar.com/avatar/"
                    . md5(strtolower(trim($email))) . "?d="
                    . urlencode($default) . "&s=" . $size;
        ?>
<img src="<?php echo $grav_url; ?>" alt="" width="80px" height="80px"/>
<p>Username: <?= $info->acronym ?></p>
<p>Country: <?= $info->country ?></p>
<p>City: <?= $info->city ?></p>
<p>Email: <?= $info->email ?></p>
<p>Score: <?= $info->score ?></p>
<p><a href="<?= $urlToUpdate ?>">Update</a> <a href="<?= $urlToLogout ?>">Logout</a></p>
    <?php endif; ?>
<?php endforeach; ?>
 