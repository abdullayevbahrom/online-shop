<?php

$category = $_SESSION["category"];
\App\Services\Page::part("head");
\App\Services\Page::part("navbar");
?>
<div class="container tm-mt-big tm-mb-big">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mx-auto">
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                <div class="row">
                    <div class="col-12">
                        <h2 class="tm-block-title d-inline-block">Category</h2>
                    </div>
                </div>
                <div class="row tm-edit-product-row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <form action="/categories/action/index" method="POST" class="tm-edit-product-form">
                            <div class="form-group mb-3">
                                <label for="name">The name of this category is:</label>
                                <input id="name" disabled value="<?= $category->category_name; ?>" type="text"/>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary btn-block text-uppercase">Back to Categories
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
\App\Services\Page::part("footer");
?>
