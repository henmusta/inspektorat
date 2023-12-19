<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="description" content="@yield('page_description', $page_description ?? '')" />
    <meta name="format-detection" content="telephone=no">

    <title>{{ config('Site.title') ? config('Site.title') : config('dz.name') ; }} | @yield('title', $page_title ?? '')</title>
    <!-- Favicon icon -->
    @if(config('Site.favicon'))
        <link rel="icon" type="image/png" href="{{ asset('storage/configuration-images/'.config('Site.favicon')) }}">
    @else
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.png') }}">
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    @php
        $action = DzHelper::controller().'_'.DzHelper::action();
    @endphp
    @if(isset($action) && !empty(config('dz.public.pagelevel.css.'.$action)))
        @foreach(config('dz.public.pagelevel.css.'.$action) as $style)
            <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach
    @endif

    {{-- Global Theme Styles (used by all pages) --}}
    @if(!empty(config('dz.public.global.css')))
        @foreach(config('dz.public.global.css') as $style)
            <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach
    @endif

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">


</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{!! url('/admin'); !!}" class="brand-logo">
                @if (!empty(config('Site.icon_logo')) && !empty(config('Site.text_logo')))
                    <img class="logo-abbr" src="{{ asset('storage/configuration-images/'.config('Site.icon_logo')) }}">
                    <img class="brand-title" src="{{ asset('storage/configuration-images/'.config('Site.text_logo')) }}">
                @else
                    <img class="logo-abbr" src="{{ asset('images/logo.png') }}">
                    <img class="brand-title" src="{{ asset('images/logo-text.png') }}">
                @endif
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->

          @include('admin.elements.header')


        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('admin.elements.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start kri
        ***********************************-->
        <div class="content-body">
            @include('admin.elements.alert_message')
            <!-- row -->
            @yield('content')
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->

		@include('admin.elements.footer')

        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Role, User Permissions Model Start
    ***********************************-->
    <div class="modal fade" id="AssignRevokePermissionsModal">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Permissions</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="AssignRevokePermissionsModalBody">
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Role, User Permissions Model End
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script>
		'use strict';
        var baseUrl = "{!! url('/') !!}";
        var enableCkeditor = '{!! config('Writing.editable') !!}';
    </script>
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
     <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    @stack('inline-scripts')

    @if(!empty(config('dz.public.global.js.top')))
        @foreach(config('dz.public.global.js.top') as $script)
                <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
    @endif
    @if(!empty(config('dz.public.pagelevel.js.'.$action)))
        @foreach(config('dz.public.pagelevel.js.'.$action) as $script)
                <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
    @endif
    @if(!empty(config('dz.public.global.js.bottom')))
        @foreach(config('dz.public.global.js.bottom') as $script)
                <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('scripts')

</body>
</html>
