<?php
    require_once("header.php");
    $products=$connect->query("SELECT * FROM products");
    $products=$products->fetchall(PDO::FETCH_ASSOC);
?>
    <div class="main">
    <? foreach($products as $product) { ?>
        <div class="card">
            <a href="product.php">
                <img src="img/<? echo $product["img"] ?>" alt="Фото">
            </a>
            <div class="label">Товар (<? echo $product["price"] ?> рублей)</div>
            <button type="submit">Добавить в корзину</button>
        </div>
    <? }; ?>
    </div>

</body>
</html>

