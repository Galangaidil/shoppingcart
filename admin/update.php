<?php
include '../functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the products id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $desc = isset($_POST['desc']) ? $_POST['desc'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : '';
        $rrp = isset($_POST['rrp']) ? $_POST['rrp'] : '';
        $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
        $img = isset($_POST['img']) ? $_POST['img'] : '';
        $dataadded = isset($_POST['data_added']) ? $_POST['data_added'] : date('Y-m-d H:i:s');
        // Update the record
        $stmt = $pdo->prepare('UPDATE contacts SET id = ?, name = ?, email = ?, phone = ?, title = ?, created = ? WHERE id = ?');
        $stmt->execute([$id, $name, $desc, $price, $rrp, $quantity, $img, $dataadded, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the products from the products table
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $products = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$products) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>

<?= admin_template_header('Update Product') ?>

<div class="content update">
    <h2>Update Products #<?= $products['id'] ?></h2>
    <form action="update.php?id=<?= $products['id'] ?>" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" value="<?= $products['id'] ?>" id="id">
        <input type="text" name="name" value="<?= $products['name'] ?>" id="name">
        <label for="desc">Description</label>
        <label for="img">Image</label>
        <input type="textarea" name="desc" value="<?= $products['desc'] ?>" id="desc">
        <input type="text" name="img" value="<?= $products['img'] ?>" id="img">
        <label for="price">Price</label>
        <label for="rrp">RRP</label>
        <input type="text" name="price" value="<?= $products['price'] ?>" id="price">
        <input type="text" name="rrp" value="<?= $products['rrp'] ?>" id="rrp">
        <label for="quantity">Quantity</label>
        <label for="data">Date Added</label>
        <input type="text" name="quantity" value="<?= $products['quantity'] ?>" id="quantity">
        <input type="datetime-local" name="data_added" value="<?= date('Y-m-d\TH:i', strtotime($products['date_added'])) ?>" id="data">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= admin_template_footer() ?>