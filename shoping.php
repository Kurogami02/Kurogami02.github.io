<?php
    require "ketnoi.php";
?>
<?php
    session_start();

    if(isset($_POST["action"])){
        if($_POST["action"] == "delete_all"){
            unset($_SESSION["giohang"]);
            header("location: index.php");
        }
    }

    if(isset($_POST["delete"])){
        unset($_SESSION["giohang"][$_POST["delete"]]);
        // echo '"'. $_POST["delete"] .'"';
        // print_r($_SESSION["giohang"]);
        // exit();
    }

    $query = null;
    if(isset($_SESSION["giohang"])){
        $sql = "SELECT * FROM sanpham WHERE id in (". implode(",", $_SESSION["giohang"]) . ")";
        $query=mysqli_query($conn,$sql);
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BWtech</title>
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
      <link rel="stylesheet" href="./assets/css/styles.css">
      <script src="./assets/slider/slider.js"></script>
</head>
<body>
    <div class="main">
        <div class="main-box">
            <div class="header">
                <div class="logo">
                    <div class="bt">
                            <a href="index.php"><img src="./assets/img/logo.PNG" alt=""></a>
                    </div>
                </div>
                <div class="searchbar">
                    <form action="sanpham.php" method="POST">
                        <input type="text" name="txtsearch"/>
                            <button type="submit" name="search">
                                <i class="fas fa-search"></i>
                            </button>
                    </form>
                </div>
                <div class="icon-shoping">
                    <a href="shoping.php"><i class="fas fa-shopping-cart"></i></a>
                </div>
                <div class="sign">
                    <ul>
                        <?php if($_SESSION["ttnd"]=="test"){?>
                            <li><a href="signup.php">????ng k??</a></li>
                            <li><a href="login.php">????ng nh???p</a></li>
                        <?php }?>
                        <?php if($_SESSION["ttnd"]=="admin"){?>
                            <li><strong>admin</strong></li>
                            <li><a href="login.php">????ng xu???t</a></li>
                        <?php }?>
                        <?php if($_SESSION["ttnd"]==""){?>
                            <li><strong>user</strong></li>
                            <li><a href="login.php">????ng xu???t</a></li>
                        <?php }?>
                    </ul>
                </div>
           </div>
           <div class="header-bottom">
                <ul class="nav">
                    <li><a href="laptop.php">Laptop</a>
                        <ul id="subnav">
                            <li><a href="">Laptop v??n ph??ng</a></li>
                            <li><a href="">Laptop gaming</a></li>
                            <li><a href="">Laptop doanh nghi???p</a></li>
                            <li><a href="">Laptop gi?? r???</a></li>
                        </ul>
                    </li>
                    <li><a href="phone.php">??i???n tho???i</a>
                        <ul id="subnav-a">
                            <li><a href="">Iphone</a></li>
                            <li><a href="">Samsung</a></li>
                            <li><a href="">Oppo</a></li>
                            <li><a href="">Xiaomi</a></li>
                            <li><a href="">Oneplus</a></li>
                        </ul>
                    </li>
                    <li><a href="linh-kien-pc.php">Linh ki???n PC</a>
                        <ul id="subnav-v">
                            <li><a href="">Mainboard</a></li>
                            <li><a href="">CPU - Vi x??? l??</a></li>
                            <li><a href="">VGA - Card ????? h???a</a></li>
                            <li><a href="">??? c???ng</a></li>
                            <li><a href="">RAM - B??? nh??? ?????m</a></li>
                            <li><a href="">PSU - Ngu???n</a></li>
                        </ul>
                    </li>
                    <li><a href="phu-kien.php">Ph??? ki???n</a>
                        <ul id="subnav-p">
                            <li><a href="">??i???n tho???i</a></li>
                            <li><a href="">Laptop</a></li>
                            <li><a href="">Chu???t</a></li>
                            <li><a href="">B??n ph??m</a></li>
                            <li><a href="">Tai nghe</a></li>
                        </ul>
                    </li>
                    <li><a href="news.php">Tin c??ng ngh???</a></li>
                    <li><a href="contact.php">Li??n h???</a></li>
                    <!-- Phan quyen admin -->
                    <?php if($_SESSION["ttnd"]=="admin"){?>
                    <li><a href="admin.php">Qu???n l?? s???n ph???m</a></li>
                    <?php }?>
                </ul>
           </div>
        </div>
            <form action="" method="post" id="shoping-form">
        <div class="content">
                        <?php if(!empty($query)){?>
                <span><h2 class="header-page">Gi??? h??ng</h2></span>
                        <table class="shopping-table">
                            <tr>
                                <th class="shoping-img">S???n Ph???m</th>
                                <th class="shoping-name">T??n S???n Ph???m</th>
                                <th class="shoping-pr">Gi?? ti???n</th>
                                <th class="shoping-num">S??? l?????ng</th>
                                <th class="shoping-del"></th>
                            </tr>
                            <?php
                            ?>
                            <?php
                                
                               while($row=mysqli_fetch_array($query)){
                            ?>
                            <tr>
                                <td class="shoping-img"><img class="product-img" src="<?php echo $row["anh"]; ?>" alt=""></td>
                                <td class="shoping-name"><div class="product-name"><?php echo $row["tensp"]; ?></div></td>
                                <td class="shoping-pr"><div class="product-pr"><?php echo $row["gia"]; ?></div></td>
                                <td class="shoping-num"><input type="number" value="<?php echo $soluong[$row["id"]] = 1; ?>" /></td>
                                <td class="shoping-del"><button name="delete" value="<?php echo $row["id"]; ?>">X??a</button></td>
                            </tr>
                            <?php }?>
                            
                        </table>
                            <div class="shopping-acp"><button name="action" value="delete_all">Thanh To??n</button></div>
        </div>
        <?php } else {?>
            <div class="no-product">
                <h2 class="header-page">Hi???n kh??ng c?? s???n ph???m n??o trong gi??? h??ng</h2>
                <a href="index.php">Quay l???i</a>
            </div>
        <?php } ?>
            </form>
    <div id="footer">
        <div class="bottom">
            <!--Begin #footer-info-->
            <div id="footer-info">
                <p class="st"><Strong>BlackWhite team's project</Strong></p>
                <p><strong>L. Khanh: </strong>Production leader & Desiner</p>
                <p><Strong>Dr. Hoan: </Strong>Front-end maker</p>
                <p><Strong>Nghia 64: </Strong>Back-end maker</p>
                <p><Strong>DQ Phuc: </Strong>Content Maker</p>
                <p><Strong>Thien HC: </Strong>Tester & Content maker</p>
            </div>
            <!--End #footer-info-->
            <!--Begin #footer-right-->
            <div id="footer-right">
                <p><strong>Contact with us:</strong></p>
                <ul>
                    <li><img src="./assets/img/github.png" alt="" class="footer-img"><a href="https://github.com/BlackWhite05">BW's github</a></li>
                    <li><img src="./assets/img/gmail.png" alt="" class="footer-img"><a href="https://mail.google.com/">Our email</a></li>
                    <li><img src="./assets/img/facebook.png" alt="" class="footer-img"><a href="https://www.facebook.com/">Our page</a></li>
                </ul>
            </div>
            <!--End #footer-right-->
        </div>
    </div>
    <!--End #footer-->
    <div id="copyright">
        <p>?? 2021 BlackWhite team, All Rights Reserved</p>
    </div>
</body>
</html>