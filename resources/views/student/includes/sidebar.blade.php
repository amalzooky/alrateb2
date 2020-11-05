<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item "><a href="{{route('student.dashboard')}}"><i class="la la-mouse-pointer"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
            </li>

            <li class="nav-item  ">
                <a href="{{route('student.lacture')}}"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المواد الدراسية </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\Subjects::count()}}</span>
                </a>
               
            </li>
  <li class="nav-item  ">
                <a href="{{route('student.groups')}}"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">مجموعتي  </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\Groups::count()}}</span>
                </a>
                {{-- <ul class="menu-content">
                    <li class=""><a class="menu-item" href="{{route('admin.languages')}}"
                                    data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.languages.create')}}" data-i18n="nav.dash.crypto">أضافة
                            لغة جديده </a>
                    </li>
                </ul> --}}
            </li>



            <li class="nav-item  ">
                <a href="{{route('student.lacture')}}"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المحاضرات </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2"></span>
                </a>
              
            </li>


          
            <li class="nav-item"><a href="{{route('student.teachers')}}"><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">معلمي  </span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2"></span>
                </a>

               
            </li>
            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">نتيجة الاختبار  </span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2"></span>
                </a>
              
            </li>

            <li class="nav-item"><a href="{{route('student.acount')}}"><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">حسابي  </span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2"></span>
                </a>
               
            </li>


            
        </ul>
    </div>
</div>
