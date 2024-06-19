<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #ddd;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            margin-right: 5px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .confirm-delete {
            color: red;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1> Gown Details</h1>
    
    <?php
    // Database connection parameters
    $servername = "localhost"; // Change this to your MySQL server hostname
    $username = "amira"; // Change this to your MySQL username
    $password = "1212"; // Change this to your MySQL password
    $database = "dbfashion"; // Change this to your MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the database
    $sql = "SELECT * FROM gown_orders"; // Change "blouse" to your table name
    $result = $conn->query($sql);

    // Display data in a table
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
            <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>{$row['id']}</td>
                <td>{$row['customer_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
                <td>
                    <a href='edit.php?id={$row['id']}' class='btn'>Edit</a>
                    <span class='btn confirm-delete' onclick='confirmDelete({$row['id']})'>Delete</span>
                </td>
            </tr>";
        }

        echo "</table>";
    } else {
        echo "No records found";
    }

    // Close connection
    $conn->close();
    ?>

    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this record?")) {
                window.location.href = "delete.php?id=" + id;
            }
        }
    </script>
</body>
</html>

