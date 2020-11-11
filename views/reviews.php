<?php

namespace App\Views;

use App\Reviews\Reviews;

$id = $_GET['id'];

$reviews = Reviews::getReviews($id);
var_dump($reviews);
?>
<div class="container">

    <h2 class="mt-5 pt-5">User Reviews</h2>
    <hr>
    <div class="row">
        <form class="form-group" method="POST" action="" id="reviewForm">
            <label for="reviewRating">Rate this product</label>
            <input class="form-control" type="number" name="reviewRating" id="">
            <label for="reviewContent">Write your review:</label>
            <textarea class="form-control" name="reviewContent" id="" cols="30" rows="10"></textarea>

            <input class="btn btn-success btn-block" type="submit" value="Post Review">
        </form>
    </div>
    <br>
    <?php if (!empty($reviews)) {
        for ($i = 0; $i < count($reviews); $i++) { ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="mt-3 mx-auto">
                        <?php echo strtoupper($reviews['user_name']); ?>
                    </h4>
                    <h5>
                        Rating: <?php echo $reviews['rating']; ?>
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                    
                        <?php var_dump($reviews) echo $reviews['comment']; ?>
                    </p>
                </div>
            </div>
    <?php
        }
    }
    ?>
</div>