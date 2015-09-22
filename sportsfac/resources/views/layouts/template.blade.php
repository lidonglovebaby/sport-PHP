@include('layouts.global.header')


        @include('layouts.global.headernav')

        <!-- Page Canvas-->
        <div id="page-canvas">
            
             @include('layouts.global.offcanvasnav')

            <!--Page Content-->
            <div id="page-content">
               @yield('content')
              

            </div>
            <!-- end Page Content-->
        </div>
        <!-- end Page Canvas-->


@include('layouts.global.footer')