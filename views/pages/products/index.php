<?php

$products = $_SESSION["products"] ?? [];
$number = 0;
\App\Services\Page::part("head");
\App\Services\Page::part("navbar");
?>
<div class="container-fluid mt-3">
    <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col">
            <p class="text-warning text-center"><b><?php echo $_SESSION["message"] ?? null;
                                                    unset($_SESSION["message"]); ?></b></p>
            <p id="product_message" class="text-warning text-center"><b>Successfully</b></p>
            <div class="row justify-content-end">
                <div class="col-2">
                    <a href="/products/action/create" class="btn btn-primary text-uppercase rounded mx-auto mb-3">Add new product</a>
                </div>
            </div>
            <?php if ($products) : ?>
                <table id="productTable" class="table table-hover tm-table-small tm-product-table">
                    <thead>
                        <tr>
                            <th scope="col"><b>№</b></th>
                            <th scope="col">PRODUCT NAME</th>
                            <th scope="col">PRICE</th>
                            <?php if ($_SESSION["user"]["role"] === ADMIN) : ?>
                                <th scope="col">STATUS</th>
                            <?php endif ?>
                            <th scope="col">CATEGORY</th>
                            <th scope="col">BRAND</th>
                            <th scope="col">SHOW</th>
                            <th scope="col">ORDERING</th>
                            <?php if ($_SESSION["user"]["role"] === ADMIN) : ?>
                                <th scope="col">EDIT</th>
                                <th scope="col">DELETE</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td><?= ++$number; ?></td>
                                <td class="media">
                                    <img src="<?= $product->photo ?>" alt="Avatar Image" width="80" class="rounded">
                                    <div class="media-body ml-3">
                                        <p class="mb-2 mt-3"><?= $product->product_name ?></p>
                                    </div>
                                </td>
                                <td class="tm-product-name"><?= $product->price ?></td>
                                <?php if ($_SESSION["user"]["role"] === ADMIN) : ?>
                                    <td class="tm-product-name">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="<?= $product->product_id ?>" <?= $product->product_status ? "checked" : null; ?> onclick="sendAvailableProduct(this);" />
                                            <label class="custom-control-label" for="<?= $product->product_id ?>"></label>
                                        </div>
                                    </td>
                                <?php endif ?>
                                <td class="tm-product-name"><?= $product->category_name ?></td>
                                <td class="tm-product-name"><?= $product->brand_name ?></td>
                                <td>
                                    <form action="/products/action/show" method="POST">
                                        <input type="hidden" name="product_id" value="<?= $product->product_id ?>" />
                                        <button type="submit" class="tm-product-delete-link">
                                            <i class="far fa-eye tm-product-delete-icon"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="/orders/action/store" method="POST">
                                    <input type="hidden" name="product_id" value="<?= $product->product_id ?>" />
                                    <input type="hidden" name="price" value="<?= $product->price ?>" />
                                        <button type="submit" class="btn btn-primary rounded">
                                            Ordering
                                        </button>
                                    </form>
                                </td>
                                <?php if ($_SESSION["user"]["role"] === ADMIN) : ?>
                                    <td>
                                        <form action="/products/action/edit" method="POST">
                                            <input type="hidden" name="PUT" />
                                            <input type="hidden" name="product_id" value="<?= $product->product_id ?>" />
                                            <button type="submit" class="tm-product-delete-link">
                                                <i class="far fa-edit tm-product-delete-icon"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="/products/action/delete" method="POST" onSubmit="return confirm('Rostdan ham o\'chirmoqchimisiz?')">
                                            <input type="hidden" name="DELETE" />
                                            <input type="hidden" name="product_id" value="<?= $product->product_id ?>" />
                                            <button type="submit" class="tm-product-delete-link">
                                                <i class="far fa-trash-alt tm-product-delete-icon"></i>
                                            </button>
                                        </form>
                                    </td>
                                <?php endif ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p class="container col-3 text-warning"><b>Unavailable products</b></p>
            <?php endif ?>
        </div>
    </div>
</div>
<?php
\App\Services\Page::part("footer");
?>