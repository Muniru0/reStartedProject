<?php require_once("../lqUgAuP7zZlempzC9gN9lIm8yiqnAYfExk/initialize.php");
before_every_protected_page();




print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Update your profile</title>

    <link rel="shortcut icon" type="image/x-icon" href="">

    <!-- Material Design Icons -->
    <link rel="stylesheet" href="assets/MaterialDesign-Webfont-master/css/materialdesignicons.min.css">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Jasny Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/jasny-bootstrap.min.css">

    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">


    <!-- SCRIPTS -->

    <!-- JQuery -->
    <script type="text/javascript" src="assets/js/jquery-3.1.1.min.js" defer="true"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="assets/js/bootstrap.min.js" defer="true"></script>

    <!-- Jasny Bootstrap JavaScript -->
    <script type="text/javascript" src="assets/js/jasny-bootstrap.min.js" defer="true"></script>

</head>
<body  style="overflow-x:hidden" class="profile-body">


 <?php 

if(request_is_POST() && request_is_same_domain()) {
  
      if(!csrf_token_is_valid() || !csrf_token_is_recent()) {
      
    //if the csrf_token validation fails then redirect them to the sign up page.
    redirect_to("login.php");
    
    
  }else{

// csrf test passed and the form the form was from us recently

 if(isset($_POST["submit"])){
  
  if(is_real_name(["firstname","lastname"]) && validate_presence_on(["firstname","lastname","email"]) && is_email($_POST["email"]) && is_phone("phone")){
    
     
  
  
   if(isset($_FILES["business_logo"]) && $_FILES["business_logo"]["name"] != ""){
   user::update_profile_image("business_logo",$_FILES["business_logo"]);
   }

   if(isset($_FILES["profile_image"]) && $_FILES["profile_image"]["name"] != ""){
    user::update_profile_image("profile_image",$_FILES["profile_image"]);
   }

  if(user::update_profile($_POST["firstname"],$_POST["lastname"],$_POST["email"],$_POST["phone"],$_POST["location"],$_POST["interest"],$_POST["business_name"],$_POST["industry"],$_POST["description"])){
    
  redirect_to("home.php");
}

}
}
}
}
?>
  

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">Public App</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Logout</a>
          </li>
        </ul>

        <form class="form-inline mt-2 mt-md-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
    
    <div class="container container-profile"> 

        <div class="row">
            <div class="col"></div>

            <div class="col-10">

                <div class="update-profile">

                    <form action = "update_profile.php" method="POST" accept="utf-8" enctype="multipart/form-data">
                 
                 <?php echo csrf_token_tag(); ?>

                      <h4>Personal profile</h4>
                      <hr>

                      <div class="row">
                        <div class="form-group col">
                            <label for="firstname">First name</label>
                            <input type="text" class="form-control" placeholder="First name" name="firstname" id="firstname" value = "<?php echo $_SESSION["firstname"]; ?>">
                        </div>
                        <div class="form-group col">
                            <label for="lastname">Last name</label>
                          <input type="text" class="form-control" placeholder="Last name" name="lastname" id="lastname" value = "<?php echo $_SESSION["lastname"];?>">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email" value = "<?php echo $_SESSION["email"]; ?>">
                        </div>
                        <div class="form-group col">
                            <label for="phone">Phone</label>
                          <input type="phone" class="form-control" placeholder="Phone" name="phone" id="phone" value = "<?php echo $_SESSION["phone"]; ?>">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" placeholder="Location" name="location" id="location" value = "<?php echo $_SESSION["location"]; ?>">
                        </div>
                        <div class="form-group col">
                            <label for="interest">Sector of interest</label>
                            <select class="form-control" name="interest" id="interest">
                              <option>interest</option>
                              <option <?php if($_SESSION["interest"] == "transport"){echo "selected";}?>>Transport</option>
                              <option <?php if($_SESSION["interest"] == "S.O.L"){echo "selected";}?>>S.O.L</option>
                              <option <?php if($_SESSION["interest"] == "health administration"){echo "selected";}?> >Health</option>
                              <option <?php if($_SESSION["interest"] == "work"){echo "selected";}?>>work</option>
                              <option <?php if($_SESSION["interest"] == "sanitation"){echo "selected";}?>>Sanitation</option>
                               <option <?php if($_SESSION["interest"] == "security"){echo "selected";}?>>Security</option>
                                <option <?php if($_SESSION["interest"] == "other"){echo "selected";}?>>other</option>
                                
                            </select>
                        </div>
                      </div>

 <!--PLEASE CAN YOU ADD AN IMAGE TAG SUCH THAT IF I SHOULD COME
     BACK HERE AGAIN TO UPDATE THE PROFILE IT WILL ALREADY HAVE MY DEFAULT IMAGE 
      PREVIEWED  -->
                      <h6>Profile picture</h6>
                      <div class="fileinput fileinput-new" data-provides="fileinput" style="margin-bottom: 40px;">
                          <div class="fileinput-new thumbnail" style="width: 200px; height: 150px; border: 1px solid #eee;">
                          </div>
                          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                          <div>
                            <span class="btn btn-default btn-file"><span class="fileinput-new">click to select image</span><span class="fileinput-exists">Change</span><input type="file" name="profile_image"></span>
                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                          </div>
                      </div>

                      <h4>Business profile</h4>
                      <hr>

                      <div class="row">
                        <div class="form-group col">
                            <label for="b_name">Business name</label>
                            <input type="text" class="form-control" placeholder="Business name" name="business_name" id="b_name" value = "<?php echo $_SESSION["business_name"]; ?>">
                        </div>
                        <div class="form-group col">
                            <label for="industry">Industry</label>
                            <input type="text" class="form-control" placeholder="Industry" name="industry" id="industry" value = "<?php echo $_SESSION["industry"]; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" placeholder="Describe your business in a few words" name="description" id="description" rows="2"><?php echo $_SESSION["description"]; ?></textarea>
                      </div>


 <!--PLEASE CAN YOU ADD AN IMAGE TAG SUCH THAT IF I SHOULD COME
     BACK HERE AGAIN TO UPDATE THE PROFILE IT WILL ALREADY HAVE MY DEFAULT IMAGE 
      PREVIEWED  -->

                      <h6>Business logo</h6>
                      <div class="fileinput fileinput-new" data-provides="fileinput" style="margin-bottom: 30px;">
                          <div class="fileinput-new thumbnail" style="width: 200px; height: 150px; border: 1px solid #eee;">
                          </div>
                          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                          <div>
                            <span class="btn btn-default btn-file"><span class="fileinput-new">click to select image</span><span class="fileinput-exists">Change</span><input type="file" name="business_logo"></span>
                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                          </div>
                      </div>

                      <div class="form-group">
                          <button type="submit" name="submit" id="submit" class="btn btn-success">update profile</button>
                      </div>

                    </form>

                </div>

            </div>

            <div class="col"></div>
        </div>       

    </div>
    



</body>
</html>