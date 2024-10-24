<?php

include('CDAuthor.php');
include('CDCategories.php');
class CDBook
{
    private $conn;
    private $author_id = "";
    private $category_id = "";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insertBook($name, $author, $category, $description, $photo)
    {
        // Validate input
        if (empty($name) || empty($author) || empty($category) || empty($description) || empty($photo['name'])) {
            return ['status' => false, 'message' => 'All fields must be filled.'];
        }

        // Define upload directory
        $uploadDirectory = '../images/booksImages/'; // Adjust the path
        $uploadFilePath = $uploadDirectory . basename($photo['name']);

        // Move the uploaded file
        if (!move_uploaded_file($photo['tmp_name'], $uploadFilePath)) {
            return false;
        }

        // Fetching Author ID from Database
        $authorObj = new CDAuthor($this->conn);
        $author_id = $authorObj->getSelectedAuthor($author);

        // Fetching Category ID from Database
        $categoryObj = new CDCategories($this->conn);
        $category_id = $categoryObj->getSelectedCategory($category);

        // Prepare and execute the SQL statement
        if (!empty($author_id) || !empty($category_id)) {
            // mysqli_real_escape_string() is a PHP function used to escape special characters in a string that will be included in a SQL query. 
            $name = mysqli_real_escape_string($this->conn, $name);
            $author_id = mysqli_real_escape_string($this->conn, $author_id);
            $category_id = mysqli_real_escape_string($this->conn, $category_id);
            $description = mysqli_real_escape_string($this->conn, $description);
            $uploadFilePath = mysqli_real_escape_string($this->conn, $uploadFilePath);
            $sql = "INSERT INTO books (name, author_id, category_id, description, photo) VALUES ('$name', '$author_id', '$category_id', '$description', '$uploadFilePath')";
            if (mysqli_query($this->conn, $sql)) {
                return 'success';
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function deleteBook($id)
    {
        $sql = "DELETE from books where id ='{$id}'";
        if (mysqli_query($this->conn, $sql)) {
            return 'success';
        } else {
            return 0;
        }
    }


}
?>

<?php

?>