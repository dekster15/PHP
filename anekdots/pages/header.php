<div id="header-wrapper" class="container">
    <div id="header" class="container">
        <div id="logo">
            <h1><a href="index.php">Анекдот.ua </a></h1>
        </div>
        <div id="menu">
            <ul>
                <li class="current_page_item"><a href="index.php">Home</a></li>
                
                <li><a href="#">About</a></li>
                <?php if ($session->getVarOfSession('auth') == true) { ?>
                    <li><a href="index.php?logout=1">LogOut</a></li> 
					 <li><a href="index.php?page=newPost">New post</a></li> 
					<?php } ?>
                <?php if ($session->getVarOfSession('auth') == true AND $session->getVarOfSession('currentUser')->getLogin() == 'admin') { ?>
                    <li><a href="index.php?page=admin">Admin_Page</a></li> <?php } ?>
            </ul>
        </div>
    </div>
    <div><img src="tools/images/img03.png" width="1000" height="40" alt=""/></div>
</div>