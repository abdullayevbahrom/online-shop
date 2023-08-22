<?php

\App\Services\Page::part("head");
?>
<div class="container tm-mt-big tm-mb-big">
    <div class="row">
        <div class="col-12 mx-auto tm-login-col">
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                <div class="row">
                    <div class="col-12 text-center">
                        <?php
                        if (isset($_SESSION['message'])) : ?>
                            <p class="text-warning h5"><?= $_SESSION['message']; ?></p>
                            <?php
                            unset($_SESSION['message']);
                        endif ?>
                        <h2 class="tm-block-title mb-4">Sign In</h2>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <form action="/auth/login" method="POST" class="tm-login-form">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input name="phone" type="tel" class="form-control validate" id="phone"
                                       required placeholder="901234567"/>
                            </div>
                            <div class="form-group mt-3">
                                <label for="password">Password</label>
                                <input name="password" type="password" class="form-control validate" id="password"
                                       required placeholder="password"/>
                            </div>
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary btn-block text-uppercase">
                                    Sign In
                                </button>
                            </div>
                            <div class="mb-3">
                                <h5 class="mt-5 text-center text-warning">Don't have an account yet?</h5>
                                <a href="/register" class="mt-3 btn btn-primary btn-block text-uppercase">
                                    Sign Up
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>