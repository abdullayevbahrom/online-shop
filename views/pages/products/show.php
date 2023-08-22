<?php

$product = $_SESSION["product"] ?? null;
\App\Services\Page::part("head");
\App\Services\Page::part("navbar");
?>
<div class="container mt-5">
    <p class="text-warning"><b><?php echo $_SESSION["message"] ?? null; unset($_SESSION["message"]); ?></b></p>
    <div class="row tm-content-row">
        <div class="tm-block-col tm-col-avatar">
            <div class="tm-bg-primary-dark tm-block tm-block-avatar">
                <h2 class="tm-block-title">Product Photo</h2>
                <div class="tm-avatar-container">
                    <img src="<?= $product->photo ?>" alt="product photo" class="tm-avatar img-fluid mb-4" />
                </div>
            </div>
        </div>
        <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
                <h2 class="tm-block-title">#<?= $product->product_id ?> Product details</h2>
                <form action="/products/action/index" method="post" class="tm-signup-form row">
                    <div class="form-group col-lg-6">
                        <label for="name">Product Name</label>
                        <input id="name" type="text" class="form-control validate text-warning bg-secondary" value="<?= $product->product_name ?>" disabled/>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="name">Price</label>
                        <input id="name" type="text" class="form-control validate text-warning bg-secondary" value="<?= $product->price ?>" disabled/>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="name">Category</label>
                        <input id="name" type="text" class="form-control validate text-warning bg-secondary" value="<?= $product->category_name ?>" disabled/>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="name">Brand</label>
                        <input id="name" type="text" class="form-control validate text-warning bg-secondary" value="<?= $product->brand_name ?>" disabled/>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block text-uppercase">
                            Back to Products
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
\App\Services\Page::part("footer");
?>