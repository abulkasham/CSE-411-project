<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>categories</title>
</head>
<body>
    <?php include('header.php')?>
    <?php include('connect.php')?>
    <?php
    
        error_reporting(0);
        $catid = $_GET['catid'];
        $sql = "SELECT `catid`, `name` FROM `categories` where catid = '$catid'";
        $rs = mysqli_query($con,$sql);
        $catdata = mysqli_fetch_array($rs);
        
        $delid = $_GET['delid'];
        $sql1 ="delete from categories where catid = '$delid'";
        mysqli_query($con,$sql1);
    
    ?>
    <div class="container1"class="Rana">
        <div class="row">
            <div class="col-lg-4">
            <div class="login-content">
                    <form action='categories.php' method='post'>
                        <div class="section-title">
                            <h3>Categories</h3>
                        </div>
                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-user"></i></span>
                                <input type="hidden" name="cid" value="<?=$catdata['catid']?>">
                                <input type="text" required="required"
                                 value="<?=$catdata['name']?>"
                                name="Name"
                                class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="login-btn">
					   <input type="submit" name ="addcat"value="Add Category">
                       <input type="submit" name ="updatecat"value="Update">
					</div>
                     </form>
                     
					
                </div>

            </div>
            <div class="col-lg-8">
                <table calss="table">
                    <tr>
                        <th>ID &nbsp;</th>
                        <th>&nbsp;Name &nbsp;</th>
                        <th>&nbsp;Action</th>
                    </tr>
                    <?php
                        $sql = "SELECT `catid`, `name` FROM `categories`";
                        $rs = mysqli_query($con,$sql);
                        while($data = mysqli_fetch_array($rs)){

                        
                        ?>
                    <tr>
                        <td><?= $data['catid']?></td>
                        <td><?= $data['name']?></td>
                        <td>
                            <a href="categories.php?catid=<?= $data['catid'] ?>" class="btn btn-primary">Edit</a>
                            <a href="categories.php?delid=<?= $data['catid'] ?>" class="btn btn-primary">Delete</a>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <?php include('footer.php')?>
</body>
</html>
<?php
if(isset($_POST['addcat'])){
   $catname=$_POST['Name'];
   if(mysqli_query($con,"INSERT INTO `categories`(`name`) VALUES ('$catname')")){
       echo"<script> alert('record inserted')</script>";
   }
   else{
    echo"<script> alert('record not inserted')</script>";
   }
}


//update code

if(isset($_POST['updatecat'])){
    $cid = $_POST['cid'];
    $catname=$_POST['Name'];
    if(mysqli_query($con,"UPDATE `categories` SET `name`='$catname' WHERE catid ='$cid'")){
        echo"<script> alert('record updated')</script>";
    }
    else{
     echo"<script> alert('record not updated')</script>";
    }
 }