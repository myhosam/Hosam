<?php
include("header.php")

?>
      <!-- product section start -->
      <div class="product_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h1 class="product_taital">Products</h1>
                  <p class="product_text">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim</p>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="owl-carousel owl-theme">
                     <div class="item">
                        <div class="image_main"><img src="images/img-2.png" alt="image" /></div>
                        <h6 class="price_text">Price <br><span style="color: #f75261;">$10</span></h6>
                     </div>
                     <div class="item">
                        <div class="image_main"><img src="images/img-2.png" alt="image" /></div>
                        <h6 class="price_text">Price <br><span style="color: #f75261;">$10</span></h6>
                     </div>
                     <div class="item">
                        <div class="image_main"><img src="images/img-2.png" alt="image" /></div>
                        <h6 class="price_text">Price <br><span style="color: #f75261;">$10</span></h6>
                     </div>
                     <div class="item">
                        <div class="image_main"><img src="images/img-2.png" alt="image" /></div>
                        <h6 class="price_text">Price <br><span style="color: #f75261;">$10</span></h6>
                     </div>
                     <div class="item">
                        <div class="image_main"><img src="images/img-1.png" alt="image" /></div>
                        <h6 class="price_text">Price <br><span style="color: #f75261;">$10</span></h6>
                     </div>
                     <div class="item">
                        <div class="image_main"><img src="images/img-2.png" alt="image" /></div>
                        <h6 class="price_text">Price <br><span style="color: #f75261;">$10</span></h6>
                     </div>
                     <div class="item">
                        <div class="image_main"><img src="images/img-2.png" alt="image" /></div>
                        <h6 class="price_text">Price <br><span style="color: #f75261;">$10</span></h6>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- product section start -->
    <?php

include("footer.php")

?>
      <script>
         $('.owl-carousel').owlCarousel({
         loop:true,
         margin:30,
         nav:true,
         responsive:{
          0:{
              items:1
          },
          600:{
              items:3
          },
          1000:{
              items:4
          }
         }
         })
      </script>
   </body>
</html>