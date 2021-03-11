<?php foreach ($reviews as $review) { ?>
<div class="reviews card">
    <div class="card-header">
        <h4 class="mt-3 mx-auto">
            <?= $review['username'] ?>
        </h4>
        <h5>
            <div id=stars>
                <?php for ($i = 0; $i < $review['rating']; $i++) { ?>
                <i class="fa fa-star stars"></i>
                <?php } ?>
                <?php for ($i = 0; $i < 5 - $review['rating']; $i++) { ?>
                <i class="fa fa-star stars-grey"></i>
                <?php } ?>
            </div>

        </h5>
    </div>
    <div class="card-body">
        <p class="text-muted">
            <?= $review['feedback'] ?>
        </p>
    </div>
</div>
<?php } ?>