<div class="container">
    <h2 class="mt-3 pt-3">User Reviews</h2>
    <hr>
    <div class="row">
        <button type="submit" class="btn btn-dark" id="reviewBtn" onclick="toggleReviewBox()">Write Review</button>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div id="review-alerts"></div>
            <form class="form-group" id="review-form">
                <label for="reviewRating">Rate this product</label>
                <input type="hidden" name="" value="<?= $id = $_GET['id']; ?>" id="productId">
                <input class="form-control" type="number" min=1 max=5 name="" id="reviewRating" required="required">
                <label for="reviewContent">Write your review:</label>
                <textarea class="form-control" name="" id="reviewContent" cols="30" rows="10"
                    required="required"></textarea>
                <input class="btn btn-success btn-block" type="submit" value="Post Review" method="POST"></input>
            </form>
        </div>
    </div>
    <br>
    <br>
</div>