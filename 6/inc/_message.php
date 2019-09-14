<?php if (isset($message)): ?>
	<div class="message" data-message="<?= $message['txt'] ?>" data-type="<?= $message['type'] ?>" data-title="<?= $message['title'] ?>" data-href="<?= $message['href'] ?>"></div>
<?php endif ?>