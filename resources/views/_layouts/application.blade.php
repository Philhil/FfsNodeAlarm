@extends('_layouts.base')

@section('body')
    <body>
    @include('_layouts/header')

    <div class="container-fluid-full">
        <div class="row-fluid">

            @include('_layouts/menu')

            <noscript>
                <div class="alert alert-block span10">
                    <h4 class="alert-heading">Warning!</h4>
                    <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
                </div>
            </noscript>

            <!-- start: Content -->
            <div id="content" class="span10">
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="/">Home</a>
                        <i class="icon-angle-right"></i>
                    </li>
                    <li><a href="#">{{ucfirst(Route::getCurrentRequest()->route()->getPath())}}</a></li>
                </ul>

                @yield('content')
            </div><!--/#content.span10-->
        </div><!--/#content.span10-->
    </div><!--/.fluid-container-->

    <div class="clearfix"></div>

    <footer>
        <p>
            <span style="text-align:left;float:left">&copy; 2015 FFS Nodes Monitor by <a href="https://github.com/Philhil/FfsNodeMonitor" alt="FfsNodesMonitor"> Flip </a></span>
            <span style="text-align:left;float:left"> &nbsp;&nbsp; &copy; 2013 Design by: <a href="http://themifycloud.com/downloads/janux-free-responsive-admin-dashboard-template/" alt="Bootstrap_Metro_Dashboard">JANUX Responsive Dashboard</a></span>
        </p>

    </footer>

    </body>
@endsection