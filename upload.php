<?php
if (!empty($_FILES)) {
    $file = $_FILES['file'];
    if ($file['type'] != 'text/csv') {
        $error = 'Неверный формат файла';
    } else {
        $f = fopen($file['tmp_name'], 'r');
        if (!is_dir(__DIR__ . '/upload')) {
            mkdir(__DIR__ . '/upload', 0777, true);
        }
        $count = 0;
        while (($row = fgetcsv($f, 0, ';')) !== false) {
            if (!empty($row)) {
                file_put_contents(__DIR__ . "/upload/" . htmlspecialchars($row[0]), htmlspecialchars($row[1]));
                $count++;
            }
        }

        $success = "Всё прошло успешно! Создано $count файла в папке " . __DIR__ . '/upload/';
    }

}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
            crossorigin="anonymous"></script>
    <title>Upload</title>
</head>
<body>
<div class="container">
    <h1 class="mt-5 mb-4">Загрузка CSV файла</h1>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success" role="alert">
            <?= $success ?>
        </div>
    <?php endif; ?>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input type="file" class="form-control-file" accept=".csv" name="file">
        </div>
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-success">Загрузить</button>
        </div>
    </form>

</div>

</body>
</html>
