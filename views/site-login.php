<h1>Login</h1>

<div class="d-flex align-items-center justify-content-center">
    <form method="post">
        <div class="form-group">
            <label for="login">Your login</label>
            <input type="text" class="form-control" id="login" name="login">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <br><br>
        <?php if ($message): ?>
            <div class="alert alert-danger" role="alert">
                <?= $message ?>
            </div>
        <?php endif; ?>
    </form>
</div>
