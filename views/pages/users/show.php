<?php

$user = $_SESSION["user-show"] ?? $_SESSION["user"];
\App\Services\Page::part("head");
\App\Services\Page::part("navbar");
?>
<div class="container tm-mt-big tm-mb-big">
    <div class="row">
        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                <div class="row">
                    <div class="col-12">
                        <h2 class="tm-block-title d-inline-block">User</h2>
                    </div>
                </div>
                <div class="row tm-edit-product-row">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group mb-3">
                            <label for="email">Phone</label>
                            <input
                                id="phone"
                                type="tel"
                                value="<?= $user->phone ?? $user['phone']; ?>"
                                readonly
                                class="validate"
                            />
                        </div>
                    </div>
                    <div class="col-12">
                        <a href="/users/action/index" type="submit" class="btn btn-primary btn-block text-uppercase">Back to Users</a>
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
