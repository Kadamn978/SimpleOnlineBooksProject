<?php

class LoadTable
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function loadtable()
    {
        $sql = "SELECT b.id, b.name, a.author_name, c.cat_name, b.description, b.photo 
        FROM books b 
        JOIN authors a ON b.author_id = a.author_id 
        JOIN categories c ON b.category_id = c.cat_id  order by b.id";
        // WHERE b.name LIKE 'The Little Black Jacket: Chanel\'s Classic Revisited'";


        $result = mysqli_query($this->conn, $sql) or die("SQL Query Failed.");
        $output = "";
        $srno = 1;
        if (mysqli_num_rows($result) > 0) {
            $output .= "<thead>
                        <tr>
                            <th data-label='Sr. No.'>Sr. No.</th>
                            <th data-label='Photo'>Photo</th>
                            <th data-label='Name'>Name</th>
                            <th data-label='Author'>Author</th>
                            <th data-label='Category'>Category</th>
                            <th data-label='Description'>Description</th>
                            <th data-label='Buttons' colspan=2></th>
                        </tr>
                    </thead>
                    <tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                // <td align='center'><img src='" . htmlspecialchars($row['photo']) . "' alt='" . htmlspecialchars($row['name']) . "' style='width:50px;'></td>
                $output .= "<tr>
                            <td >{$srno}.</td>
                            <td align='center'><img src='" . htmlspecialchars($row['photo']) . "' alt='" . $row['name'] . "' style='width:50px;'></td>
                            <td >{$row['name']}</td>
                            <td >{$row['author_name']}</td>
                            <td >{$row['cat_name']}</td>
                            <td >{$row['description']}</td>
                            <td align='center'><button class='edit-btn' data-eid='{$row["id"]}'>Edit</button></td>
                            <td align='center'><button Class='delete-btn' data-id='{$row["id"]}'>Delete</button></td>
    
                        </tr>";
                $srno++;
            }
            $output .= "</tbody>";
        } else {
            $output .= "<tbody><tr><td colspan='5'>No records found.</td></tr></tbody>";
        }
        return $output; // Return the complete output
    }
}
?>