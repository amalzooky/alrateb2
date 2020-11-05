@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.students')}}">الطلاب </a>
                                </li>
                                <li class="breadcrumb-item active">بيانات الطالب
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> بيانات طالب </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div>
                                                    <strong>الاسم الكامل</strong> <span>{{$vendor->fullname}}</span>
                                                </div>
                                                <br>
                                                <div>
                                                    <strong>رقم الجوال</strong> <span>{{$vendor->mobile}}</span>
                                                </div>
                                                <br>
                                                <div>
                                                    <strong>المدينه</strong>
                                                    <span>
                                                        {{$vendor->city == 1 ? 'رام الله' : ''}}
                                                        {{$vendor->city == 2 ? 'طولكرم' : ''}}
                                                        {{$vendor->city == 3 ? 'جنين' : ''}}
                                                        {{$vendor->city == 4 ? 'بيت لحم' : ''}}
                                                        {{$vendor->city == 5 ? 'اريحا' : ''}}
                                                        {{$vendor->city == 6 ? 'سلفيت' : ''}}
                                                        {{$vendor->city == 7 ? 'طوباس' : ''}}
                                                        {{$vendor->city == 8 ? 'قلقيليه' : ''}}
                                                        {{$vendor->city == 9 ? 'الخليل' : ''}}
                                                        {{$vendor->city == 10 ? 'القدس' : ''}}
                                                        {{$vendor->city == 11 ? 'نابلس' : ''}}
                                                        {{$vendor->city == 12 ? 'غزه' : ''}}
                                                    </span>
                                                </div>
                                                <br>
                                                <div>
                                                    <strong>الجنس</strong><span>{{$vendor->gender == 1 ? 'ذكر' : 'انثى'}}</span>
                                                </div>
                                                <br>
                                                <div>
                                                    <strong>رابط فسيوك</strong>
                                                    <span>
                                                        {!! !empty($vendor->fb_student) ? '<a href="' . $vendor->fb_student . '">الذهاب الى فيسبوك</a>' : 'لايوجد فيس بوك' !!}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div>
                                                    <strong>البريد الالكترونى</strong> <span>{{$vendor->email}}</span>
                                                </div>
                                                <br>
                                                <div>
                                                    <strong>الهاتف الارضى</strong> <span>{{$vendor->telephone_fix}}</span>
                                                </div>
                                                <br>
                                                <div>
                                                    <strong>تاريخ الميلاد</strong> <span>{{$vendor->birthday}}</span>
                                                </div>
                                                <br>
                                                <div>
                                                    <strong>المدرسه</strong>
                                                    <span>{{$vendor->school_name}}</span>
                                                </div>
                                                <br>
                                                <div>
                                                    <strong>رابط فيسبوك ولى الامر</strong>
                                                    <span>
                                                        {!! !empty($vendor->fb_parent) ? '<a href="' . $vendor->fb_parent . '">الذهاب الى فيسبوك</a>' : 'لايوجد فيس بوك' !!}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection

