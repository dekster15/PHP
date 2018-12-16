<?php

class Anekdot
{
    private $author;
    private $text;
    private $date;
	private $category;
	private $title;

    public function __construct($author, $title, $text, $category)
    {
        $this->author = $author;
		$this->title = $title;
        $this->text = $text;
        $this->date = date('H:i:s d.m.Y');
		$this->category = $category;
    }


    public function getAuthor()
    {
        return $this->author;
    }


    public function getText()
    {
        return $this->text;
    }


    public function getDate()
    {
        return $this->date;
    }
	
	 public function getCategory()
    {
        return $this->category;
    }
	
	 public function getTitle()
    {
        return $this->title;
    }
	
	
}
?>