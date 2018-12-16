<div id="content">
    <?php		
if(empty($_REQUEST['postByCategory'])){
    foreach ($allPosts as $item) { 
	 if ($item['published'] == 1) { ?>
        <div class="post">
            <h3 class="title"><?php echo $item['title'] ?></h3>
            <p class="meta"><span class="date"><?php echo $item['date'] ?></span><span class="posted">Автор: <a
                        href="#"><?php echo $item['author'] ?></a></span></p>
            <div class="entry">
                <p> <?php echo $item['text'] ?></p>
            </div>
        </div>
    <?php } } } 
	else{
		 foreach ($postByCategory as $item) { 
	 if ($item['published'] == 1) { ?>
        <div class="post">
            <h2 class="title"><?php echo $item['title'] ?></h2>
            <p class="meta"><span class="date"><?php echo $item['date'] ?></span><span class="posted">Автор: <a
                        href="#"><?php echo $item['author'] ?></a></span></p>
            <div class="entry">
                <p> <?php echo $item['text'] ?></p>
            </div>
        </div>
    <?php } }
	
	
	} ?>
</div>
