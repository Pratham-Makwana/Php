<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>MAin Page</title>
</head>
<body>
    <div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="mt-5 mb-3 clearfix">
                <h2 class="pull-left">Lists</h2>
                <a href="addpage.php" class="btn btn-success pull-right">Add New Data</a>
            </div>
            <?php
            require_once"database.php";

            $sql="SELECT * FROM person";
            if($result=mysqli_query($link,$sql))
            {
                if(mysqli_num_rows($result) > 0)
                {
                    echo '<table class="table table-bordered table-striped">';
                    echo '<thead>';
                    echo '<tr>';
                        echo '<th>Id</th>';
                        echo '<th>Name</th>';
                        echo '<th>Email</th>';
                        echo '<th>Salary</th>';
                        echo '<th>Action</th>';
                    echo '<tr>';
                    echo'</thead>';
                    echo'<tbody>';
                    while($row=mysqli_fetch_array($result))
                    {
                        echo '<tr>';
                        echo "<td>" . $row['id']."</td>";
                        echo "<td>". $row['name']."</td>";
                        echo "<td>". $row['email']."</td>";
                        echo "<td>". $row['salary']."</td>";
                        echo "<td>";
                        echo '<a href="updatepage.php?id='.$row['id'].' class="btn btn-success">Update</a>';
                        echo '<br>';
                        echo '<a href="deletepage.php?id='.$row['id'].' class="btn btn-danger">Delete</a>';
                        echo "<td>";
                        echo "<tr>";
                    }
                    echo "<tbody>";
                    echo "<table>";

                    mysqli_free_result($result);
                }else
                {
                    echo '<div class="alert alert-danger"><em>No record were found.</em></div>';
                }
            }else
            {
                echo "Opps somthing going wrong";
            }

            mysqli_close($link);
            ?>
            </div>
        </div>
        </div>
    </div>
</body>
</html>