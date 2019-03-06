<div class="cont" style="background-color: #eee">
    <h1 style="color:red;"><?=$news->name?></h1>
    <p><?=$news->short?></p>
    <small><?php echo mb_substr($news->text, 0, 200).'...'?></small>
</div>