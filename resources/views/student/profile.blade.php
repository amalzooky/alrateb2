@extends('layouts.student')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style type="text/css">

.panel {
  box-shadow: none;
}
.panel-heading {
  border-bottom: 0;
}
.panel-title {
  font-size: 17px;
}
.panel-title > small {
  font-size: .75em;
  color: #999999;
}
.panel-body *:first-child {
  margin-top: 0;
}
.panel-footer {
  border-top: 0;
}

.panel-default > .panel-heading {
    color: #333333;
    background-color: transparent;
    border-color: rgba(0, 0, 0, 0.07);
}

/**
 * Profile
 */
/*** Profile: Header  ***/
.profile__avatar {
  float: right;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  margin-right: 20px;
  overflow: hidden;
}
@media (min-width: 768px) {
  .profile__avatar {
    width: 100px;
    height: 100px;
  }
}
.profile__avatar > img {
  width: 100%;
  height: auto;
}
.profile__header {
  overflow: hidden;
}
.profile__header p {
  margin: 20px 0;
}
/*** Profile: Table ***/
@media (min-width: 992px) {
  .profile__table tbody th {
    width: 200px;
  }
}
/*** Profile: Recent activity ***/
.profile-comments__item {
  position: relative;
  padding: 15px 16px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}
.profile-comments__item:last-child {
  border-bottom: 0;
}
.profile-comments__item:hover,
.profile-comments__item:focus {
  background-color: #f5f5f5;
}
.profile-comments__item:hover .profile-comments__controls,
.profile-comments__item:focus .profile-comments__controls {
  visibility: visible;
}
.profile-comments__controls {
  position: absolute;
  top: 0;
  right: 0;
  padding: 5px;
  visibility: hidden;
}
.profile-comments__controls > a {
  display: inline-block;
  padding: 2px;
  color: #999999;
}
.profile-comments__controls > a:hover,
.profile-comments__controls > a:focus {
  color: #333333;
}
.profile-comments__avatar {
  display: block;
  float: left;
  margin-right: 20px;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  overflow: hidden;
}
.profile-comments__avatar > img {
  width: 100%;
  height: auto;
}
.profile-comments__body {
  overflow: hidden;
}
.profile-comments__sender {
  color: #333333;
  font-weight: 500;
  margin: 5px 0;
}
.profile-comments__sender > small {
  margin-left: 5px;
  font-size: 12px;
  font-weight: 400;
  color: #999999;
}
@media (max-width: 767px) {
  .profile-comments__sender > small {
    display: block;
    margin: 5px 0 10px;
  }
}
.profile-comments__content {
  color: #999999;
}
/*** Profile: Contact ***/
.profile__contact-btn {
  padding: 12px 20px;
  margin-bottom: 20px;
}
.profile__contact-hr {
  position: relative;
  border-color: rgba(0, 0, 0, 0.1);
  margin: 40px 0;
}
.profile__contact-hr:before {
  content: "OR";
  display: block;
  padding: 10px;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  background-color: #f5f5f5;
  color: #c6c6cc;
}
.profile__contact-info-item {
  margin-bottom: 30px;
}
.profile__contact-info-item:before,
.profile__contact-info-item:after {
  content: " ";
  display: table;
}
.profile__contact-info-item:after {
  clear: both;
}
.profile__contact-info-item:before,
.profile__contact-info-item:after {
  content: " ";
  display: table;
}
.profile__contact-info-item:after {
  clear: both;
}
.profile__contact-info-icon {
  float: left;
  font-size: 18px;
  color: #999999;
}
.profile__contact-info-body {
  overflow: hidden;
  padding-left: 20px;
  color: #999999;
}
.profile__contact-info-body a {
  color: #999999;
}
.profile__contact-info-body a:hover,
.profile__contact-info-body a:focus {
  color: #999999;
  text-decoration: none;
}
.profile__contact-info-heading {
  margin-top: 2px;
  margin-bottom: 5px;
  font-weight: 500;
  color: #999999;

</style>





@section('content')

<div class="app-content content">
  <div class="container">
    <div  class="row">
      <div class="col-xs-12 col-sm-9">

        <!-- User profile -->
        <div class="panel panel-default">
          <div class="panel-heading">
          </div>
          <div class="panel-body">
            <div class="profile__avatar">
              <img src=" {{asset('/'.Auth::guard('student')->user()->avatar)}}" alt="...">
            </div>
            <div class="profile__header">
              <h4>{{ \Auth::guard('student')->user()->username }} <small>{{ \Auth::guard('student')->user()->user_type}}</small></h4>
              <p class="text-muted">
               
              </p>
              <p>
                <a href="#">{{ \Auth::guard('student')->user()->email}}</a>
              </p>
            </div>
          </div>
        </div>

        <!-- User info -->
        <div class="panel panel-default">
          <div class="panel-heading">
          <h4 class="panel-title">معلومات عنك</h4>
          </div>
          <div class="panel-body">
            <table class="table profile__table">
              <tbody>
                <tr>
                  <th><strong>الاسم الكامل</strong></th>
                  <td>{{ \Auth::guard('student')->user()->fullname}}</td>
                </tr>
                 <tr>
                  <th><strong>النوع</strong></th>
                  <td>{{ \Auth::guard('student')->user()->gender == 1 ? 'ذكر' : 'أنثي' }}</td>
                
                </tr>
                <tr>
                  <th><strong>تاريخ الميلا</strong></th>
                  <td>{{ \Auth::guard('student')->user()->birthday}}</td>
                </tr>
                <tr>
                  <th><strong>المدينة</strong></th>
<td> {{\Auth::guard('student')->user()->city == 1 ? 'رام الله' : ''}}
                                                       {{\Auth::guard('student')->user()->city == 2 ? 'طولكرم' : ''}}
                                                       {{\Auth::guard('student')->user()->city == 3 ? 'جنين' : ''}}
                                                       {{\Auth::guard('student')->user()->city == 4 ? 'بيت لحم' : ''}}
                                                        {{\Auth::guard('student')->user()->city == 5 ? 'اريحا' : ''}}
                                                        {{\Auth::guard('student')->user()->city == 6 ? 'سلفيت' : ''}}
                                                        {{\Auth::guard('student')->user()->city == 7 ? 'طوباس' : ''}}
                                                        {{\Auth::guard('student')->user()->city == 8 ? 'قلقيليه' : ''}}
                                                       {{\Auth::guard('student')->user()->city == 9 ? 'الخليل' : ''}}
                                                       {{\Auth::guard('student')->user()->city == 10 ? 'القدس' : ''}}
                                                        {{\Auth::guard('student')->user()->city == 11 ? 'نابلس' : ''}}
                                                        {{\Auth::guard('student')->user()->city == 12 ? 'غزه' : ''}}
</td>


{{-- <td>{{ \Auth::guard('student')->user()->city}}</td> --}}
                </tr>

                 <tr>
                  <th><strong>أسم المدرسة</strong></th>
<td>  {{!empty($school->school_name) ? $school->school_name : 'لم يتم ادخال المدرسه'}}</td>
                </tr>
                 <tr>
                  <th><strong>التخصص</strong></th>
<td>  {{!empty($major->major_name) ? $major->major_name : 'لم يتم ادخال المدرسه'}}</td>
                </tr>
                 <tr>
                  <th><strong>المجموعه</strong></th>
<td>{{ \Auth::guard('student')->user()->student_group}}</td>
                </tr>


                <tr>
                  <th><strong>تاريخ الانتهاء</strong></th>
<td>{{ \Auth::guard('student')->user()->expire_date}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Community -->
        <div class="panel panel-default">
          <div class="panel-heading">
          <h4 class="panel-title">معلومات التواصل</h4>
          </div>
          <div class="panel-body">
            <table class="table profile__table">
              <tbody>
               <tr>
               <th><strong>رقم المنزل</strong></th>
                  <td>{{ \Auth::guard('student')->user()->telephone_fix}}</td>
</tr>
               <tr>
               <th><strong>رقم الموبيل</strong></th>
                  <td>{{ \Auth::guard('student')->user()->mobile}}</td>
</tr>
                <tr>
                  <th><strong>رابط الفيس بوك</strong></th>
                  <td>{{ \Auth::guard('student')->user()->fb_student}}</td>
                </tr>
                <tr>
                  <th><strong>فيس بوك ولي الامر</strong></th>
                  <td>{{ \Auth::guard('student')->user()->fb_parent}}</td>
                </tr>
                <tr>
                 
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Latest posts -->
        <div class="panel panel-default">
          <div class="panel-heading">
          <h4 class="panel-title">الملاحظات</h4>
          </div>
          <div class="panel-body">
            <div class="profile__comments">
              <div class="profile-comments__item">
                <div class="profile-comments__controls">
                  <a href="#"><i class="fa fa-share-square-o"></i></a>
                  <a href="#"><i class="fa fa-edit"></i></a>
                  <a href="#"><i class="fa fa-trash-o"></i></a>
                </div>
              
                <div class="profile-comments__body">
                 
                  <div class="profile-comments__content">

                  {{ \Auth::guard('student')->user()->notes}}
                  </div>
                </div>
              </div>



             
            
            </div>
          </div>
        </div>
  <div class="panel panel-default">
          <div class="panel-heading">
          <h4 class="panel-title">أخر الاخبار</h4>
          </div>
          <div class="panel-body">
            <div class="profile__comments">
     


              <div class="profile-comments__item">
                <div class="profile-comments__controls">
                  <a href="#"><i class="fa fa-share-square-o"></i></a>
                  <a href="#"><i class="fa fa-edit"></i></a>
                  <a href="#"><i class="fa fa-trash-o"></i></a>
                </div>
                <div class="profile-comments__avatar">
                  <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="...">
                </div>
                <div class="profile-comments__body">
                  <h5 class="profile-comments__sender">
                    Richard Roe <small>5 hours ago</small>
                  </h5>
                  <div class="profile-comments__content">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero itaque dolor laboriosam dolores magnam mollitia, voluptatibus inventore accusamus illo.
                  </div>
                </div>
              </div>
              <div class="profile-comments__item">
                <div class="profile-comments__controls">
                  <a href="#"><i class="fa fa-share-square-o"></i></a>
                  <a href="#"><i class="fa fa-edit"></i></a>
                  <a href="#"><i class="fa fa-trash-o"></i></a>
                </div>
                <div class="profile-comments__avatar">
                  <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="...">
                </div>
                <div class="profile-comments__body">
                  <h5 class="profile-comments__sender">
                    Richard Roe <small>1 day ago</small>
                  </h5>
                  <div class="profile-comments__content">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, esse, magni aliquam quisquam modi delectus veritatis est ut culpa minus repellendus.
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="col-xs-12 col-sm-3">

        <!-- Contact user -->
        <p>
          <a href="#" class="profile__contact-btn btn btn-lg btn-block btn-info" data-toggle="modal" data-target="#profile__contact-form">
          تعديل الملف الشخصي
          </a>
        </p>

        <hr class="profile__contact-hr">

        <!-- Contact info -->
        <div class="profile__contact-info">
          <div class="profile__contact-info-item">
            <div class="profile__contact-info-icon">
              <i class="fa fa-phone"></i>
            </div>
            <div class="profile__contact-info-body">
              <h5 class="profile__contact-info-heading">التليفون الارضي</h5>
              {{ \Auth::guard('student')->user()->telephone_fix }}
            </div>
          </div>
          <div class="profile__contact-info-item">
            <div class="profile__contact-info-icon">
              <i class="fa fa-phone"></i>
            </div>
            <div class="profile__contact-info-body">
              <h5 class="profile__contact-info-heading">رقم الموبيل</h5>
             {{ \Auth::guard('student')->user()->mobile }}
            </div>
          </div>
          <div class="profile__contact-info-item">
            <div class="profile__contact-info-icon">
              <i class="fa fa-envelope-square"></i>
            </div>
            <div class="profile__contact-info-body">
              <h5 class="profile__contact-info-heading">البريد الالكتروني</h5>
              <a href="mailto:admin@domain.com">{{ \Auth::guard('student')->user()->email }}</a>
            </div>
          </div>
          <div class="profile__contact-info-item">
            <div class="profile__contact-info-icon">
              <i class="fa fa-map-marker"></i>
            </div>
            <div class="profile__contact-info-body">
              <h5 class="profile__contact-info-heading">المدرسة</h5>
              {{!empty($school->school_name) ? $school->school_name : 'لم يتم ادخال المدرسه'}}
            </div>
          </div>
        </div>

      </div>
    </div>
    </div>
</div>
@endsection
