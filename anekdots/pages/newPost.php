<?php
// Форма для створення нової публікації
function getFormNewPost(){ ?>
	<div id="content">
<h3>Створення нового посту</h3>
<br>
<form class="form-horizontal" role="form" action="#" method="post">
  <div class="form-group">
    <div class="col-sm-10">
      <input name="author" type="text" value="<?php echo $_SESSION['currentUser']->getLogin()?>" required class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <input name="title" type="text"  required class="form-control" id="inputEmail3" placeholder="Заголовок">
    </div>
  </div>
   <div class="form-group">
     <div class="col-sm-10">
       <select name="category" id="selectCategory" class="form-control">
	   <option class="form-control" value="Різне" selected>Різне</option>
	   <option class="form-control" value="Лікарі">Лікарі</option>
	   <option class="form-control" value="Студенти">Студенти</option>
	   <option class="form-control" value="Блондинки">Блондинки</option>
	</select>
	</div>
  </div>
  <div class="form-group">
  <div class="col-sm-10">
  <textarea class="form-control" name="text" placeholder="Текст посту" id="textForm"></textarea><br>
	<input type="hidden" name="page" value="newPost">
  </div>
  </div>
  <div class="form-group">
     <div class="col-sm-10">
	  <input type="submit" name="create" value="Створити" class="btn btn-default">
    </div>
  </div>
</form>
    </div>
<?php }
//Якщо форма створення нової публікації відправлена
if(!empty($_REQUEST['create'])){
    $anekdot = new Anekdot($_SESSION['currentUser']->getLogin(), $_REQUEST['title'], $_REQUEST['text'], $_REQUEST['category']);
    $dataBase = new DataBase("localhost", "root", "", "anekdots");
    $date = date('Y.m.d');
    $dataBase->create("INSERT INTO anekdot SET author = '".$anekdot->getAuthor()."', title = '".$anekdot->getTitle()."', text = '".$anekdot->getText()."',
category = '".$anekdot->getCategory()."' ,	date = '".$date."'");
	echo 'Публікацію надіслано для обобрення модератором';
	getFormNewPost();
}else {
	getFormNewPost();
}
?>
