<?php 
    include 'mainheader.php';
?>
<script>
   function firstName() {
    var f1 = document.getElementById("f1");
    var fname = document.getElementById('name').value;

    if (!/^[A-Z ]{1}[A-Za-z. ]{3,30}$/.test(fname)) {
        f1.textContent = "**Invalid Full Name(First letter should be capital)";
        var x = document.getElementById("name");
        x.focus();
        return false;
    } else if (/([a-zA-Z])\1{3,}/.test(fname)) {
        f1.textContent = "**Invalid Full Name(Continuous similar letters are not allowed)";
        var x = document.getElementById("name");
        x.focus();
        return false;
    } else {
        f1.textContent = "";
        return true;
    }
}

  function emailUser() {
    var f8 = document.getElementById("f8");
    var email = document.getElementById('email').value;

    if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$/.test(email))
       {
         f8.textContent = "**Invalid Email Format";
         document.getElementById("email").focus();
         return false;
       }
       else
       {
        f8.textContent = "";
        return true;
       }
  }
  function feedback() {
    var f3 = document.getElementById("f3");
    var feed = document.getElementById("feed").value.trim();

    if (feed === "") {
        f3.textContent = "Feedback cannot be empty";
        return false;
    } else if (feed.length < 10) {
        f3.textContent = "Feedback must be at least 10 characters long";
        return false;
    } else if (feed.length > 1000) {
        f3.textContent = "Feedback cannot exceed 1000 characters";
        return false;
    }


    f3.textContent = ""; 
    return true;
}

  function checkAll() {

if(firstName()&&emailUser()&&feedback())
   {
     return true;
   }
   else
   {
    return false;
   }
}
</script>


<br>
<!-- contact-style-two -->
<section class="contact-style-two p_relative">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url(assets/images/shape/shape-55.png);"></div>
        <div class="pattern-2" style="background-image: url(assets/images/shape/shape-56.png);"></div>
    </div>
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 big-column offset-lg-2">
                <div class="form-inner"><br>
                    <h2>Feedback Form</h2>
                    <form role="form" action="feedback.php" method="post" enctype="multipart/form-data" name="myform" onsubmit="return validateForm()">

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control input-sm" placeholder="Name" id="name"onkeyup="firstName()">
                                    <span style="color: red;font-size: 14px" id="f1"></span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control input-sm" placeholder="Email" id="email"onkeyup="emailUser()">
                                    <span style="color: red;font-size: 14px" id="f8"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <textarea rows="5" name="feed" id="feed" placeholder="Enter your feedback here.!!"onkeyup="feedback()"></textarea>
                            <span style="color: red;font-size: 14px" id="f3"></span>
                                </div> 
                        <input type="submit" value="Submit" class="btn btn-info btn-block"onclick="return checkAll()" >
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact-style-two end -->
<br><br><br>

<?php 
    include 'mainfooter.php';
?>
