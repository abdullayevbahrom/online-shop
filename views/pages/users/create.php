<?php

\App\Services\Page::part("head");
\App\Services\Page::part("navbar");
?>
<div class="container tm-mt-big tm-mb-big">
    <div class="row">
        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                <div class="row">
                    <div class="col-12">
                        <h2 class="tm-block-title d-inline-block">Add New User</h2>
                        <p class="text-warning"><b><?= $_SESSION["message"] ?? null; ?></b></p>
                    </div>
                </div>
                <form action="/users/action/store" method="post" class="tm-edit-product-form">
                    <div class="row tm-edit-product-row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="form-group mb-3">
                                <label for="email">Phone</label>
                                <input
                                    id="phone"
                                    name="phone"
                                    type="tel"
                                    class="form-control validate"
                                    required
                                />
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    class="form-control validate"
                                    required
                                />
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block text-uppercase mb-3">Add New User</button>
                        </div>
                        <div class="col-12">
                            <a href="/users/action/index" type="submit" class="btn btn-primary btn-block text-uppercase">Back to Users</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
unset($_SESSION["message"]);
\App\Services\Page::part("footer");
?>