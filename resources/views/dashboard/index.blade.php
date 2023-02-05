<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row mb-4">
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">router</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Your nodes</p>
                                <h4 class="mb-0">{{$mynodes}}</h4>
                                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">{{$onlineprocent}}%</span>
                                    of your nodes are online</p>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0">there are <span class="text-success text-sm font-weight-bolder">{{$myclients}} </span>
                                clients on your nodes</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">cloud_sync</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0">FfsNodealarm-Data are updated the last time at</p>
                                <h4 class="mb-0">{{$lastNodestatUpdate}}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0">every <span class="text-success text-sm font-weight-bolder">5</span> minutes node information are updated</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">lan</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Nodes</p>
                                <h4 class="mb-0">{{\App\Models\Node::count()}}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0">
                                <span class="text-danger text-sm font-weight-bolder">{{\App\Models\Task::all()->groupBy('node_id')->count()}}</span>
                                are monitored </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-lg-12 col-md-12">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <h6>Your Alarms</h6>
                            <p class="text-sm">
                                in total there where <span class="font-weight-bold">{{count($alertsLast30Days)}}</span> @if(count($alertsLast30Days)==1)alarm @else alarms @endif within last 30 days
                            </p>
                        </div>
                        <div class="card-body p-3">
                            <div class="timeline timeline-one-side">
                                @forelse($tasksWithAltertsLast30Days as $task)
                                    <div class="timeline-block mb-3">
                                    <span class="timeline-step">
                                        <i class="material-icons text-success text-gradient">notifications</i>
                                    </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">{{$task->node->name}}
                                            </h6>
                                            @if(isset($task->alertsLast30Days))
                                            @foreach($task->alertsLast30Days as $alert)
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"> {{ $alert->created_at->toDateTimeString()}}
                                            </p>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="timeline-block">
                                    <span class="timeline-step">
                                        <i class="material-icons text-dark text-gradient">check</i>
                                    </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">No Alarms</h6>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    </div>
    @push('js')
    <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
    @endpush
</x-layout>
