<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="website.css" />
    <title></title>
    <style>

    </style>
</head>

<body>
    <div class="heading">
    <h1 class="logo"><img src="logo.jpg" width="200" height="100" alt=""/></a></h1>
    <ul class="shell">
        <li class="button">
            <span>Home</span>
            <ul>
                <li><a href="index2.php" accesskey="1" title="">Home</a></li>
            </ul>
        </li>
        <li class="button">
            <span>about</span>
            <ul>
                <li><a href="aboutus.php" accesskey="2" title="">About US</a></li>
            </ul>
        </li>

        <li class="portrait">
            <ul class="information">
                <li><a href="upload.php" accesskey="3" title="">Careers </a></li>
                <li><a href="orderonline.php" accesskey="4" title="">Order online </a></li>
            </ul>
        </li>
        <li class="button">
            <span>contact</span>
            <ul>
                <li>Contact us</li>
            </ul>
        </li>
        <li class="button">
            <span>register</span>
            <ul>
                <li><a href="vip.php" accesskey="6" title="">Register vip</a></li>
            </ul>
        </li>
    </ul>
</div>



  
      
  
  
  
  
  
      <div class="hero">
        <div class="">
          <h1 class="color4">join us</h1>
          <p class="color3"> Do you want join us? Now is the chance </p>
        </div>
      </div>
  
      <div class="wrapper">
        <div id="welcome" class="">
          <div class="title">
                  <h1 class="color4">Join our team</h1>
                  <p class="color5"> We are expanding our branches and need experienced baker regularly.</n>
                      Send us your detail with the form below</br>
                  and we will be in contact shortly</p>
      
                  <div id="three-column" class="">
                 
                      <div class="title">
                          <h2 class="color4" >Fill out the form below and upload your cover letter and resume</h2>
                          <form action="file_upload.php" method="POST"
                  enctype="multipart/form-data">
       
      
               <div class="shuru">
              <label for="name" class="color1">First name:</label>
              <input type="text" id="name" name="name"/><br>
              <label for="email" class="color1">Last name:</label>
              <input type="text" id="email"name="email" /><br>
              <label for="telephone" class="color1">Email Address:</label>
              <input type="text" id="telephone" name="telephone"/><br>
              <label for="message" class="color1">Work experience:</label>
              <input name="message" id="message" cols="30" rows="10"></br>
      <h4  class="color1">Select files to upload:</h4>
                  <br></br>
                   
                  <!-- name of the input fields are going to
                      be used in our php script-->
                  <input type="file" name="files[]" multiple class="color1"><br>
                  <input type="file" name="files[]" multiple class="color1">
                  <br><br>
                   
                  <input type="submit" name="submit" value="Upload" class="color1">
              </p>
       
          </form>
                      
                      </div>
                  
              
              
                  </div>
                  </div>
                  </div>
      </div>

       
          <footer  class="footer2">  
              The creator of this website is Courtier
                </footer>

</body>

</html>