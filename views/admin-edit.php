<h1>Edit Task</h1>

<?php if (isset($message) && $message): ?>
    <div class="alert alert-success" role="alert">
        <?= $message ?>
    </div>
<?php endif; ?>

<form method="post">
    <?php foreach ($vars as $array): ?>
        <div class="form-group">
            <label for="text">Edit task#<?= $array['id'] ?>: <?= $array['title'] ?></label>
            <textarea class="form-control" id="text" name="text" rows="3"><?= $array['content'] ?></textarea>
        </div>
    <?php endforeach; ?>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>