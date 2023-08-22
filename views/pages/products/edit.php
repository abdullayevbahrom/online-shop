<?php

$product = $_SESSION["product"] ?? null;
$brands = $_SESSION["brands"] ?? [];
$categories = $_SESSION["categories"] ?? [];

\App\Services\Page::part("head");
\App\Services\Page::part("navbar");
?>
<div class="container mt-5">
    <p class="text-warning"><b><?php echo $_SESSION["message"] ?? null;
                                unset($_SESSION["message"]); ?></b></p>
    <form action="/products/action/update" enctype="multipart/form-data" method="post">
        <input type="hidden" name="PUT" />
        <input type="hidden" name="product_id" value="<?= $product->product_id ?>" />
        <div class="row tm-content-row">
            <div class="tm-block-col tm-col-avatar">
                <div class="tm-bg-primary-dark tm-block tm-block-avatar">
                    <h2 class="tm-block-title">Product Photo</h2>
                    <div class="tm-avatar-container">
                        <img id="previewImage" src="<?= $product->photo ?>" alt="product photo" class="tm-avatar img-fluid mb-4" onclick="document.getElementById('imageInput').click()" />
                        <input type="file" name="photo" id="imageInput" style="display: none;">
                    </div>
                    <a class="btn btn-primary btn-block text-uppercase text-white" onclick="document.getElementById('imageInput').click()">
                        Upload New Photo
                    </a>
                </div>
            </div>
            <div class="tm-block-col tm-col-account-settings">
                <div class="tm-bg-primary-dark tm-block tm-block-settings row">
                    <div class="col-lg-12 h2 tm-block-title">#<?= $product->product_id ?> Edit Product</div>
                    <div class="form-group col-lg-6">
                        <label for="name">Product Name</label>
                        <input id="name" name="product_name" type="text" minlength="3" class="form-control validate text-warning bg-secondary" value="<?= $product->product_name ?>" />
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="name">Price</label>
                        <input id="name" name="price" type="number" min="1000" class="form-control validate text-warning bg-secondary" value="<?= $product->price ?>" />
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="name">Category</label>
                        <select class="custom-select tm-select-accounts form-control validate text-warning bg-secondary" name="category_id">
                            <?php foreach ($categories as $category) : ?>
                                <option <?= $product->category_id == $category->category_id ? 'selected' : null; ?> value="<?= $category->category_id ?>"><?= $category->category_name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="name">Brand</label>
                        <select class="custom-select tm-select-accounts form-control validate text-warning bg-secondary" name="brand_id">
                            <?php foreach ($brands as $brand) : ?>
                                <option <?= $product->brand_id == $brand->brand_id ? 'selected' : null; ?> value="<?= $brand->brand_id ?>"><?= $brand->brand_name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block text-uppercase">
                            Update Product
                        </button>
                    </div>
                    <div class="col-12 mt-2">
                        <a href="/products/action/index" class="btn btn-primary btn-block text-uppercase mb-3">Back to
                            Products
                        </a>
                    </div>
                </div>
            </div>
    </form>
</div>
<?php
\App\Services\Page::part("footer");
?>