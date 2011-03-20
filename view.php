<html>
<head><title><?= fetch('title') ?></title></head>
<body>
<h1><?= fetch('title') ?></h1>
<p><?= $hello ?></p>
<form>
<select name="foo">
<?= html_options($users, $user_id) ?>
</select>
</form>
</body>
</html>
