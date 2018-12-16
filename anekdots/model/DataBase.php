<?php

class DataBase
{
    private $dbHost;
    private $dbUser;
    private $dbPassword;
    private $dbName;
    private $dbLink;
   

    public function __construct($dbHost, $dbUser, $dbPassword, $dbName)
    {
        $this->dbHost = $dbHost;
        $this->dbUser = $dbUser;
        $this->dbPassword = $dbPassword;
        $this->dbName = $dbName;
        $this->dbLink = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName) or die(mysqli_error( $this->dbLink));
    }

    public function requestToDataBase($query)
    {
        $request = mysqli_query($this->dbLink, $query) or die(mysqli_error($this->dbLink));
        return $request;
    }

    public function create($query)
    {
        $request = mysqli_query($this->dbLink, $query) or die(mysqli_error($this->dbLink));
        return $request;
    }

    public function showAll($query)
    {
        $posts = $this->requestToDataBase($query);
        for ($data = array(); $row = mysqli_fetch_assoc($posts); $data[] = $row) {
        };
        return $posts;
    }

    public function findPost($query)
    {
        $posts = $this->requestToDataBase($query);
        $user = mysqli_fetch_assoc($posts);
        return $user;
    }


    public function update($query)
    {
        $request = mysqli_query($this->dbLink, $query) or die(mysqli_error($this->dbLink));
        return $request;
    }

    public function countDate($query)
    {
        $result = $this->requestToDataBase($query);
         $count = mysqli_fetch_row($result);
        return $count;
    }

    public function deleteDate($query)
    {
        return $delete = mysqli_fetch_row(requestToDataBase($query));
    }

}


?>