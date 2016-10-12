<?php BeginForm(); ?>

<div class="form-group">
	<label for="comment">Commentaire</label>
	<textarea class="form-control" id="comment" rows="5"><?= $row['comment'] ?></textarea>
</div>

<div class="form-group">
	<label for="next_action">Actions à faire</label>
	<textarea class="form-control" id="next_action" rows="5"><?= $row['next_action'] ?></textarea>
</div>

<?php EndForm(); ?>

