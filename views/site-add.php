<h1>Add Task</h1>

<?php if ($message): ?>
<div class="alert alert-success" role="alert">
    <?= $message ?>
</div>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <label for="userName">Your name</label>
        <input type="text" class="form-control" id="userName" name="userName" placeholder="Enter your name">
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter your email">
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Enter task title">
    </div>
    <div class="form-group">
        <label for="text">Text</label>
        <textarea class="form-control" id="text" name="text" rows="3" placeholder="Put the text of your task here"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>