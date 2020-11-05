<body>
    <div class="blast-box">
      <div class="blast-icon"><span class="fas fa-tint"></span></div>
      <div class="blast-frame">
        <p>change colors</p>
        <div class="blast-colors">
          <div class="blast-color">#86bc42</div>
          <div class="blast-color">#8373ce</div>
          <div class="blast-color">#14d4f4</div>
          <div class="blast-color">#72284b</div>
        </div>
        <p class="blast-custom-colors">Custom colors</p>
        <input type="color" name="blastCustomColor" value="#cf2626">
      </div>
    </div>
    <div class="header-outs" id="header">
      <div class="header-w3layouts">
        <div class="container">
          <div class="row headder-contact">
            <div class="col-lg-6 col-md-7 col-sm-9 info-contact-agile">
              <ul>
          <li>
			
		  <a href="{{route('login')}}"> <span data-blast="color" class="fas fa-sign-in-alt"></span>

                  <p>تسجيل دخول</p></a>
<!--
<a href="" >
			  
			  
			  </a>
-->
                       
                </li>
                <li>
          
                  <span data-blast="color" class="fas fa-phone-volume" ></span>
                  <p >0595952715</p>
                </li>
                <li>
                  <span data-blast="color" class="fas fa-envelope"></span>
                  <p><a class="mail" href="mailto:info@example.com"  >abed.shuqair@gmail.com</a></p>
                </li>
                <li>
                </li>
              </ul>
            </div>
            <div class="col-lg-6 col-md-5 col-sm-3 icons px-0">
              <ul>
                <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                <li><a href="#"><span class="fab fa-twitter"></span></a></li>
          <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
          <li><a href="#"> <span class="fab fa-youtube"></span>
			  
             </a> </li>   
				  
				  
				  <li>  
					  <div class="dropdown">
						  <span class="fa fa-language"></span>
  <div class="dropdown-content">
    <a href="#">English</a>
    <a href="#">عربي</a>
  </div>
</div> </li>   

				 

              </ul>
            </div>
          </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="hedder-up">
           <a href="index.html" class="navbar-brand" data-blast="color">
         <img class="logo" src="{{asset('front/images/logo.png')}}"> </a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="headdser-nav-color" data-blast="bgColor">
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
              <ul class="navbar-nav ">
                <li class="nav-item active">
                  <a class="nav-link" href="/">الرئيسية <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a href="{{route('aboutus')}}" class="nav-link " >من نحن</a>
                </li>
                <li class="nav-item">
                  <a href="{{route('actives')}}" class="nav-link ">النشاطات</a>
                </li>
                <li class="nav-item">
                  <a href="{{route('honor')}}" class="nav-link ">لوحة الشرف</a>
                </li>
                <li class="nav-item">
                  <a href="{{route('aboutus')}}" class="nav-link ">أخبارنا</a>
                </li>
          <li class="nav-item">
            <a href="{{route('saidus')}}" class="nav-link ">قالوا عنا</a>    
          </li>
          <li class="nav-item">
            <a href="{{route('gallery')}}" class="nav-link ">معرض الصور</a>
          </li>
           <li class="nav-item">
            <a href="{{route('contactus')}}" class="nav-link ">تواصل معنا</a>
          </li>
              </ul>
            </div>
          </div>
        </nav>
        <!--//navigation section -->
        <div class="clearfix"> </div>
      </div>
      <!--banner -->
      <!-- Slideshow 4 -->
      <div class="slider">
        <div class="callbacks_container">
          <ul class="rslides" id="slider4">
            <li>
              <div class="slider-img one-img" style="background-image: url({{asset('front/images/slide1.jpg')}});  background-size: cover" >
                <div class="container">
                  <div class="slider-info text-center">
<!--                     <h4 >Hard Work</h4>
 -->                    <h5>أكاديمية الراتب للتفوق واﻹبداع
          </h5>
          <p>
            الاستاذ عبد الرحمن شقير رئيس مجلس إدارة أكاديمية الراتب للتفوق واﻹبداع
                   حفل تكريم الطلبة عام 2019
                    </p>
                    <div class="outs_more-buttn" >
                      <a href="#" data-toggle="modal" data-target="#exampleModalLive" data-blast="bgColor">المزيد</a>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="slider-img two-img" style="background-image: url({{asset('front/images/sid4.jpg')}});  background-size: cover">
                <div class="container">
                  <div class="slider-info text-center">
                    <h4>تكريم أبناء العاملين </h4>
                    <h5>في الوزارات 2019/2020</h5>
                    <p>
تكريم الطلبة الناجحين في الثانوية العامة لعام 2019/2020 من أبناء العاملين في الوزارات تحت رعاية معالي وزير التربية والتعليم أ.د مروان العورتاني ومركز الراتب للتفوق والابداع
                    </p>
                    <div class="outs_more-buttn">
                      <a href="#" data-toggle="modal" data-target="#exampleModalLive" data-blast="bgColor">More</a>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="slider-img three-img" style="background:#000 ;background-image: url({{asset('front/images/slid3.jpg')}});  background-size: cover">
                <div class="container">
                  <div class="slider-info text-center">
                    <h4>الدار البيضاء 
</h4>
                    <h5> سلفيت</h5>
                    <p>زيارة تفقدية لمركز الدار البيضاء لذوي الاعاقة الذهنية في سلفيت
                    </p>
                    <div class="outs_more-buttn">
                      <a href="#" data-toggle="modal" data-target="#exampleModalLive" data-blast="bgColor">المزيد</a>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <!-- This is here just to demonstrate the callbacks -->
        <!-- <ul class="events">
          <li>Example 4 callback events</li>
          </ul>-->
        <div class="clearfix"></div>
      </div>
    </div>
    <!-- //banner -->