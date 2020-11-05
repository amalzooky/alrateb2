@extends('front.layouts.head')
@section('content')
  
    <section class="pt-md-5 pt-sm-4 pt-3">
      <div class="container-fluid ">
        <div class="main row ">
          <!-- TENTH EXAMPLE -->
          <div class="col-lg-4 view view-tenth">
            <img src="{{asset('front/images/Online-Learning.jpg')}}" alt="" class="img-fluid">
			                <h3 class="titpos" data-blast="bgColor"> دروس اون لين</h3>

            <div class="mask">
              <h3 data-blast="bgColor">دروس أون لاين</h3>
              <p>عن طريق التعليم الإلكتروني ,حيث يتمكن الطلبة من المشاركة الفاعلة مع المدرسين في بث حي ومباشر يوميا , حيث بإمكان الطلبة الاستفسار عن اي معلومة والنقاش مع المدرس ومع بعضهم البعض.</p>
              <a href="#" class="info" data-toggle="modal" data-target="#exampleModalLive" data-blast="bgColor">المزيد</a>
            </div>
          </div>
          <div class="col-lg-4 view view-tenth">
            <img src="{{asset('front/images/quilty.jpg')}}" alt="" class="img-fluid">
			                <h3 class="titpos" data-blast="bgColor">جوده عاليه</h3>

            <div class="mask">
              <h3 data-blast="bgColor">جوده عاليه</h3>
              <p>نمتار بإمتلاكنا تقينات صوتية ومرئية عالية الجودة من خلال إمتلاكنات لأفضل البرمجيات في هذا المجال وبإمكان الطلبة الاستفادة من خبرات الاخرين والالتقاء مع زملاء لهم من كل مكان دون حواجز جغرافية او أي معيقات.</p>
              <a href="#" class="info" data-toggle="modal" data-target="#exampleModalLive" data-blast="bgColor">المزيد</a>
            </div>
          </div>
          <div class="col-lg-4 view view-tenth">
			                <h3 class="titpos" data-blast="bgColor"> أسعار مميزه</h3>

            <img src="{{asset('front/images/mony.jpg')}}" alt="" class="img-fluid">
            <div class="mask">
              <h3 data-blast="bgColor">أسعار مميزه</h3>
              <p>يقدم مركز الراتب الخدمات التعليمية بأسعار مميزه ليوفر على طلبته عناء التنقل للمراكز والتي يترتب عليها المصاريف الباهضة وهدر الوقت, ويوفر لهم بيئة تعليمية امنة ومريحة حيث يتلقون الدروس من داخل بيوتهم دون عناء يذكر.</p>
              <a href="#" class="info" data-toggle="modal" data-target="#exampleModalLive" data-blast="bgColor">المزيد</a>
            </div>
          </div>
        </div>
      </div>
    </section>
 
	 <section class="about" id="about">
      <div class="container py-lg-5 py-md-5 py-sm-4 py-3">
        <!--Horizontal Tab-->
        <div id="horizontalTab">
          <ul class="resp-tabs-list justify-content-center">
            <li data-blast="bgColor">من نحن</li>
            <li data-blast="bgColor">أهدافنا</li>
            <li data-blast="bgColor">رؤيتنا </li>
            <li data-blast="bgColor">شعارنا</li>
          </ul>
          <div class="resp-tabs-container">
            <div class="tab1" >
              <div class="row mt-lg-4 mt-3">
                <div class="col-md-7 latest-list">
                  <div class="about-jewel-agile-left">
                    <h4 class="mb-3" data-blast="color">مركز الراتب للتفوق والابداع </h4>
                    <p>مؤسسة تعليمية مساندة تقدم الخدمات التعليمية للطلبة في المرحلة الثانوية والجامعية , في مادة الرياضيات وقريبا في مواد أخرى عن طريق التعليم الإلكتروني.</p>
                    <h5 data-blast="color"> من نحن</h5>
                  </div>
                </div>
                <div class="col-md-5 about-txt-img">
                  <img src="{{asset('front/images/ab1.jpg')}}" class="img-thumbnail" alt="">
                </div>
              </div>
            </div>
            <div class="tab2">
              <div class="row mt-lg-4 mt-3">
                <div class="col-md-5 about-txt-img">
                  <img src="{{asset('front/images/ab3.jpg')}}" class="img-thumbnail" alt="">
                </div>
                <div class="col-md-7 latest-list">
                  <div class="about-jewel-agile-left">
                    <h4 class="mb-3" data-blast="color">التفوق والابداع</h4>
                    <p>توفير بيئة تعليمية امنة ومريحة حيث يتلقون الدروس من داخل بيوتهم دون عناء يذكر. يمكن التعليم الإلكتروني الطلبة من حضور الحصصة مسجلة بأكثر من برنامج وبتقنية عالية الجودة في اي وقت وبإمكان الطلبة الرجوع لفهر الحصص السابقة وحضورها وتكون مجدولة حسب ترتيب معين </p>
                    <h5 data-blast="color">أهدافنا </h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab3">
              <div class="row mt-lg-4 mt-3">
                <div class="col-md-7 latest-list">
                  <div class="about-jewel-agile-left">
                    <h4 class="mb-3" data-blast="color">التفوق والابداع</h4>
                    <p>يقدم مركز الراتب اختبارات الكتروني ويعزز الطلبة بالكثير من الجوائز القيمة مثل لاب توب وايباد وجوائز نقدية وغيرها من الجوائز الفورية مثل شحن الهاتف الخلوي بقيمة معينة تصل الطلبة في نفس اللحظة</p>
                    <h5 data-blast="color">شعارنا</h5>
                  </div>
                </div>
                <div class="col-md-5 about-txt-img">
                  <img src="{{asset('front/images/ab2.jpg')}}" class="img-thumbnail" alt="">
                </div>
              </div>
            </div>
            <div class="tab4">
              <div class="row mt-lg-4 mt-3">
                <div class="col-md-5 about-txt-img">
                  <img src="{{asset('front/images/ab1.jpg')}}" class="img-thumbnail" alt="">
                </div>
                <div class="col-md-7 latest-list">
                  <div class="about-jewel-agile-left">
                    <h4 class="mb-3" data-blast="color"> رؤيتنا</h4>
                    <p>  يتمكن الطلبة من المشاركة الفاعلة مع المدرسين في بث حي ومباشر يوميا , حيث بإمكان الطلبة الاستفسار عن اي معلومة والنقاش مع المدرس ومع بعضهم البعض, بتقنيات صوتية عالية الجودة وبإمكان الطلبة الاستفادة من خبرات الاخرين والالتقاء مع زملاء لهم من كل مكان دون حواجز جغرافية او أي معيقات.   </p>
                    <h5 data-blast="color">رؤيتنا </h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--//about-->
    <!--service-->
   <section class="service py-lg-4 py-md-3 py-sm-3 py-3" id="service">
      <div class="container py-lg-5 py-md-5 py-sm-4 py-3">
        <h3 class="title clr text-center mb-lg-5 mb-md-4  mb-sm-4 mb-3">مشاهدة الدروس أون لاين</h3>
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6 w3layouts-service-list text-center">
            <div class="white-shadow">
              <div class="text-wls-ser-bake">
                <span class="fas fa-book banner-icon" data-blast="color"></span>
              </div>
              <div class="ser-inner-info">
                <h4 class="my-3">تواصل معنا ﻹنشاء حسابك</h4>
                <p></p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 w3layouts-service-list text-center">
            <div class="white-shadow">
              <div class="text-wls-ser-bake">
                <span class="fas fa-pencil-alt banner-icon" data-blast="color"></span>
              </div>
              <div class="ser-inner-info">
                <h4 class="my-3">سجل دخولك من خلال موقعنا</h4>
                <p></p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 w3layouts-service-list text-center">
            <div class="white-shadow">
              <div class="text-wls-ser-bake">
                <span class="fas fa-bookmark banner-icon" data-blast="color"></span>
              </div>
              <div class="ser-inner-info">
                <h4 class="my-3">إبدأ في مشاهدة دروسك أون لاين</h4>
                <p></p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 w3layouts-service-list text-center">
            <div class="white-shadow">
              <div class="text-wls-ser-bake">
                <span class="fas fa-address-book banner-icon" data-blast="color"></span>
              </div>
              <div class="ser-inner-info">
                <h4 class="my-3">شاهد تسجيل دروسك بسهولة</h4>
                <p></p>
              </div>
            </div>
          </div>
			
			
          
			
			
        </div>
      </div>
    </section>
    <!--//service-->
    <!--blog -->
    <section class="blog py-lg-4 py-md-3 py-sm-3 py-3" id="blog">
      <div class="container py-lg-5 py-md-4 py-sm-4 py-3">
        <h3 class="title text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">أخر الاجبار </h3>
        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-6 blog-grid-flex">
            <div class="clients-color">
				<div class="news-img">
              <img src="{{asset('front/images/slid3.jpg')}}" alt="">
					</div>
              <div class="blog-txt-info">
                <h4 class="mt-2"><a href="#" data-toggle="modal" data-target="#exampleModalLive" data-blast="color">حفل تكريم الطلبة عام 2018 </a></h4>
                <div class="news-date my-3">
                  <ul>
                    <li class="mr-3"><span class="far fa-calendar-check"></span><a href="#" data-toggle="modal" data-target="#exampleModalLive">12/4/2019</a></li>
                    <li><span class="far fa-comments"></span><a href="#" data-toggle="modal" data-target="#exampleModalLive">5 تعليق</a></li>
                  </ul>
                </div>
                <p>السلام عليكم شباب الرواتب رح نبلش تنزل واكيد كل حد فيكم أهله رح يوصلوا الصراف الآلي ورح يسحب راتبه وعشان هيك اي طالب عليه رسوم ضروري يخبر أهله ويحولها من خلال الصراف الآلي او تحويل</p>
                <div class="outs_more-buttn" >
                  <a href="#" data-toggle="modal" data-target="#exampleModalLive" data-blast="bgColor">المزيد</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6  blog-grid-flex">
            <div class="clients-color">
								<div class="news-img">

              <img src="{{asset('front/images/slide1.jpg')}}"  alt="">
									</div>
              <div class="blog-txt-info">
                <h4 class="mt-2"><a href="#" data-toggle="modal" data-target="#exampleModalLive" data-blast="color">مهم وعاجل </a></h4>
                <div class="news-date my-3">
                  <ul>
                    <li class="mr-3"><span class="far fa-calendar-check"></span><a href="#" data-toggle="modal" data-target="#exampleModalLive">12/4/2019</a></li>
                    <li><span class="far fa-comments"></span><a href="#" data-toggle="modal" data-target="#exampleModalLive">5 تعليق</a></li>
                  </ul>
                </div>
                <p>السلام عليكم شباب الرواتب رح نبلش تنزل واكيد كل حد فيكم أهله رح يوصلوا الصراف الآلي ورح يسحب راتبه وعشان هيك اي طالب عليه رسوم ضروري يخبر أهله ويحولها من خلال الصراف الآلي او تحويل ..</p>
                <div class="outs_more-buttn" >
                  <a href="#" data-toggle="modal" data-target="#exampleModalLive" data-blast="bgColor">المزيد</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6 blog-grid-flex">
            <div class="clients-color">
								<div class="news-img">

              <img src="{{asset('front/images/slid3.jpg')}}" alt="">
									</div>
              <div class="blog-txt-info">
                <h4 class="mt-2"><a href="#" data-toggle="modal" data-target="#exampleModalLive" data-blast="color">عاجل : بخصوص التسجيل </a></h4>
                <div class="news-date my-3">
                  <ul>
                    <li class="mr-3"><span class="far fa-calendar-check"></span><a href="#" data-toggle="modal" data-target="#exampleModalLive">12/4/2019</a></li>
                    <li><span class="far fa-comments"></span><a href="#" data-toggle="modal" data-target="#exampleModalLive">5 تعليق</a></li>
                  </ul>
                </div>
                <p>مركز الراتب للتعليم الالكتروني ما زال مستمر في إعطاء الدروس لطلبته من خلال منظومة التعليم الالكتروني على من يرغب بالانتساب الاتصال على 0568952714 او 0595952715</p>
                <div class="outs_more-buttn" >
                  <a href="#" data-toggle="modal" data-target="#exampleModalLive" data-blast="bgColor">المزيد</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6 blog-grid-flex mt-lg-5 mt-md-4 mt-sm-3 mt-3">
            <div class="clients-color">
								<div class="news-img">

              <img src="{{asset('front/images/sid4.jpg')}}"  alt="">
									</div>
              <div class="blog-txt-info">
                <h4 class="mt-2"><a href="#" data-toggle="modal" data-target="#exampleModalLive" data-blast="color">نبذة مختصرة عن مركز الراتب والية العمل فيه </a></h4>
                <div class="news-date my-3">
                  <ul>
                    <li class="mr-3"><span class="far fa-calendar-check"></span><a href="#" data-toggle="modal" data-target="#exampleModalLive" >12/4/2019</a></li>
                    <li><span class="far fa-comments"></span><a href="#" data-toggle="modal" data-target="#exampleModalLive" >5 تعليق</a></li>
                  </ul>
                </div>
                <p>https://www.youtube.com/watch?v=i_oZmdx7WVM&nbsp; </p>
                <div class="outs_more-buttn" >
                  <a href="#" data-toggle="modal" data-target="#exampleModalLive" data-blast="bgColor">المزيد</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6 blog-grid-flex mt-lg-5 mt-md-4 mt-sm-3 mt-3" >
            <div class="clients-color">
								<div class="news-img">

              <img src="{{asset('front/images/sid2.png')}}"  alt="">
									</div>
              <div class="blog-txt-info">
                <h4 class="mt-2"><a href="#" data-toggle="modal" data-target="#exampleModalLive" data-blast="color">حفل تكريم الطلبة عام 2018 </a></h4>
                <div class="news-date my-3">
                  <ul>
                    <li class="mr-3"><span class="far fa-calendar-check"></span><a href="#" data-toggle="modal" data-target="#exampleModalLive">12/4/2019</a></li>
                    <li><span class="far fa-comments"></span><a href="#" data-toggle="modal" data-target="#exampleModalLive">5 تعليق</a></li>
                  </ul>
                </div>
                <p>https://www.youtube.com/watch?v=U79wDKJ3FPg&nbsp;
