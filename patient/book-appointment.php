<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>DentCare Dental Clinic</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="font-awesome.min.css" rel="stylesheet" />
  <!-- nice select -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
  <!-- datepicker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
  <!-- Custom styles for this template -->
  <link href="style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="responsive.css" rel="stylesheet" />

</head>

<body class="menubar-left menubar-unfold menubar-light theme-primary">
<!--============= start main area -->

<?php include_once('includes/header.php');?>

<?php include_once('includes/sidebar.php');?>
    
<section class="book_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col">
          <form>
            <h4>
              BOOK <span>APPOINTMENT</span>
            </h4>
            <div class="form-row ">
              <div class="form-group col-lg-4">
                <label for="inputPatientName">Patient Name </label>
                <input type="text" class="form-control" id="inputPatientName" placeholder="">
              </div>
              <div class="form-group col-lg-4">
                <label for="inputDoctorName">Doctor's Name</label>
                <select name="" class="form-control wide" id="inputDoctorName">
                  <option value="Normal distribution">Dr. Hennry </option>
                  <option value="Normal distribution">Dr. Jenni </option>
                  <option value="Normal distribution">Dr.Morco </option>
                </select>
              </div>
              <div class="form-group col-lg-4">
                <label for="inputDepartmentName">Department's Name</label>
                <select name="" class="form-control wide" id="inputDepartmentName">
                  <option value="Normal distribution ">Orthodontics </option>
                  <option value="Normal distribution ">Endodontics </option>
                  <option value="Normal distribution ">Periodontics </option>
                </select>
              </div>
            </div>
            <div class="form-row ">
              <div class="form-group col-lg-4">
                <label for="inputPhone">Phone Number</label>
                <input type="number" class="form-control" id="inputPhone" placeholder="XXXXXXXXXX">
              </div>
              <div class="form-group col-lg-4">
                <label for="inputSymptoms">Symptoms</label>
                <input type="text" class="form-control" id="inputSymptoms" placeholder="">
              </div>
              <div class="form-group col-lg-4">
                <label for="inputDate">Choose Date </label>
                <div class="input-group date" id="inputDate" data-date-format="mm-dd-yyyy">
                  <input type="text" class="form-control" readonly>
                  <span class="input-group-addon date_icon">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                  </span>
                </div>
              </div>
            </div>
            <div class="btn-box">
              <button type="submit" class="btn ">Submit Now</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>


  <!-- end book section -->
</head>
</body>

</html>