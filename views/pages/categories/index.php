<?php

$categories = $_SESSION["categories"] ?? [];
\App\Services\Page::part("head");
\App\Services\Page::part("navbar");
?>
<div class="container mt-5">
    <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col">
            <div class="tm-bg-primary-dark tm-block tm-block-products">
                <p class="text-warning"><b><?= $_SESSION["message"] ?? null; ?></b></p>
                <p id="category_message" class="text-warning"><b>Successfully</b></p>
                <div class="row justify-content-end">
                    <div class="col-3">
                        <a href="/categories/action/create" class="btn btn-primary btn-block text-uppercase mb-3 rounded">Add new Category</a>
                    </div>
                </div>
                <div class="tm-product-table-container">
                    <table id="categoryTable" class="table table-hover tm-table-small tm-product-table">
                        <thead>
                            <tr>
                                <th scope="col"><b>№</b></th>
                                <th scope="col">CATEGORY NAME</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">SHOW</th>
                                <th scope="col">EDIT</th>
                                <th scope="col">DELETE</th>
                            </tr>
                        </thead>
                        <tbody id="category_table_body">
                            <?php
                            $number = 0;
                            foreach ($categories as $category) : ?>
                                <tr class="row1" data-id="<?= $category->category_id; ?>">
                                    <td><?= ++$number ?></td>
                                    <td class="tm-product-name"><?= $category->category_name ?></td>
                                    <td class="tm-product-name">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="<?= $category->category_id ?>" <?= $category->category_status ? "checked" : null; ?> onclick="sendAvailableCategory(this);" />
                                            <label class="custom-control-label" for="<?= $category->category_id ?>"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="/categories/action/show" method="POST">
                                            <input type="hidden" name="category_id" value="<?= $category->category_id ?>" />
                                            <button type="submit" class="tm-product-delete-link">
                                                <i class="far fa-eye tm-product-delete-icon"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="/categories/action/edit" method="POST">
                                            <input type="hidden" name="PUT" />
                                            <input type="hidden" name="category_id" value="<?= $category->category_id ?>" />
                                            <button type="submit" class="tm-product-delete-link">
                                                <i class="far fa-edit tm-product-delete-icon"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="/categories/action/delete" method="POST" onSubmit="return confirm('Rostdan ham o\'chirmoqchimisiz?')">
                                            <input type="hidden" name="DELETE" />
                                            <input type="hidden" name="category_id" value="<?= $category->category_id ?>" />
                                            <button type="submit" class="tm-product-delete-link">
                                                <i class="far fa-trash-alt tm-product-delete-icon"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
unset($_SESSION["message"]);
\App\Services\Page::part("footer");
?>