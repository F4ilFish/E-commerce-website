<?php
    session_start();

    require_once '../database/Product.php';
    require_once '../database/DBController.php';
    $db = new DBController();
    $product = new Product($db);

    date_default_timezone_set('Asia/Barnaul');

// Script which sending emails

    $template_file = "./MailTemplate.php";
    $product_template = "./MailProductTemplate.php";


    $email_to = $_POST['email'];
    $subject = "Your order";

    // $product_item = file_get_contents($product_template);
    $product_item = "";


    foreach ($_SESSION['cart'] ?? [] as $item){
        $cart = $product->getProductById($item);

        $swap_product = array(
            "{PRODUCT_TITLE}" => $cart[0]['product_name'],  
            "{PRODUCT_DESCRIPTION}" => $cart[0]['product_info'],
            "{PRODUCT_PRICE}" => $cart[0]['product_price']          
        );

        $product_item .= file_get_contents($product_template);

        foreach(array_keys($swap_product) as $key){
            if(strlen($key) > 2 && trim($key) != "")
                $product_item = str_replace($key, $swap_product[$key], $product_item);
        }
    }

    $swap_var = array(
        "{NAME}" => $_SESSION['user']['username'] ?? 'User',
        "{ADDRESS}" => $_POST['street'],
        "{POST_CODE}" => $_POST['postcode'],
        "{CITY}" => $_POST['city'],
        "{COUNTRY}" => $_POST['country'],
        "{ORDER_DATE}" => date('m/d/Y h:i:s a', time()),
        "{PRODUCTS}" => $product_item,
        "{SUBTOTAL}" => $_SESSION['subtotal'],
    );
    
    $headers = "From: Pillow Mart <info@pillowmart.com>\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    if(file_exists($template_file)){
        $message = file_get_contents($template_file);
    } else {
        die("unable to locate template");
    }

    foreach(array_keys($swap_var) as $key){
        if(strlen($key) > 2 && trim($key) != "")
            $message = str_replace($key, $swap_var[$key], $message);
    }
    

    mail($email_to, $subject, $message, $headers);

    header('Location: ../order_info.php');
    
    