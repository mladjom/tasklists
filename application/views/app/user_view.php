<div id="content">
  <p>
    Username:
    <?= $user_info->username ?>
  </p>
  <p>
    E-mail:
    <?= $user_info->email; echo $this->gravatar->get_gravatar($user_info->email); ?>
  </p><img src="<?php echo $this->gravatar->get_gravatar($user_info->email); ?>" alt="<?= $user_info->username ?>">
  <p>
    Date Activated:
    <?= $date['day'] ?>.<?= $date['month'] ?>.<?= $date['year'] ?>
    (<?= $date['hour'] ?>h : <?= $date['minute'] ?>min : <?= $date['second'] ?>sec)
  </p>
</div>