</p>
                <div class="outs_more-buttn" >
                  <a href="#" data-toggle="modal" data-target="#exampleModalLive" data-blast="bgColor">المزيد</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6 blog-grid-flex mt-lg-5 mt-md-4 mt-sm-3 mt-3">
            <div class="clients-color">
								<div class="news-img">

              <img src="{{asset('front/images/slide1.jpg')}}" alt="">
									</div>
              <div class="blog-txt-info">
                <h4 class="mt-2"><a href="#" data-toggle="modal" data-target="#exampleModalLive" data-blast="color">للمعنيين </a></h4>
                <div class="news-date my-3">
                  <ul>
                    <li class="mr-3"><span class="far fa-calendar-check"></span><a href="#" data-toggle="modal" data-target="#exampleModalLive">12/4/2019</a></li>
                    <li><span class="far fa-comments"></span><a href="#" data-toggle="modal" data-target="#exampleModalLive">5 تعليق</a></li>
                  </ul>
                </div>
                <p>مركز الراتب للتفوق والابداع يستقبل الطلاب على مدار العام الدراسي والتجديد الدائم لدورات الثانوية العامة  لكافة الفروع والمواد</p>
                <div class="outs_more-buttn" >
                  <a href="#" data-toggle="modal" data-target="#exampleModalLive" data-blast="bgColor">المزيد</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--//blog -->
   
    <!--stats-->
       <!--stats-->
   <section class="stats py-lg-4 py-md-3 py-sm-3 py-3" id="stats">
      <div class="container py-lg-5 py-md-5 py-sm-4 py-3">
        <h3 class="title clr text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">الاحصائيات </h3>
        <div class="jst-must-info text-center">
          <div class="row stats-info">
            <div class="col-lg-3 col-md-6 col-sm-6 col-6 stats-grid-1">
              <div class="stats-grid" data-blast="bgColor">
                <div class="counter">2045</div>
                <div class="stat-info">
                  <h5 class="pt-2">عدد الطلاب</h5>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-6 stats-grid-2">
              <div class=" stats-grid" data-blast="bgColor">
                <div class="counter">350</div>
                <div class="stat-info">
                  <h5 class="pt-2"> طلاب العام الحالي</h5>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-6 stats-grid-3">
              <div class=" stats-grid" data-blast="bgColor">
                <div class="counter">1000</div>
                <div class="stat-info">
                  <h5 class="pt-2"> الاوائل</h5>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-6 stats-grid-4">
              <div class=" stats-grid" data-blast="bgColor">
                <div class="counter">0</div>
                <div class="stat-info">
                  <h5 class="pt-2"> الراسبين </h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--//stats-->
	  <section class="web_disigner" id="blog">
