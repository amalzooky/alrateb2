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
                                <li class="breadcrumb-item"><a href=""> الاقسام الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item active"> تعديل - {{$major[0] -> major_name}}
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
                                    <h4 class="card-title" id="basic-layout-form"> تعديل قسم رئيسي </h4>
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
                                        <form class="form" action="{{route('admin.majors.update', $major[0]->id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            @if(!empty($major[0]->major_image))
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">صوره التخصص الحاليه</label>
                                                            <img src="{{'/' . $major[0]->major_image}}" class="img-fluid" alt="صوره التخصص الحاليه">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات التخصص </h4>

                                                @if(get_languages() -> count() > 0)
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> صوره التخصص الجديده</label>
                                                                <input type="file" value="" id="name"
                                                                       class="form-control"
                                                                       placeholder="  "
                                                                       name="major[0][image]">
                                                                @if(!empty(session()->get('errors')['major.0.image']))
                                                                    <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @foreach(get_languages() as $index => $lang)
                                                        @foreach($major as $item)
                                                            @if($item->translation_lang === $lang->abbr)
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="projectinput1"> اسم التخصص
                                                                                - {{__('messages.'.$lang -> abbr)}} </label>
                                                                            <input type="text" value="{{$item->major_name}}" id="name"
                                                                                   class="form-control"
                                                                                   placeholder="  "
                                                                                   name="major[{{$index}}][name]">
                                                                            @if(!empty(session()->get('errors')['major.' . $index . '.name']))
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
                                                                           name="major[{{$index}}][abbr]">
                                                                    @if(!empty(session()->get('errors')['major.' . $index . '.abbr']))
                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group mt-1">
                                                                <input type="checkbox" value="1"
                                                                       name="major[0][active]"
                                                                       id="switcheryColor4"
                                                                       @if($major[0]->active === 1)
                                                                           class="switchery" data-color="success"
                                                                           checked
                                                                        @else
                                                                            class="switchery" data-color="error"
                                                                        @endif
                                                                        />
                                                                <label for="switcheryColor4"
                                                                       class="card-title ml-1">الحالة</label>
                                                                @if(!empty(session()->get('errors')['major.0.active']))
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
