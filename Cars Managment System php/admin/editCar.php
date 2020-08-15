<?php
   
   $host = "localhost";
   $dbUsername = "root";
   $dbPassword = "";
   $dbname = "cars";
   //create connection
   $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
   
   if (mysqli_connect_error()) {
    die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
   }
 $id=$_GET['id'];
  
$query="SELECT * FROM cars WHERE id=$id";
$result = mysqli_query($conn,$query);   
 $row= $result->fetch_assoc();
  $manufacturer=$row["manufacturer"];
 $model=$row["model"];
 $price=$row["price"];
 $image=$row["image"];

 $success_alert='
 <div class="col-12">
      <div class="alert alert-success"><h4>Success</h4></div>
 </div>
';

$fault_alert='
 <div class="col-12">
      <div class="alert alert-danger"><h5>Fault-Check the entered values</h5></div>
 </div>
';



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Page Title</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="https://bootswatch.com/4/materia/bootstrap.min.css">
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Online Shopping System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#"><span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item"><a class="nav-link"></a></li>
                <li class="nav-item"><a class="nav-link"></a></li>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <a class="p-cart">
                   
                </a>
                <a href="http://localhost/m/Cars%20Managment%20System%20php/admin/viewCars.php" class="btn btn-secondary my-2 my-sm-0 ml-4">go back</a>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top:100px">
        <br />
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Edit Product</h4>
                        <hr />
                        <?php
                        $msg = "";
                        if($_SERVER['REQUEST_METHOD'] == "POST"){
                            if(isset($_POST['manufacturer']) && isset($_POST['model']) && isset($_POST['price'])&& isset($_FILES['image']['name']) ){
                              $manufacturer=$_POST['manufacturer'];
                              $model=$_POST['model'];
                              $price=$_POST['price'];
                              $image = $_FILES['image']['name'];
                              $target = "images/".basename($image);
            
                             
                               
                            if(!empty($manufacturer) && !empty($model) && !empty($price)&& !empty($image)){
                            
                                       $updatequery="UPDATE cars SET manufacturer='$manufacturer',model='$model',price=$price,image='$image'          
                                       WHERE id=$id";
                                       $result = mysqli_query($conn,$updatequery); 
                                       if($result != false){
                                        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                                        echo $success_alert;
                                        }
                                       }else{
                                        echo $fault_alert;
                                       }
                            } else {
                                  
                                  echo $fault_alert;
                                }
                               }
                            
                            
                            
                            
                            }
                           
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="" enctype="multipart/form-data">
                        <input type="hidden" name="size" value="1000000">

                            <div class="form-group row">
                                <label for="manufacturer" class="col-4 col-form-label">manufacturer</label>
                                <div class="col-8">
                                    <input id="manufacturer" name="manufacturer" placeholder="manufacturer" class="form-control here"
                                        type="text" value="<?php echo $manufacturer; ?>"/>
                                    <div class="valid-feedback">Looks good!</div>

                                    <div class="invalid-feedback">Please manufacturer is required.</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="model" class="col-4 col-form-label">model</label>
                                <div class="col-8">
                                    <input id="model" name="model" placeholder="model" class="form-control here"
                                        type="text" value="<?php echo $model ; ?>"/>
                                    <div class="valid-feedback">Looks good!</div>

                                    <div class="invalid-feedback">
                                        Please title is required.
                                    </div>
                                </div>
                            </div>
                          
                            <div class="form-group row">
                                <label for="time" class="col-4 col-form-label">Price</label>
                                <div class="col-8">
                                    <input id="price" name="price" placeholder="price" class="form-control here"
                                        type="number" value="<?php echo $price; ?>" />
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">
                                        Please Price is required.
                                    </div>
                                </div>
                            </div>

                         

                            <div class="form-group row">
                                <label for="image" class="col-4 col-form-label">image</label>
                                <div class="col-8">
                                <input id="image" name="image" placeholder="Image "
                                        class="form-control here" type="file" />
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">
                                        Please image is required.
                                    </div>
                                </div>
                            </div>

                     
                            <div class="form-group row">
                                <div class="offset-4 col-8">
                                    <button name="submit" type="submit" class="btn btn-primary">
                                       Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© 2017-2019 Maba</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
    </div>
</body>

</html>