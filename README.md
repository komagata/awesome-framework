AwesomeFramework
================

SYNOPSIS
========

AwesomeFramework is PHP application framework of an extremely simple Plain Old PHP File base.

PHP4, PHP5 compatible! (maybe PHP3, PHP6 also...)
AwesomeFramework never deserts PHP4.

USAGE
=====

action(default.php):

    <?php
    assign('hello', 'Hello World!!!');
    assign('users', array('1' => 'God', '2' => 'Kain', '3' => 'Me'));
    assign('user_id', 2);
    return 'view';
    ?>

view(view.php):

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

result(index.php?p=default):

    <html>
    <head><title>Hello World!!!
    </title></head>
    <body>
    <h1>Hello World!!
