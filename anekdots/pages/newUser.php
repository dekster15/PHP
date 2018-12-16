<?php
// Форма реєстріції користувача
  function getFormRegistration(){
	 echo '<div id="content">
<h3>Реєстрація нового користувача</h3>
<br>
	<form class="form-horizontal" role="form" action="#" method="get" >
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Логін</label>
    <div class="col-sm-10">
      <input  name="newlogin" type="text" required class="form-control" id="inputEmail3" placeholder="Логін">
    </div>
  </div>
  <input type="hidden" name="page" value="newUser">
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
    <div class="col-sm-10">
      <input name="newpassword" type="password" required class="form-control" id="inputPassword3" placeholder="Пароль">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
	<input type="submit" name="registration" value="Зареєструвати"  class="btn btn-default">
    </div>
  </div>
</form>
	</div>';
 }

// Якщо форма реєстрації відправлена
if(!empty($_REQUEST['registration'])) {
	$login = $_REQUEST['newlogin'];
	$password = $_REQUEST['newpassword'];
    //Перевірка довжини
	if(strlen($login) > 3 AND strlen($password) > 3){
    $dateBase = new DataBase("localhost", "root", "", "anekdots");
    $newUser = new User($login, $password);
	$checkUser = $dateBase->findPost("SELECT * FROM users WHERE login = '".$newUser->getLogin()."'");
	//Перевірка унікальності логіну
	if(empty($checkUser)){
		$salt = generateSalt();
		$saltedPassword = md5($newUser->getPassword().$salt); //солений пароль
    $dateBase->create("INSERT INTO users SET login = '".$newUser->getLogin()."', password = '".$saltedPassword."', salt = '".$salt."'");
		echo 'Ви успішно зареєстровані!'.'<br>';
		echo '<a href="index.php">На головну</a>';
	}else {
		echo 'Логин зайнятий';
		getFormRegistration();
	}}else{
		echo 'Довжина логина і пароля мають бути не менше 3 символів!!!';
		getFormRegistration();
	}
}else{
	getFormRegistration();
	
	}


?>