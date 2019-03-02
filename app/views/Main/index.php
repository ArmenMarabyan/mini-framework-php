

<div class="container">
    <!-- Example row of columns -->
    <?php foreach($newsList as $newsItem): ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?=$newsItem['name']?></h2>

            </div>
            <div class="panel-body">
                <p> <?=$newsItem['text']?></p>
            </div>

        </div>
    <?php endforeach; ?>

</div>