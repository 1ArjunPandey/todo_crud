

<?php

$servername = "localhost";
$username = "root";
$pass = "";
$databasename = "notes";

$conn = mysqli_connect($servername, $username, $pass, $databasename);

if (!$conn) {
    die("Sorry we can't connect to server". mysqli_connect_error());
}
else{
    echo "Congo your connection is established";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['user_id'])) {
        
        $title1 = $_POST['title'];
        $snoo = $_POST['user_id'];
        $description1 = $_POST['description'];
        

        $sql1 = "UPDATE `notes` SET `description` = '$description1', `title` = '$title1' WHERE `sno` = $snoo;";
        

        $result1 = mysqli_query($conn, $sql1);
        
        
    }

    else{

    
        $title1 = $_POST['title'];
        $description1 = $_POST['description'];
        
        $sql1 = "INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, '$title1', '$description1', current_timestamp());";
        $result1 = mysqli_query($conn, $sql1);
        
    }
}

if (isset($_GET['id'])) {
    
    
    $idtd = $_GET['id'];
    // delete all

    if ($idtd == -1) {
        $sql5 = "DELETE FROM `notes`;";
        $result1 = mysqli_query($conn, $sql5);
        
        
    }

    // delete one record
    
    else {
        $sql5 = "DELETE FROM `notes` WHERE `notes`.`sno` = $idtd;";
        $result1 = mysqli_query($conn, $sql5);
        
    }

}




?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <link rel="stylesheet" href="style.css"> -->
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.container {
    max-width: 700px;
    margin: 0 auto;
    padding: 20px;
    padding-top: 10px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.container h1 {
    text-align: center;
    margin-bottom: 40px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-weight: bold;
}

.form-group input[type="text"],
.form-group textarea {
    font-size: 18px;
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.submit-btn {
    display: block;
    width: 100%;
    padding: 10px;
    background: none;
    color: rgb(73, 73, 206);
    border: 2px solid rgb(73, 73, 206);
    /* border: none;
    border-radius: 5px; */
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.submit-btn:hover {
    background-color: rgb(73, 73, 206);
    color: white;
}

.closee{
    background-color: rgb(73, 73, 206);
    color: white;
}







table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border-bottom: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #f5f5f5;
}

td button{
    display: block;
    width: 40%;
    margin: 2px;
    /* margin-left: 10px; */
    padding: 10px;
    background-color: #295bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
    
}

td form{
    display: none;
}




tbody tr td:nth-child(1){
    text-align: center;
    width: 5%;
}

tbody tr td:nth-child(2){
    text-align: center;
    width: 10%;
}

tbody tr td:nth-child(3){
    /* text-align: center; */
    width: 35%;
}

tbody tr td:nth-child(4){
    text-align: center;
    width: 10%;
}

tbody tr td:nth-child(5){
    align-items: center;
    width: 12%;
}




thead th:nth-child(1){
    text-align: center;
    width: 5%;
}

thead th:nth-child(2){
    text-align: center;
    width: 10%;
}

thead th:nth-child(3){
    text-align: center;
    width: 35%;
}

thead th:nth-child(4){
    text-align: center;
    width: 10%;
}

thead th:nth-child(5){
    /* text-align: center; */
    
    width: 12%;
}


.adel{
    display: block;
    width: 100%;
    margin: 2px;
    /* margin-left: 10px; */
    padding: 10px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
    
    
}
.delet{
    background-color: rgb(244 55 55);
}

</style>
<title>Form with Stylish Submit Button</title>
</head>
<body>

<div class="container">
    <h1>ToDo Crud App</h1>
    <form action="/todo_crud/index.php" method="post">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>
        <button type="submit" class="submit-btn">Submit</button>
    </form>
    <button class="delet adel" onclick="editClose()">DELETE ALL</button>

</div>

<div>
    
<table>
    <thead>
        <tr>
            <th>S.No</th>
            <th>Title</th>
            <th>Description</th>
            <th>Time</th>
            <th>Action</th>
            <th>Update</th>
        </tr>
    </thead>
    <tbody>
        <?php

        $sql = "SELECT * FROM `notes`";
        $result =  mysqli_query($conn, $sql);
        $ss = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
            <td>". $ss++ ."</td>
            <td>". $row['title']. "</td>
            <td>". $row['description']. "</td>
            <td>". $row['tstamp']. "</td>"
            . '<td><button class="editt" onclick="editClicked(this)">Edit</button><button class="delet" onclick="deleteRecord('. $row['sno']. ')">Delete</button></td>'.

            '<td><form action="/todo_crud/index.php" method="post">
            <input type="hidden" name="user_id" value = '. $row['sno'] .'>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <button type="submit" class="submit-btn fbut1">Submit</button>
            </form>
            
    <td>'


        ."</tr>";

        }
        ?>

        
        <!-- <tr>
            <td>1</td>
            <td>Sample Title 1</td>
            <td class="desc">Description 1 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro adipisci praesentium explicabo ipsam deserunt modi quae veritatis voluptate autem vitae.</td>
            <td>Description 1</td>
            <td><button>Edit</button><button>Delete</button></td>
        </tr> -->
        <!-- Add more rows as needed -->
    </tbody>
</table>

</div>

</body>



<script>
    function editClicked(button) {
        var parentCell = button.parentNode.parentNode; 
        var form = parentCell.querySelector('form');

        if (form.style.display == "block") {
            form.style.display = "none"
        }
        else{

            var input = parentCell.getElementsByTagName("td")[1];
            form.getElementsByTagName("input")[1].value =  input.innerText;
    
            
            var input2 = parentCell.getElementsByTagName("td")[2];
            form.getElementsByTagName("textarea")[0].value =  input2.innerText;

            form.style.display = "block"
        }

    }

    function editClose() {
        var result = window.confirm(`------Warning------ \nConfirm to delete ALL record ?`);
    
        if(result){
            var id1 = -1;
            window.location.href = 'index.php?id=' + id1;
        }
        
    }


    function deleteRecord(id) {
        var result = window.confirm(`------Warning------ \nConfirm to delete record ?`);

        if(result){

            window.location.href = 'index.php?id=' + id;
        }

    }




</script>
</html>
