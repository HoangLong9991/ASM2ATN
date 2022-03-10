<?php

    if ($_SERVER["REQUEST_METHOD"]=="POST")
    {
        if (isset($_POST['update'])){
            $nameProduct = $_POST["nameproduct"];
            $priceProduct = $_POST["priceproduct"];
            $quantityProduct = $_POST["quantityproduct"];
            $descriptionProduct = $_POST["description"];
            $query = "SELECT * FROM product1 WHERE nameproduct = '$nameProduct' AND shopname = '$role';";
            $result = pg_query($dbconn, $query);
            
            if(pg_affected_rows($result) == 1){
                if( $nameProduct != null && $priceProduct != null && $quantityProduct != null && $descriptionProduct != null){
                    $query = "UPDATE product1 SET nameproduct = '$nameProduct',priceproduct = $priceProduct,
                    quantityproduct = $quantityProduct, description = '$descriptionProduct'
                    WHERE  nameproduct = '$nameProduct';";
                    $result = pg_query($dbconn, $query);
                }
                    else echo "<script> alert('Please enter full field')</script>";
                } 
            else echo "<script> alert('Product does not exist.')</script>";  
        }
        if (isset($_POST['delete'])){
            $nameproduct = $_POST["nameproduct"];
            $query = "DELETE FROM product1 WHERE  nameproduct = '$nameproduct'";
            $result = pg_query($dbconn, $query);
            if(pg_affected_rows($result) == 1){
                echo "<script> alert('Delete product success.')</script>";  
                $nameproduct = "";
                $_POST["nameproduct"] = "";
            }
            else{ 
                echo "<script> alert('Delete product failed')</script>";  
            }
        }
        if (isset($_POST['insert'])){
            $nameProduct = $_POST["nameproduct"];
            $priceProduct = $_POST["priceproduct"];
            $quantityProduct = $_POST["quantityproduct"];
            $descriptionProduct = $_POST["description"];
            $query = "SELECT * FROM product1 WHERE nameproduct = '$nameProduct' AND shopname = '$role';";
            $result = pg_query($dbconn, $query);
                if(pg_affected_rows($result) < 1){
                    if($nameProduct != null && $priceProduct != null && $quantityProduct != null 
                    && $descriptionProduct != null){
                
                    $query = "INSERT INTO product1 VAlUES ('$role', '$nameProduct', $priceProduct, $quantityProduct, '$descriptionProduct')";
                    $result = pg_query($dbconn, $query);
                
                        if(pg_affected_rows($result) < 1){   
                            echo "<script> alert('Insert product failed')</script>";  
                        }
                    }
                    else echo "<script> alert('Please enter full field Or your shop')</script>";
                }
                else echo "<script> alert('Product already exists')</script>";
        }
    }


function display_table_admin($query_object)
    {   
            echo"<table border = 1>";
            echo "<tr>";
            $num_field = pg_num_fields($query_object);
            for ($i=0;$i < $num_field; $i++)
            {   
                $field_name = pg_field_name($query_object, $i);
                echo "<th>$field_name</th>";
            }          
                echo "</tr>";

            $num_row=pg_num_rows($query_object);
            for ($j=0;$j<$num_row;$j++){
                $row=pg_fetch_array($query_object,$j);
                echo "<tr>";
                echo "<form action='' method='post'>";
                for ($i=0;$i<$num_field;$i++){
                    $field_name = pg_field_name($query_object,$i);
                    $field_value = $row[$field_name];
                    echo "<td>$field_value</td>";
                }
                echo "</form>";
                echo "</tr>";
            }
    }   

function display_table_shop($query_object)
    {
        echo "<table border=1>";
        echo "<tr>";

        $num_field = pg_num_fields($query_object);
        for ($i=0;$i < $num_field; $i++)
        {   
            $field_name = pg_field_name($query_object, $i);
            echo "<th class = 'field'>$field_name</th>";
        }          
            echo "</tr>";
        $num_row=pg_num_rows($query_object);
        for ($j=0;$j<$num_row;$j++){
            $row=pg_fetch_array($query_object,$j);
    
            echo "<tr>";
            echo "<form action='' method='post'>";
            for ($i=0;$i<$num_field;$i++){
                $field_name = pg_field_name($query_object,$i);
                $field_value = $row[$field_name];
                if ($field_name=='product' || $field_name=='shopname')
                    echo "<td><input class='fieldname' type='text' name='$field_name' value= '$field_value' readonly></td>";
                else
                    echo "<td><input class='fieldname' type='text' name='$field_name' value='$field_value'></td>";
                
            }
            echo "<td><input type='submit' value='Update' name='update'></td>";
            echo "<td><input type='submit' value='Delete' name='delete'></td>";
            echo "</form>";
            echo "</tr>";
        }
        
        echo "</table>";
    }
    function set_time_and_set_shop(){
        $page = $_SERVER['PHP_SELF'];
        
        if(isset($_POST["submit_time"]))
        {
            $_SESSION["refresh"] = $_POST["refresh_time"];
        }
    
        if(isset($_POST["selected_shop"]))
        {
            $_SESSION["selected_shop"] = $_POST["shop"];
        }
    }

?>
