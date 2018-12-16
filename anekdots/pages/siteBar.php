<div id="sidebar">
    <ul>
        <li>
            <?php if ($session->getVarOfSession('auth') != true) { 
                if ($_REQUEST['page'] != 'newUser') {
				 if($wrongData==1) {
				 echo '<span>Невірний логін або пароль!</span>';}
				if($ban == 1){ 
				 echo '<span>Ваш акаунт заблоковано адміністратором</span>';
				 } ?>
				<div id="search">
				<form class="form-horizontal" role="form" method="post" action="#">
    <div class="form-group">
    <div class="col-sm-10">
      <input type="text" name="login" class="form-control" id="inputEmail3" placeholder="Введіть логін" required>
    </div>
    </div>
    <div class="form-group">
 
    <div class="col-sm-10">
      <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Введіть пароль" required>
    </div>
    </div>
 
    <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
	<input type="submit" class="btn btn-default" name="enter" value="Ввійти"/>
	<button class="btn btn-default"><a href="index.php?page=newUser">Реєстрація</a></button>
      
    </div>
  </div>
</form>
                </div>
				<?php } } else { ?>
                <?php if ($session->getVarOfSession('auth') == true) { ?>
                    <form class="navbar-form navbar-right" role="form">
                        <span><?php echo 'Welcome ' . $session->getVarOfSession('currentUser')->getLogin(); ?></span>
                    </form>
                <?php } ?>
            <?php } ?>
            <div style="clear: both;">&nbsp;</div>
        </li>
		<br>
		<br>
		<br>
		<br>
        <li>
           
			<h2>Топ-10</h2>
			<p>
			<?php 
			$arrayId;
			$count;
			$topPosts;
			foreach($allPosts as $id){
				$arrayId[$count] = $id['id'];
				$count++;
			}
			
			for($i=0; $i < 10; $i++){
				$id = rand(0, count($arrayId)-1);
          $top =  $dateBase->findPost("SELECT * FROM anekdot WHERE id = '".$arrayId[$id]."'");
		  $topPosts[$i] = $top;
		  $arrayId[$id] = '';
			echo '<span>'.$top['title'].' '.'</span>';
			 } ?> </p>
        </li>
        <li>
            <h2>Категорії</h2>
            <ul>
                <?php foreach ($allCategory as $categ) { ?>
                   <li><a href="index.php?postByCategory=<?php echo $categ['category'] ?>"><?php echo $categ['category'] ?></a></li>
                <?php } ?>
            </ul>
        </li>
    </ul>
</div>
