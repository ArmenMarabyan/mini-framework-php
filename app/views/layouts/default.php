<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <?php \fw\core\base\View::getMeta()?>
<!--    --><?php //\fw\core\base\View::getMeta()?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/fw_v2/public/bootstrap/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/fw_v2">Home</a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="/fw_v2/admin">Admin</a>
                <?php if(!isset($_SESSION['user'])): ?>
                    <a class="nav-item nav-link" href="/fw_v2/user/register">Reg</a>
                    <a class="nav-item nav-link" href="/fw_v2/user/login">Log</a>
                <?php endif; ?>
                <a class="nav-item nav-link" href="/fw_v2/user/logout">Log out</a>
                <a class="nav-item nav-link" href=""><?=(isset($_SESSION['user'])) ? $_SESSION['user']['name'] : ''?></a>
            </div>
        </div>
    </nav>
    <?=$content?>

</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="public/bootstrap/js/bootstrap.min.js"></script>
<?php foreach($scripts as $script): ?>
    <?=$script?>
<?php endforeach; ?>
</body>
</html>