<?php

$users = $_SESSION["users"] ?? [];
\App\Services\Page::part("head");
\App\Services\Page::part("navbar");
?>
<div class="container mt-5">
    <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col">
            <div class="tm-bg-primary-dark tm-block tm-block-products">
                <p class="text-warning"><b><?= $_SESSION["message"] ?? null; ?></b></p>
                <div class="tm-product-table-container">
                    <table class="table table-hover tm-table-small tm-product-table">
                        <thead>
                        <tr>
                            <th scope="col"><b>№</b></th>
                            <th scope="col">PHONE</th>
                            <th scope="col">SHOW</th>
                            <th scope="col">EDIT</th>
                            <th scope="col">DELETE</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $number = 0;
                        foreach ($users as $user) : ?>
                            <tr>
                                <td><?= ++$number; ?></td>
                                <td class="tm-product-name"><?= $user->phone ?></td>
                                <td>
                                    <form action="/users/action/show" method="POST">
                                        <input type="hidden" name="user_id" value="<?= $user->user_id ?>"/>
                                        <button type="submit" class="tm-product-delete-link">
                                            <i class="far fa-eye tm-product-delete-icon"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="/users/action/edit" method="POST">
                                        <input type="hidden" name="PUT"/>
                                        <input type="hidden" name="user_id" value="<?= $user->user_id ?>"/>
                                        <button type="submit" class="tm-product-delete-link">
                                            <i class="far fa-edit tm-product-delete-icon"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="/users/action/delete" method="POST"
                                          onSubmit="return confirm('Rostdan ham o\'chirmoqchimisiz?')">
                                        <input type="hidden" name="DELETE"/>
                                        <input type="hidden" name="user_id" value="<?= $user->user_id ?>"/>
                                        <button type="submit" class="tm-product-delete-link">
                                            <i class="far fa-trash-alt tm-product-delete-icon"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        endforeach ?>
                        </tbody>
                    </table>
                </div>
                <a href="/users/action/create" class="btn btn-primary btn-block text-uppercase mb-3">Add new user</a>
            </div>
        </div>
    </div>
</div>
<?php
unset($_SESSION["message"]);
\App\Services\Page::part("footer");
?>
