<?php

\App\Services\Page::part("head");
?>
<div class="container">
    <div class="row mt-3">
        <div class="col-12 mx-auto tm-login-col">
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                <div class="row">
                    <div class="col-12 text-center">
                        <?php
                        if (isset($_SESSION['message'])) : ?>
                            <p class="text-warning h5"><?= $_SESSION['message']; ?></p>
                        <?php
                        unset($_SESSION['message']);
                        endif
                        ?>
                        <h2 class="tm-block-title mb-4">Welcome to Registration</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <form action="/auth/register" method="POST" class="tm-login-form">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input name="phone" type="tel" class="form-control validate" id="phone"
                                       required placeholder="901234567"/>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input name="password" type="password" class="form-control validate" id="password"
                                       required/>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block text-uppercase">
                                    Sign Up
                                </button>
                            </div>
                            <div>
                                <h5 class="text-center text-warning">Do you have an account?</h5>
                                <a href="/login" class="btn btn-primary btn-block text-uppercase">
                                    Sign In
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>