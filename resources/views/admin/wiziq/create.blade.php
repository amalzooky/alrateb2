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
                                <li class="breadcrumb-item"><a href=""> الحصص </a>
                                </li>
                                <li class="breadcrumb-item active">إنشاء حصه
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
                                    <h4 class="card-title" id="basic-layout-form"> إنشاء حصة </h4>
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
                                        <form class="form" action="{{route('admin.virtualclass.wiziq.store')}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf


                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> إنشاء wiziq </h4>

                                                <div class="row">

                                                    <div class="col-md-12">

                                                        <div class="form-group">
                                                            <label for="projectinput1"> أسم الحصة
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  أسم الحصة"
                                                                   name="title" required>
                                                            @error("")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">

                                                        <div class="form-group">
                                                            <label for="projectinput1">المواد
                                                            </label>
                                                            <select name="subject_id" class="form-control" required>
                                                                <option value="">اختر الماده</option>

                                                                @if(!empty($subjects) && count($subjects) > 0)
                                                                    @foreach($subjects as $subj)
                                                                        <option
                                                                            value="{{$subj->id}}">{{$subj->subject_name}}</option>

                                                                    @endforeach
                                                                @else
                                                                    <option value="" disabled>ليس هناك مواد</option>
                                                                @endif
                                                            </select>
                                                            @error("")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">المحاضرات
                                                            </label>
                                                            <select name="lecture_id" class="form-control" required>
                                                                <option value="">اختر المحاضره</option>
                                                                @if(!empty($lectures) && count($lectures) > 0)
                                                                    @foreach($lectures as $lecture)

                                                                        <option
                                                                            value="{{$lecture->id}}">{{$lecture->lecture_name}}</option>

                                                                    @endforeach
                                                                @else
                                                                    <option value="" disabled>ليس هناك المحاضرات
                                                                    </option>
                                                                @endif
                                                            </select>
                                                            @error("")

                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">

                                                        <div class="form-group">
                                                            <label for="projectinput1"> وقت بدء الحصة </label>
                                                            <input class="form-control" type="datetime-local"
                                                                   id="meeting-time" name="start_time" required>

                                                            {{-- <input class="form-control input-small" id="" name="start_time" type="datetime" value="2018-03-17 00:00:00"> --}}



                                                            @error("")

                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">

                                                        <div class="form-group">
                                                            <label for="projectinput1">عدد الحضور</label>
                                                            <input class="form-control" type="number"
                                                                   id="meeting-time" name="attendee_limit"
                                                                   value="10">
                                                            @error("")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1"
                                                                   name="create_recording"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   checked/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">تسجيل الحصه</label>

                                                            @error("")
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
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
