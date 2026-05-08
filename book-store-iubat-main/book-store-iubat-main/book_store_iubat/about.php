<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">home</a> / about </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>Dive deep or discover new worlds. Explore academic resources and engrossing reads, all in one place.</p>
         <p>All book in one place for Iubatian.</p>
         <p>Happy book reading!</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">client's reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>The smile that flickers on baby's lips when he sleeps-
does anybody know where it was born?
Yes, there is a rumor
that a young pale beam of a crescent moon touched
the edge of a vanishing autumn cloud!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Rabindranath Tagore</h3>
      </div>

      <div class="box">
         <img src="images/pic-2.png" alt="">
         <p>“শেষবার তার সাথে যখন হয়েছে দেখা মাঠের উপরে
বলিলাম: ‘একদিন এমন সময়
আবার আসিয়ো তুমি, আসিবার ইচ্ছা যদি হয়!–
পঁচিশ বছর পরে!”</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Jibanananda Das</h3>
      </div>

      <div class="box">
         <img src="images/pic-3.png" alt="">
         <p>"মহা – বিদ্রোহী রণক্লান্ত
আমি সেই দিন হব শান্ত।
যবে উৎপীড়িতের ক্রন্দন-রোল আকাশে-বাতাসে ধ্বনিবে না,
অত্যাচারীর খড়গ কৃপাণ ভীম রণ, ভূমে রণিবে না-
বিদ্রোহী রণক্লান্ত
আমি সেই দিন হব শান্ত।”</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Kazi Nazrul</h3>
      </div>

      <div class="box">
         <img src="images/pic-4.png" alt="">
         <p>“মিথ্যা হলো শয়তানের বিয়ের মন্ত্র। মিথ্যা বললেই শয়তানের বিয়ে হয়। বিয়ে হওয়া মানেই সন্তান-সন্ততি হওয়া। একটা মিথ্যার পর আরো অনেকগুলি মিথ্যা বলতে হয় এই কারণেই।পরের মিথ্যাগুলি শয়তানের সন্তান।”!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Humayun Ahmed</h3>
      </div>

      <div class="box">
         <img src="images/pic-5.png" alt="">
         <p>“-আজকের বিকেলটা বড় সুন্দর, তাই না?
-কালও এমনটি ছিলো।
-চিরকাল যদি এমন থাকে?
-তাহলে বড় একঘেয়ে লাগবে।”</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Jahir Raihan</h3>
      </div>

      <div class="box">
         <img src="images/pic-6.png" alt="">
         <p>“পার্থক্যের জন্যই মানুষ মানুষের বন্ধু হয়। আমার ভিতরে যাহা নাই তাই আমরা অপরের নিকটে পাইয়া তাহার সঙ্গে বন্ধুত্ব করি।”</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>JashimUddin</h3>
      </div>

   </div>

</section>

<section class="authors">

   <h1 class="title">greate authors</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/author-1.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Takrim Jengi</h3>
      </div>

      <div class="box">
         <img src="images/author-2.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Utsab Ch Das</h3>
      </div>

      <div class="box">
         <img src="images/author-3.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Snaholata Mondal</h3>
      </div>

      <div class="box">
         <img src="images/author-4.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Rubayeat Joy</h3>
      </div>

      <div class="box">
         <img src="images/author-5.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Broke Shopu</h3>
      </div>

      <div class="box">
         <img src="images/author-6.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Amit Bg.Sheikh</h3>
      </div>

   </div>

</section>







<?php include 'footer.php'; ?>

<!-- js file link  -->
<script src="js/script.js"></script>

</body>
</html>