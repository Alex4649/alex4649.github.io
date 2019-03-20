<?php
    session_start(); 
    require_once("header.php");
    if($_SESSION["cart"]>0)
    {
    foreach($_SESSION["cart"] as $product)
    {
?>
        <div class="cart">
            <a href="product.php?product=<?php echo $product["title"] ?>"><img src="imgs/<?php echo $product['img'] ?>" alt="Фото"></a>
            <div class="cart-descr">
                <?php echo $product["rus_name"] ?> в количестве <?php echo $product["quantity"] ?> шт на сумму <?php echo ($product["price"]*$product["quantity"]) ?> рублей
            </div>
            <button type="submit">Удалить</button>
        </div>
    <?php };}; ?>
</body>
</html>

