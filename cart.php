<?php
    session_start(); 
    require_once("header.php");
    if(isset($_SESSION["order"]))
    {?>
        <h2 class="cart-title">Ваш заказ под номером <?php echo $_SESSION['order'] ?> принят</h2>
        <a href="index.php" class="back">На главную</a>
    <?php
        unset($_SESSION["order"]);
    } else {
    if(count($_SESSION["cart"])>0)
    {
    foreach($_SESSION["cart"] as $key=>$product)
    {
?>
        <div class="cart">
            <a href="product.php?product=<?php echo $product["title"] ?>"><img src="img/<?php echo $product['img'] ?>" alt="Фото"></a>
            <div class="cart-descr">
                <?php echo $product["rus_name"] ?> в количестве <?php echo $product["quantity"] ?> шт на сумму <?php echo ($product["price"]*$product["quantity"]) ?> рублей
            </div>
            <form action="actions/delete.php" method="post">
                <input type="hidden" name="delete" value="<?php echo $key ?>">
                <input type="submit" name="" value="Удалить">
            </form>
        </div>
    <?php };} else
    {
        echo "<em>Ваша корзина пуста</em>";
    } ?>
    <hr>
    <form action="actions/mail.php" method="post" class="order">
            <input type="text" name="username" required placeholder="Ваше имя">
            <input type="text" name="phone" required placeholder="Ваш телефон">
            <input type="text" name="email" required placeholder="Ваша почта">
            <input type="submit" name="order" value="Отправить заказ">
        </form>
    <?php }; ?>
</body>
</html>

