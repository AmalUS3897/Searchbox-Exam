<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lilac Infotech Exam</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            zoom: 1.2; /* Adjust the zoom level as needed */
        }
        .container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
            padding: 16px;
        }
        .box {
            border: 1px solid #ccc;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
        }
        .box div {
            margin-bottom: 8px;
        }
        #searchInput {
            width: 100%;
            padding: 8px;
            margin: 16px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .box .name, .box .department, .box .designation {
            font-weight: bold;
        }
        .box .department, .box .designation {
            font-style: italic;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
<?php
$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "exam";          

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT users.name AS user_name, departments.name AS department_name, designations.name AS designation_name 
        FROM users 
        INNER JOIN departments ON users.fk_department = departments.id 
        INNER JOIN designations ON users.fk_designation = designations.id";
$result = $conn->query($sql);

// echo "Query executed successfully?<br>";
// var_dump($result);






$rows = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
        // echo "Row data:<br>";
        // var_dump($row);
    }
} else {
    echo "No data found.";
}
$conn->close();
?>

    <h1>Search</h1>
    <input type="text" id="searchInput" placeholder="Search by Name, Department, or Designation">
    <div class="container" id="resultsContainer">
        <?php foreach ($rows as $row): ?>
            <div class="box">
                <div class="name"><?php echo htmlspecialchars($row['user_name']); ?></div>
                <div class="department"><?php echo htmlspecialchars($row['department_name']); ?></div>
                <div class="designation"><?php echo htmlspecialchars($row['designation_name']); ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        $(document).ready(function () {
            // Search functionality
            $('#searchInput').on('keyup', function () {
                var value = $(this).val().toLowerCase();
                $('#resultsContainer .box').filter(function () {
                    $(this).toggle(
                        $(this).text().toLowerCase().indexOf(value) > -1
                    );
                });
            });

            // Sort functionality
            let isAscending = true;
            $('#resultsContainer').on('click', '.box .name, .box .department, .box .designation', function () {
                var sortField = $(this).attr('class').split(' ')[0];
                var boxes = $('#resultsContainer .box').toArray().sort(comparer(sortField));
                if (!isAscending) {
                    boxes = boxes.reverse();
                }
                isAscending = !isAscending;
                $('#resultsContainer').html(boxes);
            });

            function comparer(sortField) {
                return function (a, b) {
                    var valA = $(a).find(`.${sortField}`).text().toLowerCase();
                    var valB = $(b).find(`.${sortField}`).text().toLowerCase();
                    return valA.localeCompare(valB);
                };
            }
        });
    </script>
</body>
</html>
