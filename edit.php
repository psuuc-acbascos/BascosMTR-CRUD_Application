<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        #round {
            max-width: 100px;
            max-height: 100px;
            margin: 0 auto 20px;
            display: block;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            margin: 6px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-check-label {
            font-weight: normal;
        }

        .text-center {
            text-align: center;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .mb-3 {
            margin-bottom: 15px;
        }

        .mb-5 {
            margin-bottom: 25px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Contact</h1>
        <?php
        require 'config.php';
        $id = 0;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        $stmt = "SELECT * FROM contactinfo WHERE contactID=$id";
        $container = $conn->query($stmt);
        while ($data = $container->fetch_assoc()) {
        ?>
        <form action="edit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="text-center mb-4">
                <div id="round" name="imgholder">
                    <img src="images/<?php echo $data['image']; ?>" alt="Profile Picture" height="100px">
                </div>
                <label for="picture" class="form-label">Picture</label>
                <input type="file" class="form-control" id="picture" name="picture" accept="image/jpeg, image/jpg, image/png" required>
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $data['firstname']; ?>" pattern="[A-Za-z]+" title="Please enter a valid first name (letters only)" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $data['lastname']; ?>" pattern="[A-Za-z]+" title="Please enter a valid last name (letters only)" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $data['address']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Sex</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="male" name="sex" value="Male" <?php if ($data['sex'] == 'Male') echo 'checked'; ?> required>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="female" name="sex" value="Female" <?php if ($data['sex'] == 'Female') echo 'checked'; ?>>
                    <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="other" name="sex" value="Other" <?php if ($data['sex'] == 'Other') echo 'checked'; ?>>
                    <label class="form-check-label" for="other">Other</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="number" class="form-control" id="mobile" name="mobile" value="<?php echo $data['number']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $data['email']; ?>" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn" name="update">Update Contact</button>
            </div>
        </form>
     </div>
        <?php
    }
        ?>
        <?php
        function sanitize($inputData) {
            foreach ($inputData as &$value) {
                $value = trim($value);
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                $value = stripslashes($value);
            }
            return $inputData;
        }
            if(isset($_POST['update'])){
        
        $inputData = array(
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'address' => $_POST['address'],
            'mobile' => $_POST['mobile'],
            'email' => $_POST['email']
        );
        $Imagename=$_FILES['picture']['name'];
        $Imagetype=$_FILES['picture']['type'];
        $Imagesize=$_FILES['picture']['size'];
        $tmp_name=$_FILES['picture']['tmp_name'];
        
        $sanitizedData = sanitize($inputData);
        
        $id=$_POST['id'];
        $firstname = $sanitizedData['firstname'];
        $lastname = $sanitizedData['lastname'];
        $address = $sanitizedData['address'];
        $sex=$_POST['sex'];
        $Ssex="";
        if($sex=="Male"){
            $Ssex="Male";
        }
        else if($sex=="Female"){
            $Ssex="Female";
            
        }
        else if($sex=="Other"){
            $Ssex="Other";
        }
        $mobile = $sanitizedData['mobile'];
        $email = $sanitizedData['email'];
            require 'config.php';
            if(move_uploaded_file($tmp_name, 'images/' . $Imagename)){
                $stmt = "UPDATE contactinfo SET image='$Imagename' WHERE contactID=$id";
                $container=$conn->query($stmt) or die("Could not perform $stmt");

                
            }
            else {
                echo "error";
            }
        
$stmt = "UPDATE contactinfo SET firstname='$firstname', lastname='$lastname', address='$address', sex='$Ssex', number='$mobile', email='$email' WHERE contactID=$id";
                    $container=$conn->query($stmt) or die("Could not perform $stmt");
                    echo "<script>Swal.fire(
                        'Good job!',
                        'The record has been updated!',
                        'success'
                      )</script>";
                      header("Refresh:2;url= formdisplay.php");
            }
          
        ?>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>