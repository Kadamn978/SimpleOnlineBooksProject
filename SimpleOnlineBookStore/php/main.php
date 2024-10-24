<?php
include("DbConnection.php");
include('loadTable.php');
include('CDBook.php');
include('UpdateBook.php');

$db = new DbConnection();
$conn = $db->getConnection();

$method = isset($_POST['method']) ? $_POST['method'] : null; // Get the value from POST

if (empty($method)) { // Check if it's empty
    echo json_encode(['status' => false, 'message' => 'Method is empty']);
} else {

    switch ($method) {
        case 'loadTable':
            $loaddata = new LoadTable($conn);
            $output = $loaddata->loadTable();
            echo $output;
            break;

        case 'insertBook':
            $name = $_POST['name'];
            $author = $_POST['author'];
            $category = $_POST['category'];
            $description = $_POST['description'];
            $photo = $_FILES['photo'];

            // Validate required fields
            if (empty($name) || empty($author) || empty($category) || empty($description) || !$photo) {
                echo json_encode(['status' => false, 'message' => 'All fields must be filled.']);
            } else {
                $insert = new CDBook($conn);
                $insertdata = $insert->insertBook($name, $author, $category, $description, $photo);
            }
            if ($insertdata == 'success') {
                echo json_encode(['status' => 'success', 'message' => 'Data inserted successfully']);
            } else {
                echo json_encode(['status' => false, 'message' => 'Failed to insert data.']);
            }
            break;

        case 'deleteBook':
            $id = $_POST['id'];
            if (empty($id)) {
                echo json_encode(['status' => false, 'message' => 'All fields must be filled.']);
            } else {
                $delete = new CDBook($conn);
                $deletedata = $delete->deleteBook($id);
            }
            if ($deletedata == 'success') {
                echo json_encode(['status' => 'success', 'message' => 'Data Deleted successfully']);
            } else {
                echo json_encode(['status' => false, 'message' => 'Failed to Delete data.']);
            }
            break;

        case 'loadBookData':
            // load book data into modal
            $id = $_POST['id'];
            $loaddata = new UpdateBook($conn);
            $output = $loaddata->loadBookData($id);
            echo $output;
            break;
            case 'updateBook':
            // insert updated data into db
            $id = $_POST['id'];
            $name = $_POST['name'];
            $author = $_POST['author'];
            $category = $_POST['category'];
            $description = $_POST['description'];
            $photo = $_FILES['photo'];

            // Validate required fields
            if (empty($name) || empty($author) || empty($category) || empty($description) || !$photo) {
                echo json_encode(['status' => false, 'message' => 'All fields must be filled.']);

            } else {
                $insert = new CDBook($conn);
                $insertdata = $insert->insertBook($name, $author, $category, $description, $photo);
            }

            if ($output == 'success') {
                echo json_encode(['status' => 'success', 'message' => 'Book Data Updated successfully']);
            } else {
                echo json_encode(['status' => false, 'message' => 'Failed to Update Book Data.']);
            }
            break;


        default:
            echo json_encode(['status' => false, 'message' => 'No method specified']);
            break;
    }
}
?>