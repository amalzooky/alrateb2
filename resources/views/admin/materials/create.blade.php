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
                                <li class="breadcrumb-item"><a href=""> المواد الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item active">إضافة مادة رئيسي
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
                                    <h4 class="card-title" id="basic-layout-form"> إضافة مادة رئيسي </h4>
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
                                        <form class="form" action="{{route('admin.materials.store')}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                               <div class="form-group">
                                                <label> محتوي المادة </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="material">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('material')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                           
                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات المحتوي </h4>

                                                @if(get_languages() -> count() > 0)
                                                    @foreach(get_languages() as $index => $lang)
                                                        <div class="row">


                                                            <div class="col-md-6">
  

                                                                <div class="form-group">
                                                                    <label for="projectinput1"> أسم  المحتوي
                                                                        - {{__('messages.'.$lang -> abbr)}} </label>
                                                                      <input type="text" id="name" name="mater[{{$index}}][name]"
                                                                           class="form-control"
                                                                           placeholder="  أسم المحتوي"
                                                                                                                                               name="mater[{{$index}}][abbr]">
                                                                      @error("mater.$index.name")
                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @enderror
                                                                </div>




                                                           
                                                            </div>
                                                         <div class="col-md-6">
  

                                                                <div class="form-group">
                                                                    <label for="projectinput1"> أسم  الماده
                                                                        - {{__('messages.'.$lang -> abbr)}} </label>
                                                                    <select name="mater[{{$index}}][name_id]" class="form-control">
                                                                        <option value="">اختر الماده</option>
                                                                        @if(!empty($subject) && count($subject) > 0)
                                                                            @foreach($subject as $subj)
                                                                                @if($subj->translation_lang === $lang -> abbr)
                                                                                    <option value="{{$subj->id}}">{{$subj->subject_name}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        @else
                                                                            <option value="" disabled>ليس هناك مواد</option>
                                                                        @endif
                                                                    </select>
                                                                      @error("mater.$index.name_id")
                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @enderror
                                                                </div>




                                                           
                                                            </div>

                                                            





                                                                   <div class="col-md-6">


                                                                  <div class="form-group">
                                                                    <label for="projectinput1"> أسم المجموعه 
                                                                        - {{__('messages.'.$lang -> abbr)}} </label>
                                                                    <select name="mater[{{$index}}][group_id]" class="form-control">
                                                                        <option value="">اختر المجموعه</option>
                                                                        @if(!empty($groups) && count($groups) > 0)
                                                                            @foreach($groups as $group)
                                                                                @if($group->translation_lang === $lang -> abbr)
                                                                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        @else
                                                                            <option value="" disabled>ليس هناك مجموعات</option>
                                                                        @endif
                                                                    </select>
                                                          @error("mater.$index.group_id")

                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                        @enderror                                                                     
                                                                </div>

                                                            </div>
                                                                   <div class="col-md-6">


                                                              <div class="form-group">
                                                                    <label for="projectinput1"> أسم المدرس
                                                                        - {{__('messages.'.$lang -> abbr)}} </label>
                                                                    <select name="mater[{{$index}}][teacher_id]" class="form-control">
                                                                        <option value="">أسم المادة </option>
                                                                        @if(!empty($teachers) && count($teachers) > 0)
                                                                            @foreach($teachers as $teacher)
                                                                                    <option value="{{$teacher->id}}">{{$teacher->fullname}}</option>
                                                                            @endforeach
                                                                        @else
                                                                            <option value="" disabled>ليس هناك تخصصات</option>
                                                                        @endif
                                                                    </select>
                                                                      @error("mater.$index.teacher_id")

                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                        @enderror                                                                </div>

                                                            </div>
                                                                   <div class="col-md-6">


                                                                  <div class="form-group">
                                                                    <label for="projectinput1"> تخصص الماده
                                                                        - {{__('messages.'.$lang -> abbr)}} </label>
                                                                    <select name="mater[{{$index}}][major_id]" class="form-control">
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
                                                                    @error("mater.$index.major_id")

                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                        @enderror
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
                                                                           name="mater[{{$index}}][abbr]">

                                                                    @error("mater.$index.abbr")
                                                                    <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                        </div>

                                                        
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mt-1">
                                                                    <input type="checkbox" value="1"
                                                                           name="mater[{{$index}}][active]"
                                                                           id="switcheryColor4"
                                                                           class="switchery" data-color="success"
                                                                           checked/>
                                                                    <label for="switcheryColor4"
                                                                           class="card-title ml-1">الحالة {{__('messages.'.$lang -> abbr)}} </label>

                                                                    @error("mater.$index.active")
                                                                    <span class="text-danger"> </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
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
