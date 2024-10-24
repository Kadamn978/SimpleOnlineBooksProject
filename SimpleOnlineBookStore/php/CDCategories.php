<?php

class CDCategories
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    function insertCategory($category)
    {
        $sql = "INSERT INTO categories (cat_name)VALUE('{$category}') ";
        if (mysqli_query($this->conn, $sql)) {
            return 1;
        } else {
            return 0;
        }
    }

    function getSelectedCategory($category)
    {
        $sql = "SELECT * FROM categories WHERE cat_name LIKE '{$category}'";
        $result = mysqli_query($this->conn, $sql) or die("SQL Query Failed.");

        if (mysqli_num_rows($result) > 0) {
            // Fetch the first row
            $row = mysqli_fetch_assoc($result);
            return $row['cat_id'];  // Return the id of the first matching category
        } else {
            // If no category found, insert a new one and return its ID
            $insertResult = $this->insertCategory($category);
            if ($insertResult == 1) {
                return mysqli_insert_id($this->conn);  // Return the ID of the newly inserted category
            } else {
                return null;  // Return null if insert fails
            }
        }
    }

    function deleteCategory($category)
    {
        $sql = "DELETE FROM categories WHERE cat_name = '{$category}'";
        if (mysqli_query($this->conn, $sql)) {
            return 1;
        } else {
            return 0;
        }
    }
}

?>