<?php

namespace App\Alerts;

class Alerts
{
    public static function user_set_balance_success(): string
    {
        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Successfully updated funds!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        return $alert;
    }

    public static function user_set_balance_error(): string
    {
        $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning, Can\'t update funds!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        return $alert;
    }

    public static function shopping_cart_add_success($value): string
    {
        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                	Successfully added <strong>' . $value . ' </strong> to cart
                	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                	</button>
            	</div>';
        return $alert;
    }

    public static function shopping_cart_add_error($value): string
    {
        $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
             		Can\'t add <strong>' . $value . '</strong> to cart
                	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                	</button>
              	</div>';
        return $alert;
    }

    public static function shopping_cart_remove_success(): string
    {
        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                	<strong>Removed item from shopping cart!</strong>
                	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>';
        return $alert;
    }

    public static function shopping_cart_remove_error(): string
    {
        $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Can\'t remove item from shopping cart!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        ;
        return $alert;
    }

    public static function shopping_cart_checkout_success(): string
    {
        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Order processed successfully!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        return $alert;
    }

    public static function shopping_cart_checkout_error(): string
    {
        $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Can\'t process order!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>';
        return $alert;
    }

    public static function review_submit_success(): string
    {
        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                	<strong>Review submited.</strong>
                	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              	 </div>';
        return $alert;
    }

    public static function review_submit_error(): string
    {
        $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                	<strong>Warning, Can\'t submit review.</strong>
                	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             	</div>';
        return $alert;
    }
}