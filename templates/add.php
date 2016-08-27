<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Epic Blog</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
</head>
<body>
    <form action="index.php?action=messages&method=addSave" method="post">
    	<input type="hidden" name="token" value="<?= $token ?>">
    	Текст: <input type="text" name="message">
    	<button type="submit">Добавить сообщение</button>
    </form>
</body>
</html>