<div class="web_disigner_contain">
  <center><h1 class="title"  style=" display:inline;">أفضل المدرسين</h1></center>
  <div class="container">
  <div class='row'>
    <div class='col-md-12'>
      <div class="carousel slide media-carousel" id="media">
        <div class="carousel-inner">
          <div class="item  active">
		<div class="row">
              <div class="col-md-4 padtop30">
                <center><div class="parent_circle">
                  <div class="parent_circle_contain">
                  <p>جميل سليم </p>
                  <p>معلم</p>
                  <a class="more" href="#" data-blast="color">أقرأ المزيد...</a>
                </div>
                <div class=" child_round_circle child_round_circle_img1">
			    <img src="{{asset('front/images/gamel.aboahmad_.jpg')}}">

                  
                </div>
                </div>
                </center>
              </div>          
              <div class="col-md-4 padtop30">
               <center><div class="parent_circle">
               <div class="parent_circle_contain">
                  <p>عبدالهادي عبدالحفيظ شقير</p>
                  <p>معلم</p>
                  <a class="more" href="#" data-blast="color">أقرأ المزيد...</a>
                </div>
                <div class="child_round_circle child_round_circle_img2" data-blast="bgColor">
                  <img src="{{asset('front/images/abed.alhadi.jpg')}}">
                </div>
                </div>
                </center>
              </div>
              <div class="col-md-4 padtop30">
            <center> <div class="parent_circle" >
                  <div class="parent_circle_contain">
                  <p>حمدالله أدريس</p>
                  <p>معلم</p>
                  <a class="more" href="#" data-blast="color">أقرأ المزيد...</a>
                </div>
                <div class=" child_round_circle child_round_circle_img3 "data-blast="bgColor">
                  			    <img src="{{asset('front/images/hamdalleh.edres.jpg')}}">

                </div>
                </div>
                </center> 
              </div>        
            </div>
          </div>
          <div class="item">
            <div class="row">
              <div class="col-md-4 padtop30">
                <center><div class="parent_circle" >
                  <div class="parent_circle_contain">
                  <p>رأفت محي</p>
                  <p>معلم</p>
                  <a class="more" href="#" data-blast="color">أقرا المزيد...</a>
                </div>
                <div class=" child_round_circle child_round_circle_img4" data-blast="bgColor">
                  			    <img src="{{asset('front/images/raafat.radad_%D8%B1%D8%A7%D9%81%D8%AA.png')}}">

                </div>
                </div>
                </center>
              </div>              
              <div class="col-md-4 padtop30">
                <center><div class="parent_circle" >
                  <div class="parent_circle_contain">
                  <p>لطفية مرشد </p>
                  <p>معللمة</p>
                  <a class="more" href="#" data-blast="color">أقرا المزيد...</a>
                </div>
                <div class=" child_round_circle child_round_circle_img5" data-blast="bgColor">
                        <img src="{{asset('front/images/latefa.jpg')}}">

                </div>
                </div>
                </center>
              </div>    
               <div class="col-md-4 padtop30">
                <center><div class="parent_circle" >
                  <div class="parent_circle_contain">
                  <p>رأفت عيسي</p>
                  <p>معلم</p>
                  <a class="more" href="#" data-blast="color">أقرا المزيد...</a>
                </div>
                <div class=" child_round_circle child_round_circle_img6" data-blast="bgColor">
                           	    <img src="{{asset('front/images/rafat.amer_rafat.jpg')}}">

                </div>
                </div>
                </center>
              </div>            
            </div>
          </div>
          
        </div>
        <a data-slide="prev" href="#media" class="left carousel-control">‹</a>
        <a data-slide="next" href="#media" class="right carousel-control">›</a>
      </div>                          
    </div>
  </div>
