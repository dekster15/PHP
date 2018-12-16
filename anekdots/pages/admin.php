<?php
//Видалення посту по ID
if (!empty($_REQUEST['deleteId'])) {
    $dateBase->requestToDataBase("DELETE FROM anekdot WHERE id = '" . $_REQUEST['deleteId'] . "'");
}
//Видалення юзера по ID
if (!empty($_REQUEST['deleteUserId'])) {
    $dateBase->requestToDataBase("DELETE FROM users WHERE id = '" . $_REQUEST['deleteUserId'] . "'");
}
//Одобренна публікації
if (!empty($_REQUEST['publishedId'])) {
    $dateBase->requestToDataBase("UPDATE anekdot SET published = 1 WHERE id ='" . $_REQUEST['publishedId'] . "'");
}

// Зробити адміном
if (!empty($_REQUEST['adminId'])) {
    $dateBase->requestToDataBase("UPDATE users SET rule = 'admin' WHERE id = '" . $_REQUEST['adminId'] . "'");
}

//Забанити
if (!empty($_REQUEST['banId'])) {
    $dateBase->requestToDataBase("UPDATE users SET ban = 1 WHERE id = '" . $_REQUEST['banId'] . "'");
}

//Розбанити
if (!empty($_REQUEST['unBanId'])) {
    $dateBase->requestToDataBase("UPDATE users SET ban = 0 WHERE id = '" . $_REQUEST['unBanId'] . "'");
}

//Сторінка редагування
if (!empty($_REQUEST['editId'])) {
    $post = $dateBase->findPost("SELECT * FROM anekdot WHERE id = '" . $_REQUEST['editId'] . "'");
}

//Редагування посту 
if (!empty($_REQUEST['edit'])) {
    $dateBase->requestToDataBase("UPDATE anekdot SET author = '" . $_REQUEST['editAuthor'] . "', category = '" . $_REQUEST['editCategory'] . "',
   text = '" . $_REQUEST['editText'] . "'	WHERE id = '" . $_REQUEST['editId'] . "'");
}

$allPosts = $dateBase->showAll("SELECT * FROM anekdot");
$allUsers = $dateBase->showAll("SELECT * FROM users");
?>

<button><a href="index.php?page=admin&admin_page=editUsers">Адміністрування юзерів</a></button>
<button><a href="index.php?page=admin&admin_page=editPosts">Адміністрування публікацій</a></button>
<button><a href="index.php?page=admin&admin_page=forPublished">Публікації для одобрення</a></button>

<div id="content">
    <?php switch ($_REQUEST['admin_page']) {
        case 'editPosts':
            ?>
            <!--List of posts -->
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Text</th>
                    <th>Date</th>
                    <th>Published</th>
                    <th>Category</th>
                </tr>
                <?php foreach ($allPosts as $item) { ?>
                    <tr>
                        <td> <?php echo $item['id'] ?></td>
                        <td> <?php echo $item['author'] ?></td>
                        <td> <?php echo $item['text'] ?></td>
                        <td> <?php echo $item['date'] ?></td>
                        <td> <?php echo $item['published'] ?></td>
                        <td> <?php echo $item['category'] ?></td>
                        <td><a href="index.php?page=admin&admin_page=editPosts&deleteId=<?php echo $item['id'] ?>">Видалити</a>
                        </td>
                        <td>
                            <a href="index.php?page=admin&admin_page=edit&editId=<?php echo $item['id'] ?>">Редагувати</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <!--List of posts end -->
            <?php break;
        case 'editUsers':
            ?>
            <!--List of users -->
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Login</th>
                    <th>Password</th>
                    <th>Rule</th>
                    <th>Ban</th>
                </tr>
                <?php foreach ($allUsers as $item) { ?>
                    <tr>
                        <td> <?php echo $item['id'] ?></td>
                        <td> <?php echo $item['login'] ?></td>
                        <td> <?php echo $item['password'] ?></td>
                        <td> <?php echo $item['rule'] ?></td>
                        <td> <?php echo $item['ban'] ?></td>
                        <td><a href="index.php?page=admin&admin_page=editUsers&deleteUserId=<?php echo $item['id'] ?>">Видалити</a>
                        </td>
                        <td><a href="index.php?page=admin&admin_page=editUsers&adminId=<?php echo $item['id'] ?>">Зробити
                                адміном</a></td>
                        <td>
                            <a href="index.php?page=admin&admin_page=editUsers&banId=<?php echo $item['id'] ?>">Забанити</a>
                        </td>
                        <td><a href="index.php?page=admin&admin_page=editUsers&unBanId=<?php echo $item['id'] ?>">Розбанити</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <!--List of users end-->
            <?php break;
        case 'forPublished': ?>
            <!--List of posts for approve-->
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Text</th>
                    <th>Date</th>
                    <th>Published</th>
                    <th>Category</th>
                </tr>
                <?php foreach ($allPosts as $item) {
                    if ($item['published'] == 0) { ?>
                        <tr>
                            <td> <?php echo $item['id'] ?></td>
                            <td> <?php echo $item['author'] ?></td>
                            <td> <?php echo $item['text'] ?></td>
                            <td> <?php echo $item['date'] ?></td>
                            <td> <?php echo $item['published'] ?></td>
                            <td> <?php echo $item['category'] ?></td>
                            <td>
                                <a href="index.php?page=admin&admin_page=forPublished&publishedId=<?php echo $item['id'] ?>">Одобрити</a>
                            </td>
                        </tr>
                    <?php }
                } ?>
            </table>
            <!--List of posts end -->
            <?php break;
        case 'edit':
            ?>
            <!--Post for edit-->
            <form action="#" method="get">
                <input name="editAuthor" type="text" value="<?php echo $post['author'] ?>">
                <p><select name="editCategory">
                        <?php foreach ($allCategory as $item) { ?>
                            <option value="<?php echo $item['category'] ?>"><?php echo $item['category'] ?></option>
                        <?php } ?>
                    </select></p>
                <input type="hidden" name="page" value="admin">
                <input type="hidden" name="admin_page" value="editPosts">
                <input type="hidden" name="editId" value="<?php echo $post['id'] ?>">
                <textarea rows="10" cols="45" name="editText"><?php echo $post['text'] ?></textarea><br>
                <input type="submit" value="Редагувати" name="edit">
            </form>

            <!--Post for edit end -->
            <?php break;
    } ?>
</div>