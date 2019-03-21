<?php
   
    session_start();
    require_once("../db/db.php");
?>
<?php
    if(isset($_POST["order"]))
    {
    	if(empty($_POST["email"]) || empty($_POST["username"]) || empty($_POST["phone"])) 
    	{
    		die("Не заполнены поле(я) формы");
    	};
    	if(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL) && preg_match_all("/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/", $_POST["phone"]))
    	{
    		$email = htmlspecialchars($_POST["email"]);
    	    $username = htmlspecialchars($_POST["username"]);
    	    $phone = htmlspecialchars($_POST["phone"]);
            $connect->query("INSERT INTO `order` (username,phone,email) VALUES ('$username','$phone','$email')");
            $lastId = $connect->query("SELECT MAX(id) FROM `order` WHERE email='$email'");
            $lastId = $lastId->fetch(PDO::FETCH_ASSOC);
            $message = 
            "
                <h2>Здравствуйте, ваш заказ под номером {$lastId['MAX(id)']} принят</h2>
            ";
            $message .= "<h3>Состав заказа</h3>";
            foreach($_SESSION["cart"] as $product) 
            {
            	$message .= "<div>{$product["rus_name"]} в кол-ве {$product["quantity"]}</div>";
            };
            $message .= "<p>Сумма заказа: {$_SESSION["totalPrice"]} рублей</p>";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
            $subject = "Ваш заказ под номером {$lastId['MAX(id)']} принят";
            mail($email, $subject, $message, $headers);
            $messageOwner = "<h2>Заказ под номером {$lastId['MAX(id)']} оформлен</h2>";
            $messageOwner .= "<h3>Состав заказа</h3>";
            foreach($_SESSION["cart"] as $product) 
            {
            	$messageOwner .= "<div>{$product["rus_name"]} в кол-ве {$product["quantity"]}</div>";
            };
            $messageOwner .= "<p>Сумма заказа: {$_SESSION["totalPrice"]} рублей</p>";
            $subjectOwner = "Информация о заказе покупателя для владельца";
            mail("sup.isak@mail.ru",$subjectOwner,$messageOwner,$headers);
            unset($_SESSION["totalPrice"]);
            unset($_SESSION["totalQuantity"]);
            unset($_SESSION["cart"]);
            $_SESSION["order"] = $lastId["MAX(id)"];
            header("Location: {$_SERVER['HTTP_REFERER']}");
    	} else
    	{?>
    		<meta charset="utf-8">
    	<?php
    		die("Неверный формат почты и(или) телефона");
    	}
    }
?>