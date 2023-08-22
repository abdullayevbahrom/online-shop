<?php

$category = $_SESSION["category"] ?? null;
$categories = $_SESSION["categories"] ?? [];
\App\Services\Page::part("head");
\App\Services\Page::part("navbar");
?>
<div class="container tm-mt-big tm-mb-big">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mx-auto">
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                <div class="row">
                    <div class="col-12">
                        <h2 class="tm-block-title d-inline-block">Edit Category</h2>
                        <p class="text-warning"><b><?= $_SESSION["message"] ?? null; ?></b></p>
                    </div>
                </div>
                <div class="row tm-edit-product-row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <form action="/categories/action/update" method="POST" class="tm-edit-product-form">
                            <input type="hidden" name="PUT"/>
                            <input type="hidden" name="category_id" value="<?= $category->category_id; ?>"/>
                            <div class="form-group mb-3">
                                <label for="name">Category Name *</label>
                                <input id="name" name="category_name" value="<?= $category->category_name; ?>" type="text" required/>
                            </div>
                            <div class="form-group mb-5">
                                <label for="category">List of available categories:</label>
                                <select class="custom-select tm-select-accounts" id="category">
                                    <?php
                                    foreach ($categories as $category) : ?>
                                        <option><?= $category->category_name ?></option>
                                    <?php
                                    endforeach ?>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary btn-block text-uppercase mb-3">Update Category
                                </button>
                            </div>
                            <div>
                                <a href="/categories/action/index" class="btn btn-primary btn-block text-uppercase mb-3">Back to
                                    Categories
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
unset($_SESSION["message"]);
\App\Services\Page::part("footer");
?>
