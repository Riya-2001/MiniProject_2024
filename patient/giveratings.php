<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    include("connection.php");
include('patientheader.php'); 
}

if (isset($_POST['review'])) {
    
    $ptid = $_COOKIE['lkey'];
    $drid = $_GET['doctor_id'];
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];
    $existingReviewQuery = "SELECT * FROM tb_review WHERE ptid = '$ptid' AND drid = '$drid'";
    $existingReviewResult = mysqli_query($conn, $existingReviewQuery);

    if ($existingReviewResult && mysqli_num_rows($existingReviewResult) > 0) {
        // Update existing review
        $row = mysqli_fetch_assoc($existingReviewResult);
        $review_id = $row['review_id'];

        $updateReviewQuery = "UPDATE tb_review SET rating = '$rating', review_text = '$review_text' WHERE review_id = '$review_id'";
        $updateReviewResult = mysqli_query($conn, $updateReviewQuery);

        if ($updateReviewResult) {
            echo '<script>alert("Review updated successfully!");</script>';
            echo '<script>window.location.href = "ratings.php?drid=' . $drid . '";</script>';
        } else {
            echo '<script>alert("Error updating review. Please try again.");</script>';
                // Add additional error information
                echo 'MySQL Error: ' . mysqli_error($conn);
        }
    } else {
        // Insert new review
        $insertReviewQuery = "INSERT INTO tb_review (ptid, drid, rating, review_text, review_date) VALUES ('$ptid', '$drid', '$rating', '$review_text', CURDATE())";
        $insertReviewResult = mysqli_query($conn, $insertReviewQuery);

        if ($insertReviewResult) {
            echo '<script>alert("Review added successfully!");</script>';
            echo '<script>window.location.href = "ratings.php?ptid=' . $ptid . '";</script>';
        } else {
            echo '<script>alert("Error updating review. Please try again.");</script>';
                // Add additional error information
                echo 'MySQL Error: ' . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Review</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        h1 {
            margin-bottom: 20px;
        }

        .review-container {
            max-width: 526px;
            margin: 0 auto;
            margin-top: 100px;
            padding: 40px;
            background-color: #FFFFE1;
            border-radius: 20px;
            opacity: 0.9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .review-container label {
            font-weight: bold;
        }

        .review-container input {
            width: 100%;
            padding: 10px;
            border: 1px solid pink;
            border-radius: 10px;
        }

        .stars {
            display: inline-block;
            font-size: 24px;
            cursor: pointer;
            color: #9738;
        }

        .stars:hover {
            color: #ffcc00;
        }

        .selected-stars {
            color: #ffcc00;
        }

      

        #submit {
            display: block;
            width: 100%;
            padding: 10px;
            color: #ffffff;
            background: black;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: 0.4s linear;
            border: none;
            border-radius: 10px;
            border-color: #131312;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="review-container">
        <h1 style="text-align:center;">Add Review</h1><br><br>

        <form id="reviewForm" method="post" name="review" onsubmit="return validateForm();">
    <!-- Add the hidden input field for product_id -->
    <input type="hidden" name="drid" value="<?php echo $drid; ?>">

    <label for="rating">Rating:</label>
    <div class="stars" onclick="selectStar(1)" id="star1">&#9733;</div>
    <div class="stars" onclick="selectStar(2)" id="star2">&#9733;</div>
    <div class="stars" onclick="selectStar(3)" id="star3">&#9733;</div>
    <div class="stars" onclick="selectStar(4)" id="star4">&#9733;</div>
    <div class="stars" onclick="selectStar(5)" id="star5">&#9733;</div>
    <input type="hidden" name="rating" id="rating" value="0"> <!-- Hidden input for the rating -->
    <span style="color: red; font-size: 14px" id="ratingError"></span> <!-- Updated error message placeholder -->
    <br><br>

    <label for="textReview">Text Review:</label>
<textarea id="textReview" name="review_text" rows="5" class="form-control"></textarea><br>
<span style="color: red; font-size: 14px" id="reviewError"></span> <!-- Updated error message placeholder -->


    <button type="submit" class="btn submit-btn" name="review" id="submit">Submit Review</button>
</form>

    </div>
    <br><br>
    <?php include_once('patientfooter.php'); ?>

    <script>
        let selectedStars = 0;

        function selectStar(starNumber) {
            selectedStars = starNumber;
            document.getElementById('rating').value = selectedStars; // Set the hidden input value
            for (let i = 1; i <= 5; i++) {
                const starElement = document.getElementById(`star${i}`);
                if (i <= selectedStars) {
                    starElement.classList.add('selected-stars');
                } else {
                    starElement.classList.remove('selected-stars');
                }
            }
            // Clear any existing rating error message
            document.getElementById('ratingError').innerText = '';
        }

        function validateForm() {
            const rating = selectedStars;
            const reviewText = document.getElementById('textReview').value.trim();
            let isValid = true;

            if (rating === 0) {
                document.getElementById('ratingError').innerText = 'Please select a rating';
                isValid = false;
            } else {
                document.getElementById('ratingError').innerText = ''; // Clear any existing error message
            }

            if (reviewText === '') {
                document.getElementById('reviewError').innerText = 'Please enter a review';
                isValid = false;
            } else {
                document.getElementById('reviewError').innerText = ''; // Clear any existing error message
            }

            return isValid;
        }
    </script> 
</body>

 <footer class="main-footer" style="position:relative; z-index:99; ">
        <small><center>Designed and developed by Riya Robin | DentCare Dental Clinic 2023</center></small>
    </footer>
</body>
</html>
