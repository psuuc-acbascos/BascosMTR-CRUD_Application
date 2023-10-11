<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .custom-button {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        #delete, #edit {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        #round {
            height: 100px;
        }

        .picture-input {
            display: none;
        }

        .picture-label {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .picture-label:hover {
            background-color: #0056b3;
        }
        #myTable {
        width: 100%; /* Set the width to 100% to match the form width */
        border-collapse: collapse;
        margin-top: 20px;
    }

    #myTable th, #myTable td {
        padding: 8px;
        text-align: left;
    }

    #myTable th {
        background-color: #007bff;
        color: white;
    }

    #myTable tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #myTable tr:hover {
        background-color: #d9edf7;
    }

    /* Adjust column widths if needed */
    #myTable th:first-child,
    #myTable td:first-child {
        width: 10%;
    }

    #myTable th:last-child,
    #myTable td:last-child {
        width: 15%;
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Y6yymIvR6vZYq1cIwJphfXnYrr3IMBkEOm5mzVa8SeFez3B" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script>
    $(function(){
$("#myTable").DataTable();
    });
</script>
</head>
<body>
<div class="container mx-auto">
        <h1 class="mb-4">Contact Manager</h1>
        <form action="add.php" method="POST" enctype="multipart/form-data">
       
        <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" pattern="[A-Za-z]+" title="Please enter a valid first name (letters only)"  required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname"  pattern="[A-Za-z]+" title="Please enter a valid last name (letters only)" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address"   required>
            </div>
            <div class="mb-3">
    <label class="form-label">Sex</label><br>
    <input type="radio" id="male" name="sex" value="Male" required>
    <label for="male">Male</label><br>
    <input type="radio" id="female" name="sex" value="Female">
    <label for="female">Female</label><br>
    <input type="radio" id="other" name="sex" value="Other">
    <label for="other">Other</label><br>
</div>

            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="number" class="form-control" id="mobile" name="mobile" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
            <div id="round" name="imgholder" class="mb-5"></div>
                <label for="picture" class="form-label">Picture</label>
                <input type="file" class="form-control" id="picture" name="picture" accept="image/jpeg, image/jpg, image/png" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" name="add">Add Contact</button>
            </div>
        </form>
    </div>
    
    <hr>
    

    <table id="myTable" class="display">
    <thead>
        
        <tr>
        <th>CONTACT ID</th>
            <th>FIRSTNAME</th>
            <th>LASTNAME</th>
            <th>ADDRESS</th>
            <th>SEX</th>
            <th>MOBILE NUMBER</th>
            <th>EMAIL ADDRESS</th>
            <th>PICTURE</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
       
    <?php
        require 'config.php';
        $stmt="SELECT * FROM contactinfo";
        $container=$conn->query($stmt);
        while($data=$container->fetch_assoc()){

        
        ?>
         <tr>
         <td><?php echo $data['contactID'] ?></td>
         <td><?php echo $data['firstname'] ?></td>
         <td><?php echo $data['lastname'] ?></td>
         <td><?php echo $data['address'] ?></td>
         <td><?php echo $data['sex'] ?></td>
         <td><?php echo $data['number'] ?></td>
         <td><?php echo $data['email'] ?></td>
         <td>
         <img src="images/<?php echo $data['image']; ?>" alt="Profile Picture" height="100px">


</td>
        <td>
<?php
        echo '<a href="edit.php?id=' . $data['contactID'] . '"> <button class="btn btn-primary " id="edit">Edit</button></a>';  
        echo '<a href="delete.php?id=' . $data['contactID'] . '"><button class="btn btn-danger " id="delete">Delete</button></a>';

?>

        </td>
         </tr>
     <?php  
    }
    $container->free_result();
    $conn->close();
    ?>
    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const imageInput = document.getElementById("picture");
    const roundDiv = document.getElementById("round");

    imageInput.addEventListener("change", function () {
        const file = imageInput.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement("img");
                img.src = e.target.result;
                img.style.maxWidth = "100px"; // Set maximum width
                img.style.maxHeight = "100px"; // Set maximum height
                roundDiv.innerHTML = ""; // Clear any previous content
                roundDiv.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });
});


</script>
</body>
</html>