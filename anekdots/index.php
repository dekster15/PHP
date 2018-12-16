<?php
include 'model/DataBase.php';
include 'model/User.php';
include 'model/Anekdot.php';
include 'model/Session.php';
$session = new Session();
$dateBase = new DataBase("localhost", "root", "", "anekdots");
$allPosts = $dateBase->showAll("SELECT * FROM anekdot");
$allCategory = $dateBase->showAll("SELECT DISTINCT category FROM anekdot");
$allUsers = $dateBase->showAll("SELECT * FROM users");
$countPosts = $dateBase->countDate("SELECT COUNT(*) FROM anekdot");
$postOnPage = 3;
$countPages = floor((int)$countPosts[0] / $postOnPage);
$page1 = $dateBase->showAll("SELECT * FROM anekdot WHERE id > 0 LIMIT 3");
$page2 = $dateBase->showAll("SELECT * FROM anekdot WHERE id > 0 LIMIT 4,6");
$page3 = $dateBase->showAll("SELECT * FROM anekdot WHERE id > 0 LIMIT 6,9");

echo $countPages;

function generateSalt()
{
    $salt = '';
    $saltLength = 5; //довжина солі
    for ($i = 0; $i < $saltLength; $i++) {
        $salt .= chr(mt_rand(33, 126)); //символ из ASCII-table
    }
    return $salt;
}

if (!empty($_REQUEST['postByCategory'])) {

    $postByCategory = $dateBase->showAll("SELECT * FROM anekdot WHERE category = '" . $_REQUEST['postByCategory'] . "' ");
}
//Якщо кнопка logout натиснута
if ($_REQUEST['logout'] == 1) {
    $session->sessionDestroy();
    header('Location: /anekdots/index.php', true, 307);
}
//Якщо форма авторизації відправлена
if (!empty($_REQUEST['login']) and !empty($_REQUEST['password'])) {
    $login = $_REQUEST['login'];
    $password = $_REQUEST['password'];
    $result = $dateBase->findPost("SELECT * FROM users WHERE login='" . $login . "'");
    $passwordCheck = md5($password . $result['salt']);
    if (($result['login'] == $login) AND ($result['password'] == $passwordCheck)) {
        if ($result['ban'] == 0) {
            $currentUser = new User($result['login'], $result['password']);
            $session->createVarOfSession('auth', true);
            $session->createVarOfSession('currentUser', $currentUser);
        } else {
            $ban = 1;
        }
    } else {
        $wrongData = 1;
    }
}
?>
<html>
<head>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Анекдот.ua</title>
    <link rel="stylesheet" href="tools/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="tools/bootstrap/css/bootstrap-theme.min.css">
    <script src="tools/bootstrap/js/bootstrap.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
    <link href="tools/style.css" rel="stylesheet" type="text/css" media="screen"/>
</head>
<body>
<div id="wrapper">
    <?php include_once 'pages/header.php' ?>
    <div id="page">
        <?php switch ($_REQUEST['page']) {
            case 'newUser':
                include_once 'pages/newUser.php';
                // include_once 'pages/siteBar.php';
                break;
            case 'newPost':
                include_once 'pages/newPost.php';
                // include_once 'pages/siteBar.php';
                break;
            case 'admin':
                include_once 'pages/admin.php';
                break;
            default:
                include_once 'pages/content.php';
                include_once 'pages/siteBar.php';
        } ?>
        <div style="clear: both;">&nbsp;</div>
    </div>
    <div class="container"><img src="tools/images/img03.png" width="1000" height="40" alt=""/></div>
    <!-- end #page -->
</div>
<div id="footer-content"></div>
<div id="footer">
    <p>Copyright (c) 2017 PhpTutorial <a href="#">FCT</a>.
    </p>
</div>
<!-- end #footer -->
</body>
</html>
