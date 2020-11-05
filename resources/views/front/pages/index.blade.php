@include('front.layouts.head')
@include('front.layouts.header')




    <!-- Main content -->
     <section class="content">
     	@yield ('content')
    </section>
    <!-- /.content -->
  


    @include('front.layouts.footer')
{{-- @include('front.layouts.modal') --}}

@include('front.layouts.script')