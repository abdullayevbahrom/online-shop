<?php

$user = $_SESSION["user-edit"] ?? null;
\App\Services\Page::part("head");
\App\Services\Page::part("navbar");
?>
    <div class="container tm-mt-big tm-mb-big">
        <div class="row">
            <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
                <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="tm-block-title d-inline-block">Edit User</h2>
                        </div>
                    </div>
                    <form action="/users/action/update" method="post" class="tm-edit-product-form">
                        <input type="hidden" name="PUT">
                        <input type="hidden" name="user_id" value="<?= $user->user_id ?>">
                        <div class="row tm-edit-product-row">
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group mb-3">
                                    <label for="email">Phone</label>
                                    <input
                                        id="phone"
                                        name="phone"
                                        type="phone"
                                        value="<?= $user->phone; ?>"
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
                                        placeholder="**********"
                                        value="**********"
                                        class="form-control validate"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block text-uppercase mb-3">Update
                                    User
                                </button>
                            </div>
                            <div class="col-12">
                                <a href="/users/action/index" type="submit"
                                   class="btn btn-primary btn-block text-uppercase">Back to Users</a>
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