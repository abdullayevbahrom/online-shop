<?php

$brand = $_SESSION["brand"] ?? null;
$brands = $_SESSION["brands"] ?? [];
\App\Services\Page::part("head");
\App\Services\Page::part("navbar");
?>
<div class="container tm-mt-big tm-mb-big">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mx-auto">
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                <div class="row">
                    <div class="col-12">
                        <h2 class="tm-block-title d-inline-block">Edit Brand</h2>
                        <p class="text-warning"><b><?= $_SESSION["message"] ?? null; ?></b></p>
                    </div>
                </div>
                <div class="row tm-edit-product-row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <form action="/brands/action/update" method="POST" class="tm-edit-product-form">
                            <input type="hidden" name="PUT"/>
                            <input type="hidden" name="brand_id" value="<?= $brand->brand_id; ?>"/>
                            <div class="form-group mb-3">
                                <label for="name">Brand Name *</label>
                                <input id="name" name="brand_name" value="<?= $brand->brand_name; ?>" type="text" required/>
                            </div>
                            <div class="form-group mb-5">
                                <label for="brand">List of available brands:</label>
                                <select class="custom-select tm-select-accounts" id="brand">
                                    <?php
                                    foreach ($brands as $brand) : ?>
                                        <option><?= $brand->brand_name ?></option>
                                    <?php
                                    endforeach ?>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary btn-block text-uppercase mb-3">Update Brand
                                </button>
                            </div>
                            <div>
                                <a href="/brands/action/index" class="btn btn-primary btn-block text-uppercase mb-3">Back to
                                    Brands
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
