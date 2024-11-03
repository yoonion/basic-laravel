<!doctype html>
<html lang="en">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
    <div class="container p-5">
        <h1 class="text-2xl mb-6">글 목록</h1>
        <?php foreach ($articles as $article) : ?>
            <div class="rounded border mb-3 p-3">
                <p><?php echo $article->text; ?></p>
                <p><?php echo $article->created_at; ?></p>
                <p><?php echo $article->updated_at; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
