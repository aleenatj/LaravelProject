@extends('layouts.front')

@section('page-title', 'home')

@section('front')
<div id="review_form_wrapper">
    <div id="review_form">
        <div id="respond" class="comment-respond"> 
            <form action="#" method="post" id="commentform" class="comment-form" novalidate="">
                <p class="comment-notes">
                    <span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span>
                </p>
                <div class="comment-form-rating">
                    <span>Your rating</span>
                    <p class="stars">
                        <label for="rated-1"><i class="fa fa-star"></i></label>
                        <input type="radio" id="rated-1" name="rating" value="1">
                        <label for="rated-2"><i class="fa fa-star"></i></label>
                        <input type="radio" id="rated-2" name="rating" value="2">
                        <label for="rated-3"><i class="fa fa-star"></i></label>
                        <input type="radio" id="rated-3" name="rating" value="3">
                        <label for="rated-4"><i class="fa fa-star"></i></label>
                        <input type="radio" id="rated-4" name="rating" value="4">
                        <label for="rated-5"><i class="fa fa-star"></i></label>
                        <input type="radio" id="rated-5" name="rating" value="5" checked="checked">
                    </p>
                </div>
            
                <p class="comment-form-comment">
                    <label for="comment">Your review <span class="required">*</span></label>
                    <textarea id="comment" name="comment" cols="45" rows="8"></textarea>
                </p>
                <p class="form-submit">
                    <input name="submit" type="submit" id="submit" class="submit" value="Submit">
                </p>
            </form>
        </div><!-- .comment-respond-->
    </div><!-- #review_form -->
</div><!-- #review_form_wrapper -->

<script>
    // Optional JavaScript for star rating interactivity
    document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.stars input[type="radio"]');
    stars.forEach(star => {
        star.addEventListener('change', function() {
            const checkedStars = document.querySelectorAll('.stars input[type="radio"]:checked').length;
            // Update styling or perform other actions based on checkedStars
        });
    });
});

// If using jQuery
$(document).ready(function() {
    $('.stars input[type="radio"]').change(function() {
        const checkedStars = $('.stars input[type="radio"]:checked').length;
        // Update styling or perform other actions based on checkedStars
    });
});
</script>
<styles>
#respond {
        margin-bottom: 20px;
    }

    /* Style for the comment notes */
    .comment-notes {
        font-size: 14px;
        color: #666;
    }

    /* Style for required fields */
    .required {
        color: red;
    }

    /* Style for the rating section */
    .comment-form-rating {
        margin-bottom: 15px;
    }

    .stars {
        display: inline-block;
    }

    .stars label {
        font-size: 24px;
        color: #ddd; /* Default star color */
        cursor: pointer;
        transition: color 0.3s ease; /* Smooth transition for color change */
    }

    .stars input[type="radio"] {
        display: none; /* Hide the radio buttons */
    }

    .stars input[type="radio"]:checked + label,
    .stars label:hover {
        color: #ffc107; /* Change color for checked star and on hover */
    }
</style>
 @endsection