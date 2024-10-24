<?php

class CDAuthor
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    function insertAuthor($author)
    {
        $sql = "INSERT INTO authors (author_name)VALUE('{$author}') ";
        if (mysqli_query($this->conn, $sql)) {
            return 1;
        } else {
            return 0;
        }
    }
    function getSelectedAuthor($author)
{
    // Check the authors table instead of categories
    $sql = "SELECT * FROM authors WHERE author_name = '{$author}'";
    $result = mysqli_query($this->conn, $sql) or die("SQL Query Failed.");

    if (mysqli_num_rows($result) > 0) {
        // Fetch the first row
        $row = mysqli_fetch_assoc($result);
        return $row['author_id'];  // Return the id of the first matching author
    } else {
        // If no author found, insert a new one and return its ID
        $insertResult = $this->insertAuthor($author);
        if ($insertResult == 1) {
            return mysqli_insert_id($this->conn);  // Return the ID of the newly inserted author
        } else {
            return null;  // Return null if insert fails
        }
    }
}

    function deleteAuthor($author)
    {
        $sql = "DELETE authors where author_name ='{$author}'";
        if (mysqli_query($this->conn, $sql)) {
            return 1;
        } else {
            return 0;
        }
    }
}


?>