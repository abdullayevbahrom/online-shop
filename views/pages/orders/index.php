<?php

$orders = $_SESSION["orders"] ?? [];
$number = 0;
\App\Services\Page::part("head");
\App\Services\Page::part("navbar");
?>
<div class="container-fluid mt-3">
    <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col">
            <p class="text-warning text-center"><b><?php echo $_SESSION["message"] ?? null;
                                                    unset($_SESSION["message"]); ?></b></p>
            <?php if ($orders) : ?>
                <table id="orderTable" class="table table-hover tm-table-small tm-product-table">
                    <thead>
                        <tr>
                            <th scope="col"><b>№</b></th>
                            <th scope="col">PHONE</th>
                            <th scope="col">PRODUCTS</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">PRICE</th>
                            <th scope="col">SHOW</th>
                            <th scope="col">DELETE</th>
                            <?php if ($_SESSION["user"]["role"] === USER) : ?>
                                <th scope="col">ORDERING</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order) : ?>
                            <tr>
                                <td><?= ++$number; ?></td>
                                <td class="tm-order-name"><?= $order->phone ?></td>
                                <td class="tm-order-name"><?= $order->products ?></td>
                                <td class="tm-order-name"><?php echo $order->order_status == 0 ? "Un ordered" : "Ordered" ?></td>
                                <td class="tm-order-name"><?= $order->price ?></td>
                                <td>
                                    <form action="/orders/action/show" method="POST">
                                        <input type="hidden" name="order_id" value="<?= $order->order_id ?>" />
                                        <button type="submit" class="tm-product-delete-link">
                                            <i class="far fa-eye tm-product-delete-icon"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="/orders/action/delete" method="POST" onSubmit="return confirm('Rostdan ham o\'chirmoqchimisiz?')">
                                        <input type="hidden" name="DELETE" />
                                        <input type="hidden" name="order_id" value="<?= $order->order_id ?>" />
                                        <button type="submit" class="tm-product-delete-link">
                                            <i class="far fa-trash-alt tm-product-delete-icon"></i>
                                        </button>
                                    </form>
                                </td>
                                <?php if ($_SESSION["user"]["role"] === USER) : ?>
                                    <td>
                                        <form action="/orders/action/order" method="POST">
                                            <input type="hidden" name="order_id" value="<?= $order->order_id ?>" />
                                            <button <?= $order->order_status == 0 ? null : "disabled" ?> type="submit" class="btn btn-primary rounded">
                                                <?= $order->order_status == 0 ? "Ordering" : "Ordered" ?>
                                            </button>
                                        </form>
                                    </td>
                                <?php endif ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php endif ?>
        </div>
    </div>
</div>
<?php
\App\Services\Page::part("footer");
?>