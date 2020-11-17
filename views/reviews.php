<div class="container">

    <h2 class="mt-3 pt-3">User Reviews</h2>
    <hr>
    <div class="row">
        <button type="submit" class="btn btn-dark" id="reviewBtn" onclick="toggleReviewBox()">Write Review</button>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <form method="POST" class="form-group" id="review-box">
                <label for="reviewRating">Rate this product</label>
                <input type="hidden" name="id" value="<?php echo $id; ?>" id="reviewId">
                <input class="form-control" type="number" min=1 max=5 name="" id="reviewRating">
                <label for="reviewContent">Write your review:</label>
                <textarea class="form-control" name="" id="reviewContent" cols="30" rows="10"></textarea>
                <input class="btn btn-success btn-block" type="submit" value="Post Review" formmethod="POST"></input>
            </form>
        </div>
    </div>
    <br>
    <br>
    <div class="reviews" id="reviews-box">

    </div>
</div>