</div>
</div>

</section>
	
    <!--Team-->
   <section class="contact py-lg-4 py-md-3 py-sm-3 py-3" id="contact">
      <div class="container py-lg-5 py-md-5 py-sm-4 py-3">
        <h3 class="title clr text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">سجل معنا</h3>
        <div class="row">
          <div class="col-md-5 address-grid">
            <div class="addres-office-hour text-center" >
              <ul>
                <li class="mb-2">
                  <h6 data-blast="color">العنوان</h6>
                </li>
                <li>
                  <p>سلفيت/بلدة الزاوية/قرب مسجد الصديق
</p>
                </li>
              </ul>
              <ul>
                <li class="mt-lg-4 mt-3">
                  <h6 data-blast="color">تليفون</h6>
                </li>
                <li class="mt-2">
                  <p>0595952715</p>
                </li>
                <li class="mt-lg-4 mt-3">
                  <h6 data-blast="color">البريد الالكتروني</h6>
                </li>
                <li class="mt-2">
                  <p><a data-blast="color" class="mail" href="mailto:info@example.com">abed.shuqair@gmail.com</a></p>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-7 contact-form">
            <form action="#" method="post">
              <div class="row text-center contact-wls-detail">
                <div class="col-md-6 form-group contact-forms">
                  <input type="text" class="form-control" placeholder="الاسم" required="">
                </div>
                <div class="col-md-6 form-group contact-forms">
                  <input type="email" class="form-control" placeholder="البريد الالكتروني" required="">
                </div>
              </div>
              <div class="form-group contact-forms">
                <input type="text" class="form-control" placeholder="الموضوع" required="">
              </div>
              <div class="form-group contact-forms">
                <textarea class="form-control" rows="3" placeholder="الرساله" required=""></textarea>
              </div>
              <div class="sent-butnn text-center">
                <button type="submit" class="btn btn-block" data-blast="bgColor">أرسل</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
	  <section class=" py-lg-4 py-md-3 py-sm-3 py-3">
      <div class="container py-lg-5 py-md-5 py-sm-4 py-3">
        <h3 class="title text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">قالوا عنا</h3>
	 <section id="testim" class="testim">
