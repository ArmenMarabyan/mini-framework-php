
<div class="test"></div>
<div class="container">
    <button class="btn btn-default">Click</button>
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


<script>
    $(document).ready(function() {
        $('.btn').on('click', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'main/index',
                type: 'post',
                data: {'id': 2},
                beforeSend: function() {
                    $('.test').text('Ожидание')
                },
                success: function(res) {
                    $('.test').html(res)
                    // var res = JSON.parse(res);
                    // $('.test').text(res.name)
                },


                error: function() {
                    alert('error')
                }
            })
        })
    })

</script>