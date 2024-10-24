<?php

class UpdateBook
{
    private $conn;
    private $author_id = "";
    private $category_id = "";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function loadBookData($id)
    {
        $sql = "SELECT b.id, b.name, a.author_name, c.cat_name, b.description, b.photo 
                FROM books b 
                JOIN authors a ON b.author_id = a.author_id 
                JOIN categories c ON b.category_id = c.cat_id 
                WHERE b.id = {$id}";

        $result = mysqli_query($this->conn, $sql) or die("SQL Query Failed.");

        $output = "";

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $output .= '
                <input type="hidden" name="id" id="bookId" value="' . $row['id'] . '">
                <label for="name">Book Name:</label>
                <input type="text" id="edit-name" name="name" value="' . htmlspecialchars($row['name'], ENT_QUOTES) . '" required>
                <label for="author">Author:</label>
                <input type="text" id="edit-author" name="author" value="' . htmlspecialchars($row['author_name'], ENT_QUOTES) . '" required>
                <label for="category">Category:</label>
                <input type="text" id="edit-category" name="category" value="' . htmlspecialchars($row['cat_name'], ENT_QUOTES) . '" required>
                <label for="description">Description of Book:</label>
                <textarea id="edit-description" name="description" rows="4" required>' . htmlspecialchars($row['description'], ENT_QUOTES) . '</textarea>
                <label for="photo">Photo:</label>
                <input type="file" id="edit-photo" name="photo">
                <button id="edit-submit" type="submit">Update</button>
            ';
        } else {
            return "<h3>No records found.</h3>";
        }
        return $output;
    }

    // Update book Data
    public function updateBook($id,$name, $author, $category, $description, $photo)
    {
        // Validate input
        if (empty($id) || empty($name) || empty($author) || empty($category) || empty($description) || empty($photo['name'])) {
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

            $sql = "UPDATE books SET name = '$name', author_id = '$author_id', category_id = '$category_id', description = '$description', photo = '$uploadFilePath' WHERE id = $id;";
            
            if (mysqli_query($this->conn, $sql)) {
                return 'success';
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
?>