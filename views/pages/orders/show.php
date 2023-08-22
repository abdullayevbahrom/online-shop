<?php

$order_products = $_SESSION["order_products"] ?? [];
$number = 0;
\App\Services\Page::part("head");
\App\Services\Page::part("navbar");
?>
<div class="container-fluid mt-3">
    <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col">
            <p class="text-warning text-center"><b><?php echo $_SESSION["message"] ?? null;
                                                    unset($_SESSION["message"]); ?></b></p>
            <?php if ($order_products) : ?>
                <table id="orderTable" class="table table-hover tm-table-small tm-product-table">
                    <thead>
                        <tr>
                            <th scope="col"><b>№</b></th>
                            <th scope="col">PRODUCT NAME</th>
                            <th scope="col">PRICE</th>
                            <th scope="col">QUANTITY</th>
                            <th scope="col">SUMM</th>
                            <th scope="col">DELETE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_products as $order_product) : ?>
                            <tr>
                                <td><?= ++$number; ?></td>
                                <td class="media">
                                    <img src="<?= $order_product->photo ?>" alt="Avatar Image" width="80" class="rounded">
                                    <div class="media-body ml-3">
                                        <p class="mb-2 mt-3"><?= $order_product->product_name ?></p>
                                    </div>
                                </td>
                                <td class="tm-product-name"><?= $order_product->price ?></td>
                                <td class="tm-product-name"><?= $order_product->quantity ?></td>
                                <td class="tm-product-name"><?= intval($order_product->quantity) * intval($order_product->price) ?></td>
                                <td>
                                    <form action="/orders/action/delete" method="POST" onSubmit="return confirm('Rostdan ham o\'chirmoqchimisiz?')">
                                        <input type="hidden" name="DELETE" />
                                        <input type="hidden" name="order_product_id" value="<?= $order_product->order_product_id ?>" />
                                        <input type="hidden" name="order_id" value="<?= $order_product->order_id ?>" />
                                        <button type="submit" class="tm-product-delete-link">
                                            <i class="far fa-trash-alt tm-product-delete-icon"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p class="container col-3 text-warning"><b>Unavailable orders</b></p>
            <?php endif ?>
            <a href="/orders/action/index" class="btn btn-primary btn-block text-uppercase my-3">Back to Orders</a>
        </div>
    </div>
</div>
<?php
\App\Services\Page::part("footer");
?>