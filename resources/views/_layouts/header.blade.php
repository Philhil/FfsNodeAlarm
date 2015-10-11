<?php use Carbon\Carbon; ?>

<!-- start: Header -->
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="index.html"><span><i class="icon-bell"></i> NodeAlarm</span></a>

            <!-- start: Header Menu -->
            <div class="nav-no-collapse header-nav">
                <ul class="nav pull-right">
                    <li class="dropdown hidden-phone">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-bell"></i>
								<span class="badge red">{{\App\Task::where(['user_id' => \Auth::user()->id, 'active'=> 0])->count()}} </span>
                        </a>
                        <ul class="dropdown-menu notifications">
                            <li class="dropdown-menu-title">
                                <span>You have {{\App\Task::where(['user_id' => \Auth::user()->id, 'active'=> 0])->count()}} Tasks</span>
                                <a href="#"><i class="icon-repeat"></i></a>
                            </li>

                            @foreach(\App\Task::where(['user_id' => \Auth::user()->id, 'active'=> 0])->whereNotNull('lastrun')->orderBy('lastrun', 'desc')->get() as $task)
                                <li>
                                    <a href="/tasks">
                                        <span class="icon blue"><i class="halflings-icon eye-open"></i></span>
                                        <span class="message">{{\App\Node::find($task->node_id)->name}}</span>
                                        <span class="time">
                                        @if ($task->lastrun != null)
                                            {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$task->lastrun)->diffForHumans(Carbon::Now())}}
                                        @endif
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <!-- start: User Dropdown -->
                    <li class="dropdown">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="halflings-icon white user"></i> {{ Auth::user()->name}}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu-title">
                                <span>Account Settings</span>
                            </li>
                            <li><a href="/profile"><i class="halflings-icon user"></i> Profile</a></li>
                            <li><a href="/auth/logout"><i class="halflings-icon off"></i> Logout</a></li>
                        </ul>
                    </li>
                    <!-- end: User Dropdown -->
                </ul>
            </div>
            <!-- end: Header Menu -->

        </div>
    </div>
</div>
<!-- start: Header -->