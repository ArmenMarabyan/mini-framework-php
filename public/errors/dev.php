<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error</title>
</head>
<body>
    <h1 style="color:red;">Произошла ошибка</h1>
    <p><b>Код Ошибки: </b> <?=$errno?></p>
    <p><b>Текст Ошибки: </b><?=$errstr?></p>
    <p><b>Файл, в котором произошла ошибка: </b><?=$errfile?></p>
    <p><b>Строка, в которой произошла ошибка: </b><?=$errline?></p>
</body>
</html>