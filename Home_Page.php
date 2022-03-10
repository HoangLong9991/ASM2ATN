<?php
session_start();
include("connect_db.php");
$role = $_SESSION["role"];
include("Function.php");
set_time_and_set_shop();
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="db_mng.css">

<body>
    <div class="header">
        <h1> ATN DATABASE </h1>
    </div>
    <div class="body">
        <?php
if($role=="Admin")
{
?>

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="refresh" content="<?php echo $_SESSION["refresh"];?> ;URL="https://asmcloudcomputing2022.herokuapp.com/Home_Page.php"">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- 	<link rel="stylesheet" href="login.css"> -->
            <title>Document</title>
        </head>
        <div id="main">
            <div class="select-div">
                <form action="" method="post">
                    <div id="sub">
                        <div>
                            <select name="refresh_time">
                                <option value="5">5 second</option>
                                <option value="10">10 second</option>
                                <option value="20">20 second</option>
                            </select>
                        </div>
                        <div><input type="submit" class="choose" name="submit_time" value="Set time"></div>
                    </div>
                </form>
            </div>
            <div class="select-div">
                <form action="" method="post">
                    <div id="sub">
                        <div>
                            <select name="shop">
                                <option value="ShopA">Shop A</option>
                                <option value="ShopB">Shop B</option>
                                <option value="All_Shop" selected>All Shop</option>
                            </select>
                        </div>
                        <div><input type="submit" class="choose" name="selected_shop" value="Select Shop"></div>
                    </div>
                </form>
            </div>
        </div>
        <?php
    $selected_shop = $_SESSION["selected_shop"];
    if($selected_shop=="All_Shop")
    {
        $query = "SELECT * FROM product1";
    }
    else
    {
        $query = "SELECT * FROM product1 WHERE  shopname = '$selected_shop'";
    }
    $result = pg_query($dbconn, $query);
    display_table_admin($result);
}
else
{
    $query = "SELECT * FROM product1 WHERE  shopname= '$role'";
    $result = pg_query($dbconn, $query);
    display_table_shop($result);
    echo"<h2> Insert Product </h2>";
    echo "<form  method='post' class='form'>";
    $num_field = pg_num_fields($result);
    for ($i=1;$i<$num_field;$i++){
        $field_name = pg_field_name($result,$i);    
	    echo "<p> $field_name </p>";
            echo "<input class='input-box' type='text' placeholder=$field_name name=$field_name ></br>";
    }
    echo "<input type='submit' value='insert' name='insert'></br>";
    echo "</form>";
	?>
	<article class="footer-containers">
			<div class="grid">
				<div class="grid-row">
					<div class="grid-column-footer">
						<h3 class="footer-header">Contact</h3>
						<ul class="footer-list">
							<li class="footer-item"><a href="https://www.facebook.com/Sneaker-Store-106449377525986">Facebook</a></li>
							<li class="footer-item"><a href="">Instagram</a></li>
							<li class="footer-item"><a href="">Zalo</a></li>
						</ul>
					</div>
					<div class="grid-column-footer">
						<h3 class="infor">Introduce</h3>
                        <p class="address">Address 1: 38 Phước Mỹ 1, Sơn Trà, Đà Nẵng</p>
						<p class="address">Address 2: 119 Văn Tiến Dũng, Sơn Trà, Đà Nẵng</p>
                        <p class="hotline">Hotline: 0985959912</p>
					</div>
				</div>
			</div>
		</article>
<?php
}
?>
    </div>
    <div class="footer">
        <div><a href="logout.php"> Logout</a><br /></div>
    </div>
</body>

</html>
