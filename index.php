<?php
    require_once("header.php");

    if(isset($_GET["cat"]))
    {
        try {
            $currentGet = $_GET["cat"];
            $products=$connect->query("SELECT * FROM products WHERE cat='$currentGet'");
            $products=$products->fetchall(PDO::FETCH_ASSOC);
            if(count($products)==0)
            {
                throw new Exception("Error Processing Request");
                
            }
        } catch (Exception $e) {
            ?>
    <img src="img/404.jpg" alt="404">
    <?php
        };
    } else
    {
        $products=$connect->query("SELECT * FROM products");
        $products=$products->fetchall(PDO::FETCH_ASSOC);
    };
?>
    <div class="main">
    <? foreach($products as $product) { ?>
        <div class="card">
            <a href="product.php?product=<?php echo $product["title"] ?>">
                <img src="img/<? echo $product["img"] ?>" alt="Фото">
            </a>
            <div class="label">Товар (<? echo $product["price"] ?> рублей)</div>
            <form action="actions/add.php" method="post">
                <input type="hidden" name="id" value="<?php echo $product["id"] ?>">
                <input type="submit" name="" value="Добавить в корзину">
            </form>
        </div>
    <? }; ?>
    </div>

</body>
</html>

