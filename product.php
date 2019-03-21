<?php 
    require_once("header.php");

    if(isset($_GET["product"]))
    {
        $currentProd = $_GET["product"];
        $product = $connect->query("SELECT * FROM products WHERE title='$currentProd'");
        $product = $product->fetch(PDO::FETCH_ASSOC);
        if(isset($product["rus_name"]))
        {
?>
<div class="product-card">
    <a href="index.php">Вернуться на главную</a>

    <h2><?php echo $product["rus_name"] ?> (<?php echo $product["price"] ?> рублей)</h2>
    <div class="descr"><?php echo $product["descr"] ?></div>
    <img width="300" src="img/<?php echo $product["img"] ?>" alt="Фото">
    <form action="actions/add.php" method="post">
        <input type="hidden" name="id" value="<?php echo $product["id"] ?>">
        <input type="submit" name="" value="Добавить в корзину">
    </form>
</div>
<?php 
    } else {
        ?>
        <h3 class="back">Гриб не найден</h3>
        <a href="index.php" class="back">На главную</a>
        <?php
    }}
?>
