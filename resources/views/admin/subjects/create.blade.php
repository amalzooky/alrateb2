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
                                <li class="breadcrumb-item"><a href=""> المواد </a>
                                </li>
                                <li class="breadcrumb-item active">اضافه ماده
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
                                    <h4 class="card-title" id="basic-layout-form"> إضافة ماده </h4>
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
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('admin.subjects.store')}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات الماده </h4>

                                                @if(get_languages()->count() > 0)
                                                    @foreach(get_languages() as $index => $lang)
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> اسم الماده
                                                                        - {{__('messages.'.$lang -> abbr)}} </label>
                                                                    <input type="text" value="" id="name"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           name="subject[{{$index}}][name]">
                                                                    @if(!empty(session()->get('errors')['subject.' . $index . '.name']))
                                                                    <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">


                                                                <div class="form-group">
                                                                    <label for="projectinput1"> تخصص الماده
                                                                        - {{__('messages.'.$lang -> abbr)}} </label>
                                                                    <select name="subject[{{$index}}][major]" class="form-control">
                                                                        <option value="">اختر التخصص</option>
                                                                        @if(!empty($majors) && count($majors) > 0)
                                                                            @foreach($majors as $major)
                                                                                @if($major->translation_lang === $lang -> abbr)
                                                                                    <option value="{{$major->id}}">{{$major->major_name}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        @else
                                                                            <option value="" disabled>ليس هناك تخصصات</option>
                                                                        @endif
                                                                    </select>
                                                                    @if(!empty(session()->get('errors')['subject.' . $index . '.major']))
                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @endif
                                                                </div>



                                                                
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> السنه الدراسيه
                                                                        - {{__('messages.'.$lang -> abbr)}} </label>
                                                                    <select name="subject[{{$index}}][scyear]" class="form-control">
                                                                        <option value="">اختر السنه الدراسيه</option>
                                                                        @if(!empty($scYears) && count($scYears) > 0)
                                                                            @foreach($scYears as $year)
                                                                                @if($year->translation_lang === $lang -> abbr)
                                                                                    <option value="{{$year->id}}">{{$year->name}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        @else
                                                                            <option value="" disabled>ليس هناك سنوات دراسيه</option>
                                                                        @endif
                                                                    </select>
                                                                    @if(!empty(session()->get('errors')['subject.' . $index . '.scyear']))
                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">الفصل الدراسى
                                                                        - {{__('messages.'.$lang -> abbr)}} </label>
                                                                    <select name="subject[{{$index}}][semester]" class="form-control">
                                                                        <option value="">اختر الفصل الدراسى</option>
                                                                        <option value="1">الفصل الدراسى الاول</option>
                                                                        <option value="2">الفصل الدراسى الثانى</option>
                                                                    </select>
                                                                    @if(!empty(session()->get('errors')['subject.' . $index . '.semester']))
                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">وصف الماده
                                                                        - {{__('messages.'.$lang -> abbr)}} </label>
                                                                    <textarea name="subject[{{$index}}][description]" class="form-control"></textarea>
                                                                    @if(!empty(session()->get('errors')['subject.' . $index . '.description']))
                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">الاحد
                                                                        - {{__('messages.'.$lang -> abbr)}} </label>
                                                                    <input name="subject[{{$index}}][sunday]" class="form-control">
                                                                    @if(!empty(session()->get('errors')['subject.' . $index . '.sunday']))
                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">الاثنين
                                                                        - {{__('messages.'.$lang -> abbr)}} </label>
                                                                    <input name="subject[{{$index}}][monday]" class="form-control">
                                                                    @if(!empty(session()->get('errors')['subject.' . $index . '.monday']))
                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">الثلاثاء
                                                                        - {{__('messages.'.$lang -> abbr)}} </label>
                                                                    <input name="subject[{{$index}}][tuesday]" class="form-control">
                                                                    @if(!empty(session()->get('errors')['subject.' . $index . '.tuesday']))
                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">الاربعاء
                                                                        - {{__('messages.'.$lang -> abbr)}} </label>
                                                                    <input name="subject[{{$index}}][wednesday]" class="form-control">
                                                                    @if(!empty(session()->get('errors')['subject.' . $index . '.wednesday']))
                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">الخميس
                                                                        - {{__('messages.'.$lang -> abbr)}} </label>
                                                                    <input name="subject[{{$index}}][thursday]" class="form-control">
                                                                    @if(!empty(session()->get('errors')['subject.' . $index . '.thursday']))
                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">الجمعه
                                                                        - {{__('messages.'.$lang -> abbr)}} </label>
                                                                    <input name="subject[{{$index}}][friday]" class="form-control">
                                                                    @if(!empty(session()->get('errors')['subject.' . $index . '.friday']))
                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">السبت
                                                                        - {{__('messages.'.$lang -> abbr)}} </label>
                                                                    <input name="subject[{{$index}}][saturday]" class="form-control">
                                                                    @if(!empty(session()->get('errors')['subject.' . $index . '.saturday']))
                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 hidden">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> أختصار
                                                                    اللغة {{__('messages.'.$lang -> abbr)}} </label>
                                                                <input type="text" id="abbr"
                                                                       class="form-control"
                                                                       placeholder="  "
                                                                       value="{{$lang -> abbr}}"
                                                                       name="subject[{{$index}}][abbr]">
                                                                @if(!empty(session()->get('errors')['subject.' . $index . '.abbr']))
                                                                    <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                    @endforeach
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group mt-1">
                                                                <input type="checkbox" value="1"
                                                                       name="subject[0][active]"
                                                                       id="switcheryColor4"
                                                                       class="switchery" data-color="success"
                                                                       checked/>
                                                                <label for="switcheryColor4"
                                                                       class="card-title ml-1">الحالة</label>

                                                                @if(!empty(session()->get('errors')['subject.' . $index . '.active']))
                                                                    <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
                                                </button>
                                            </div>
                                        </form>
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
