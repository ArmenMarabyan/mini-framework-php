<h2>Регистрация</h2>
<?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?=$_SESSION['error']; unset($_SESSION['error'])?>
    </div>
<?php endif; ?>

<?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?=$_SESSION['success']; unset($_SESSION['success'])?>
    </div>
<?php endif; ?>
<div class="row">
    <div class="col-lg-6">
        <form method="post" action="">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" name="login" class="form-control" id="login" placeholder="Login" value="<?=isset($_SESSION['form_data']['login']) ? $_SESSION['form_data']['login']: '';?>">
            </div>
            <div class="form-group">
                <label for="password">password</label>
                <input type="password" name="password" class="form-control" id="password" value="<?=isset($_SESSION['form_data']['password']) ? $_SESSION['form_data']['password']: '';?>">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?=isset($_SESSION['form_data']['name']) ? $_SESSION['form_data']['name']: '';?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="<?=isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email']: '';?>">
            </div>
            <button type="submit" name="register" class="btn btn-primary">Register</button>
        </form>
        <?php
        if(isset($_SESSION['form_data'])) {
            unset($_SESSION['form_data']);
        }
        ?>
    </div>
</div>
