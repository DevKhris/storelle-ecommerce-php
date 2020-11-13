<?php

use App\Reviews\Reviews;
use App\Reviews\Review;
use App\Controllers\MainController;

$id = $_GET['id'];
$reviews = [];
$reviews = Reviews::getReviews($id);
?>
<div class="container">

    <h2 class="mt-3 pt-3">User Reviews</h2>
    <hr>
    <div class="row">
        <button type="submit" class="btn btn-dark" action="/review.php?id=">Write Review</button>
    </div>
    <div class="review-box">
    <div class="row">
    <div class="col-sm-12">     
                <form method="POST" class="form-group">
                    <label for="reviewRating">Rate this product</label>
                    <input class="form-control hidden" type="number" name="id" value="<?php echo $id; ?>" id="">
                    <input class="form-control" type="number" min=1 max=5 name="reviewRating" id="">
                    <label for="reviewContent">Write your review:</label>
                    <textarea class="form-control" name="reviewContent" id="" cols="30" rows="10"></textarea>
                    <input class="btn btn-success btn-block" type="submit" value="Post Review" formmethod="POST"></input>
            </form>   
    </div>
</div>
    </div>
    <br>
    <br>
    <div class="reviews">
        <?php if (!empty($reviews)) {
            for ($i = 0; $i < count($reviews); $i++) { ?>
                <div class=" card">
                    <div class="card-header">
                        <h4 class="mt-3 mx-auto">
                            <?php echo strtoupper($reviews[$i]['user_name']); ?>
                        </h4>
                        <h5>
                            Rating: <?php echo $reviews[$i]['rating']; ?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">
                            <?php echo $reviews[$i]['comment']; ?>
                        </p>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>