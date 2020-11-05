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
                                <li class="breadcrumb-item active">إضافة طالب
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
                                    <h4 class="card-title" id="basic-layout-form"> إضافة طالب </h4>
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
                                        <form class="form" action="{{route('admin.students.store')}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label> صوره الطالب </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="avatar">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @if(!empty(session()->get('errors')['avatar']))
                                                    <span class="text-danger"> هذا الحقل مطلوب</span>
                                                @endif
                                            </div>

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات الطالب </h4>

                                                @if(!empty(session()->get('errorUsername')))
                                                    <span class="text-danger">{{session()->get('errorUsername')}}</span>
                                                @endif

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الاسم بالكامل (*)</label>
                                                            <input type="text" value="{{session()->exists('data') ? session()->get('data')['fullname'] : ''}}"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="fullname">
                                                            @if(!empty(session()->get('errors')['fullname']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> أسم المستخدم (*)</label>
                                                            <input type="text" value="{{session()->exists('data') ? session()->get('data')['username'] : ''}}"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="username">
                                                            @if(!empty(session()->get('errors')['username']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> رقم الموبيل (*)</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="mobile" value="{{session()->exists('data') ? session()->get('data')['mobile'] : ''}}">

                                                            @if(!empty(session()->get('errors')['mobile']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الهاتف الارضي </label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="telephone_fix" value="{{session()->exists('data') ? session()->get('data')['telephone_fix'] : ''}}">

                                                            @if(!empty(session()->get('errors')['telephone_fix']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> ألبريد الالكتروني (*)</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="email" value="{{session()->exists('data') ? session()->get('data')['email'] : ''}}">

                                                            @if(!empty(session()->get('errors')['email']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> تاريخ الميلاد (*)</label>
                                                            <input type="date"
                                                                   class="form-control"
                                                                   name="birthday" value="{{session()->exists('data') ? session()->get('data')['birthday'] : ''}}">

                                                            @if(!empty(session()->get('errors')['birthday']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">الجنس (*)</label>
                                                            <select name="gender" class="select2 form-control">
                                                                <optgroup label="من فضلك أختر الجنس ">
                                                                    <option value=""></option>
                                                                    <option value="1" {{session()->exists('data') && !empty(session()->get('data')['gender']) == 1 ? 'selected' : ''}}>ذكر</option>
                                                                    <option value="2" {{session()->exists('data') && !empty(session()->get('data')['gender']) == 2 ? 'selected' : ''}}>انثى</option>
                                                                </optgroup>
                                                            </select>
                                                            @if(!empty(session()->get('errors')['gender']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> تاريخ أنتهاء التفعيل </label>
                                                            <input type="date"
                                                                   class="form-control"
                                                                   name="expire_date" value="{{session()->exists('data') ? session()->get('data')['expire_date'] : ''}}">

                                                            @if(!empty(session()->get('errors')['expire_date']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="projectinput1">المدينه (*)</label>
                                                            <select name="city" class="select2 form-control">
                                                                <optgroup label="من فضلك أختر أسم المدينه ">
                                                                    <option value=""></option>
                                                                    <option value="1" {{session()->exists('data') && session()->get('data')['city'] == 1 ? 'selected' : ''}}>رام الله</option>
                                                                    <option value="2" {{session()->exists('data') && session()->get('data')['city'] == 2 ? 'selected' : ''}}>طولكرم</option>
                                                                    <option value="3" {{session()->exists('data') && session()->get('data')['city'] == 3 ? 'selected' : ''}}>جنين</option>
                                                                    <option value="4" {{session()->exists('data') && session()->get('data')['city'] == 4 ? 'selected' : ''}}>بيت لحم</option>
                                                                    <option value="5" {{session()->exists('data') && session()->get('data')['city'] == 5 ? 'selected' : ''}}>اريحا</option>
                                                                    <option value="6" {{session()->exists('data') && session()->get('data')['city'] == 6 ? 'selected' : ''}}>سلفيت</option>
                                                                    <option value="7" {{session()->exists('data') && session()->get('data')['city'] == 7 ? 'selected' : ''}}>طوباس</option>
                                                                    <option value="8" {{session()->exists('data') && session()->get('data')['city'] == 8 ? 'selected' : ''}}>قلقيليه</option>
                                                                    <option value="9" {{session()->exists('data') && session()->get('data')['city'] == 9 ? 'selected' : ''}}>الخليل</option>
                                                                    <option value="10" {{session()->exists('data') && session()->get('data')['city'] == 10 ? 'selected' : ''}}>القدس</option>
                                                                    <option value="11" {{session()->exists('data') && session()->get('data')['city'] == 11 ? 'selected' : ''}}>نابلس</option>
                                                                    <option value="12" {{session()->exists('data') && session()->get('data')['city'] == 12 ? 'selected' : ''}}>غزه</option>
                                                                </optgroup>
                                                            </select>
                                                            @if(!empty(session()->get('errors')['city']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="class col-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">كلمة المرور (*)</label>
                                                            <input type="password" id="password"
                                                                   class="form-control"
                                                                   name="password" value="{{session()->exists('data') ? session()->get('data')['password'] : ''}}">

                                                            @if(!empty(session()->get('errors')['password']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <label for="projectinput1">رابط الفيسبوك (الطالب)</label>
                                                            <input type="url"
                                                                   class="form-control" name="fb_student" value="{{session()->exists('data') ? session()->get('data')['fb_student'] : ''}}">
                                                            @if(!empty(session()->get('errors')['fb_student']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <label for="projectinput1">رابط الفيسبوك (ولى الامر)</label>
                                                            <input type="url"
                                                                   class="form-control" name="fb_parent" value="{{session()->exists('data') ? session()->get('data')['fb_parent'] : ''}}">
                                                            @if(!empty(session()->get('errors')['fb_parent']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1"
                                                                   name="active"
                                                                   class="switchery" data-color="success"
                                                                   {{session()->exists('data') && session()->get('data')['active'] == 1 ? 'checked' : (!session()->exists('data') ? 'checked' : '') }}/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">الحالة </label>

                                                            @if(!empty(session()->get('errors')['active']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> المعلومات الاكاديمية
                                                </h4>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">التخصص (*)</label>
                                                            <select name="major" class="select2 form-control">
                                                                <optgroup label="من فضلك أختر التخصص ">
                                                                    @if(count($majors) > 0)
                                                                        <option value=""></option>
                                                                        @foreach($majors as $major)
                                                                            <option value="{{$major->id}}" {{session()->exists('data') && $major->id == session()->get('data')['major'] ? 'selected' : ''}}>{{$major->major_name}}</option>
                                                                        @endforeach
                                                                    @else
                                                                        <option value="" disabled>لايوجد تخصصات</option>
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @if(!empty(session()->get('errors')['major']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">المدرسة </label>
                                                            <select name="school" class="select2 form-control">
                                                                <optgroup label="من فضلك أختر المدرسة">
                                                                    @if(count($schools) > 0)
                                                                        <option value=""></option>
                                                                        @foreach($schools as $school)
                                                                            <option value="{{$school->school_id}}" {{session()->exists('data') && $school->school_id == session()->get('data')['school'] ? 'selected' : ''}}>{{$school->school_name}}</option>
                                                                        @endforeach
                                                                    @else
                                                                        <option value="" disabled>لايوجد مدارس</option>
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @if(!empty(session()->get('errors')['school']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> المجموعات</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> أسم المجموعه </label>
                                                            <select name="group" class="select2 form-control">
                                                                <optgroup label="من فضلك أختر أسم المجموعه ">
                                                                  @if(count($groups) > 0)
                                                                        <option value=""></option>
                                                                        @foreach($groups as $groupe)
                                                                            <option value="{{$groupe->id}}" {{session()->exists('data') && $groupe->id == session()->get('data')['groupe'] ? 'selected' : ''}}>{{$groupe->name}}</option>
                                                                        @endforeach
                                                                    @else
                                                                        <option value="" disabled>لايوجد مدارس</option>
                                                                    @endif

                                                                    {{-- <option value=""></option>
                                                                    <option value="1" {{session()->exists('data') && session()->get('data')['group'] == 1 ? 'selected' : ''}}>مجموعه ادبي</option>
                                                                    <option value="2" {{session()->exists('data') && session()->get('data')['group'] == 2 ? 'selected' : ''}}>مجموعه علمي</option> --}}
                                                                </optgroup>
                                                            </select>
                                                            @if(!empty(session()->get('errors')['group']))
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @endif

                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="form-body">

                                                    <h4 class="form-section"><i class="ft-home"></i> المواد الدراسيه</h4>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="form-group col-12 mb-2 contact-repeater">
                                                                        <label for="projectinput2"> الماده الدراسية </label>
                                                                        <div data-repeater-list="subject">
                                                                            <div class="input-group mb-1"
                                                                                 data-repeater-item="subject">
                                                                                <select class="form-control" name="">
                                                                                    @if(count($subjects) > 0)
                                                                                        <option value=""></option>
                                                                                        @foreach($subjects as $subject)
                                                                                            <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                                                                        @endforeach
                                                                                    @else
                                                                                        <option value="" disabled>لايوجد مواد</option>
                                                                                    @endif
                                                                                </select>
                                                                                <input class="form-control" type="text" name="price" placeholder="سعر الماده">
                                                                                <input class="form-control" type="text" name="tax" placeholder="الضريبه">
                                                                                <input class="form-control" type="number" step=".1" name="discount" placeholder="نسبه الخصم">
                                                                                <span class="input-group-append" id="button-addon2">
                                                                                    <button class="btn btn-danger" type="button" data-repeater-delete=""><i class="ft-x"></i></button>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <button type="button" data-repeater-create=""
                                                                                class="btn btn-primary">
                                                                            <i class="ft-plus"></i> أضافة ماده
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <h4 class="form-section"><i class="ft-home"></i>الملاحظات</h4>
                                                            <div class="form-group mt-1">
                                                                <input type="checkbox" value="1"
                                                                       name="show_notes"
                                                                       class="switchery" data-color="success"
                                                                    {{session()->exists('data') && isset(session()->get('data')['show-notes']) && session()->get('data')['show-notes'] == 1 ? 'checked' : (!session()->exists('data') ? 'checked' : '') }}/>
                                                                <label for="switcheryColor4"
                                                                       class="card-title ml-1">اظهار الملاحظات</label>

                                                                @if(!empty(session()->get('errors')['show_notes']))
                                                                    <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <textarea class="form-control" placeholder="الملاحظات" name="notes"></textarea>
                                                                @if(!empty(session()->get('errors')['notes']))
                                                                    <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-actions">
                                                                <button type="button" class="btn btn-warning mr-1"
                                                                        onclick="history.back();">
                                                                    <i class="ft-x"></i> تراجع
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="la la-check-square-o"></i> حفظ
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
