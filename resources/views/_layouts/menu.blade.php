        <!-- start: Main Menu -->
<div id="sidebar-left" class="span2">
    <div class="nav-collapse sidebar-nav">
        <ul class="nav nav-tabs nav-stacked main-menu">
            <li class="{{ Route::currentRouteUses('DSX4\Http\Controller\DashboardController@index') ? 'active' : 'xxx'}}"><a href="{{action('DashboardController@index')}}"><i class="icon-bar-chart"></i> <span class="hidden-tablet"> Dashboard</span></a></li>
            <li class="{{ Route::currentRouteUses('DSX4\Http\Controllers\TasksController@index') ? 'active' : 'xxx'}}"><a href="{{action('TasksController@index')}}"><i class="icon-eye-open"></i> <span class="hidden-tablet"> Tasks</span></a></li>
            <li class="{{ Route::currentRouteUses('DSX4\Http\Controllers\AlertController@index') ? 'active' : 'xxx'}}"><a href="{{action('AlertController@index')}}"><i class="icon-envelope"></i> <span class="hidden-tablet"> Alarm</span></a></li>
        </ul>
    </div>
</div>
<!-- end: Main Menu -->