<!--         <div class="testim-cover"> -->
            <div class="wrap">

                <span id="right-arrow" class="arrow right fa fa-chevron-right"></span>
                <span id="left-arrow" class="arrow left fa fa-chevron-left "></span>
                <ul id="testim-dots" class="dots">
                    <li class="dot active"></li><!--
                    --><li class="dot"></li><!--
                    --><li class="dot"></li><!--
                    --><li class="dot"></li><!--
                    --><li class="dot"></li>
                </ul>
                <div id="testim-content" class="cont">
                    
                    <div class="active">
                        <div class="img"><img src="https://image.ibb.co/hgy1M7/5a6f718346a28820008b4611_750_562.jpg" alt=""></div>
                        <h2>Lorem P. Ipsum</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>                    
                    </div>

                    <div>
                        <div class="img"><img src="https://image.ibb.co/cNP817/pexels_photo_220453.jpg" alt=""></div>
                        <h2>Mr. Lorem Ipsum</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>                    
                    </div>

                    <div>
                        <div class="img"><img src="https://image.ibb.co/iN3qES/pexels_photo_324658.jpg" alt=""></div>
                        <h2>Lorem Ipsum</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>                    
                    </div>

                    <div>
                        <div class="img"><img src="https://image.ibb.co/kL6AES/Top_SA_Nicky_Oppenheimer.jpg" alt=""></div>
                        <h2>Lorem De Ipsum</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>                    
                    </div>

                    <div>
                        <div class="img"><img src="https://image.ibb.co/gUPag7/image.jpg" alt=""></div>
                        <h2>Ms. Lorem R. Ipsum</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>                    
                    </div>

                </div>

            </div>
<!--         </div> -->
    </section>
		  </div>
   </section>
   
   

@endsection