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
                                <li class="breadcrumb-item"><a href=""> محتوي المواد  </a>
                                </li>
                                <li class="breadcrumb-item active"> تعديل - {{$mainmatrils -> name}}
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
                                    <h4 class="card-title" id="basic-layout-form"> تعديل  المحتوي الرئيسي </h4>
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
                                        <form class="form"
                                              action="{{route('admin.materials.update',$mainmatrils -> id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <input name="id" value="{{$mainmatrils -> id}}" type="hidden">

                                            <div class="form-group">
                                                <div class="text-center">
                                                    <a
                                                        href="{{$mainmatrils -> material}}"
                                                        class="rounded-circle  height-150" alt="محتوي المادة ">{{$mainmatrils -> name}} </a>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label> صوره القسم </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="material">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('photo')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات محتوي المادة </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم المحتوي
                                                                - {{__('messages.'.$mainmatrils -> translation_lang)}} </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$mainmatrils -> name}}"
                                                                   name="mater[0][name]">
                                                            @error("mater.0.name")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                       <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> أسم  الماده
                                                                        - {{__('messages.'.$mainmatrils -> translation_lang)}} </label>
                                                                    <select name="mater[0][name_id]" class="form-control">
                                                                        <option value="">اختر الماده</option>
                                                                        @if(!empty($subject) && count($subject) > 0)
                                                                            @foreach($subject as $subj)
                                                                                    <option value="{{$subj->id}}">{{$subj->subject_name}}</option>
                                                                               
                                                                            @endforeach
                                                                        @else
                                                                            <option value="" disabled>ليس هناك مواد</option>
                                                                        @endif
                                                                    </select>
                                                                      @error("mater.0.name_id")
                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                                   <div class="col-md-6">


                                                                  <div class="form-group">
                                                                    <label for="projectinput1"> أسم المجموعه 
                                                                        - {{__('messages.'.$mainmatrils -> translation_lang)}} </label>
                                                                    <select name="mater[0][group_id]" class="form-control">
                                                                        <option value="">اختر المجموعه</option>
                                                                        @if(!empty($groups) && count($groups) > 0)
                                                                            @foreach($groups as $group)
                                                                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                                                              
                                                                            @endforeach
                                                                        @else
                                                                            <option value="" disabled>ليس هناك مجموعات</option>
                                                                        @endif
                                                                    </select>
                                                          @error("mater.0.group_id")

                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                        @enderror                                                                     
                                                                </div>

                                                            </div>
                                                                   <div class="col-md-6">


                                                              <div class="form-group">
                                                                    <label for="projectinput1"> أسم المدرس
                                                                        - {{__('messages.'.$mainmatrils -> translation_lang)}} </label>
                                                                    <select name="mater[0][teacher_id]" class="form-control">
                                                                        <option value="">أسم المادة </option>
                                                                        @if(!empty($teachers) && count($teachers) > 0)
                                                                            @foreach($teachers as $teacher)
                                                                                    <option value="{{$teacher->id}}">{{$teacher->fullname}}</option>
                                                                            @endforeach
                                                                        @else
                                                                            <option value="" disabled>ليس هناك تخصصات</option>
                                                                        @endif
                                                                    </select>
                                                                      @error("mater.0.teacher_id")

                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                        @enderror                                                                </div>

                                                            </div>
                                                                   <div class="col-md-6">


                                                                  <div class="form-group">
                                                                    <label for="projectinput1"> تخصص الماده
                                                                        - {{__('messages.'.$mainmatrils -> translation_lang)}} </label>
                                                                    <select name="mater[0][major_id]" class="form-control">
                                                                        <option value="">اختر التخصص</option>
                                                                        @if(!empty($majors) && count($majors) > 0)
                                                                            @foreach($majors as $major)
                                                                                    <option value="{{$major->id}}">{{$major->major_name}}</option>
                                                                              
                                                                            @endforeach
                                                                        @else
                                                                            <option value="" disabled>ليس هناك تخصصات</option>
                                                                        @endif
                                                                    </select>
                                                                    @error("mater.0.major_id")

                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                        @enderror
                                                                </div>

                                                                
                                                            </div>






                                                    <div class="col-md-6 hidden">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> أختصار
                                                                اللغة {{__('messages.'.$mainmatrils -> translation_lang)}} </label>
                                                            <input type="text" id="abbr"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$mainmatrils -> translation_lang}}"
                                                                   name="mater[0][abbr]">

                                                            @error("mater.0.abbr")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1"
                                                                   name="mater[0][active]"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   @if($mainmatrils -> active == 1)checked @endif/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">الحالة {{__('messages.'.$mainmatrils -> translation_lang)}} </label>

                                                            @error("mater.0.active")
                                                            <span class="text-danger"> </span>
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
                                                    <i class="la la-check-square-o"></i> تحديث
                                                </button>
                                            </div>
                                        </form>

                                        <ul class="nav nav-tabs">
                                            @isset($mainCategory -> categories)
                                                @foreach($mainCategory -> categories   as $index =>  $translation)
                                                    <li class="nav-item">
                                                        <a class="nav-link @if($index ==  0) active @endif  " id="homeLable-tab"  data-toggle="tab"
                                                           href="#homeLable{{$index}}" aria-controls="homeLable"
                                                            aria-expanded="{{$index ==  0 ? 'true' : 'false'}}">
                                                            {{$translation -> translation_lang}}</a>
                                                    </li>
                                                @endforeach
                                            @endisset
                                        </ul>
                                        <div class="tab-content px-1 pt-1">

                                            @isset($mainCategory -> categories)
                                                @foreach($mainCategory -> categories   as $index =>  $translation)

                                                <div role="tabpanel" class="tab-pane  @if($index ==  0) active  @endif  " id="homeLable{{$index}}"
                                                 aria-labelledby="homeLable-tab"
                                                 aria-expanded="{{$index ==  0 ? 'true' : 'false'}}">

                                                <form class="form"
                                                      action="{{route('admin.maincategories.update',$translation -> id)}}"
                                                      method="POST"
                                                      enctype="multipart/form-data">
                                                    @csrf

                                                    <input name="id" value="{{$translation -> id}}" type="hidden">


                                                    <div class="form-body">

                                                        <h4 class="form-section"><i class="ft-home"></i> بيانات القسم </h4>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> اسم القسم
                                                                        - {{__('messages.'.$translation -> translation_lang)}} </label>
                                                                    <input type="text" id="name"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           value="{{$translation -> name}}"
                                                                           name="category[0][name]">
                                                                    @error("category.0.name")
                                                                    <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6 hidden">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> أختصار
                                                                        اللغة {{__('messages.'.$translation -> translation_lang)}} </label>
                                                                    <input type="text" id="abbr"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           value="{{$translation -> translation_lang}}"
                                                                           name="category[0][abbr]">

                                                                    @error("category.0.abbr")
                                                                    <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mt-1">
                                                                    <input type="checkbox" value="1"
                                                                           name="category[0][active]"
                                                                           id="switcheryColor4"
                                                                           class="switchery" data-color="success"
                                                                           @if($translation -> active == 1)checked @endif/>
                                                                    <label for="switcheryColor4"
                                                                           class="card-title ml-1">الحالة {{__('messages.'.$translation -> translation_lang)}} </label>

                                                                    @error("category.0.active")
                                                                    <span class="text-danger"> </span>
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
                                                            <i class="la la-check-square-o"></i> تحديث
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>

                                                @endforeach
                                            @endisset

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
