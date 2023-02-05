<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="tasks"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Monitoring tasks"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-warning shadow-warning border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">Create a monitoring task</h6>
                                </div>
                            </div>

                            <div class="card-body p-3">
                                @if (session('status'))
                                    <div class="row">
                                        <div class="alert alert-success alert-dismissible text-white" role="alert">
                                            <span class="text-sm">{{ Session::get('status') }}</span>
                                            <button type="button" class="btn-close text-lg py-3 opacity-10"
                                                    data-bs-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                <form method='POST' action='{{ route('tasks.store') }}'>
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Node</label>
                                            <select class="form-control border border-2 p-2" name="node_id" id="node_id">
                                                <option>Select your Node</option>
                                                @if (count($nodes) > 0)
                                                    @foreach ($nodes as $node)
                                                        <option value="{{$node->id}}">{{$node->name}} [{{$node->mac}}]</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('node_id')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">The intervall withing this node get checked (HH:mm)</label>
                                            <input type="time" id="intervall" name="intervall" value="00:10" class="form-control border border-2 p-2" required="required">
                                            @error('intervall')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                        </div>

                                        <!--
                                        <div class="mb-3 col-md-6">
                                            <p class="badge badge-pill bg-gradient-secondary text-xxs">SMS not implemented</p>
                                            <input class="form-check-input border border-2 p-2" type="checkbox" value="" name="smsalarm" id="smsalarm">
                                            <label class="" for="smsalarm">Write a sms when this task executes a alarm</label>
                                            @error('smsalarm')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                        </div>
                                        -->
                                    </div>
                                    <button type="submit" class="btn bg-gradient-dark">Submit</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-warning shadow-warning border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">Your Monitoring Tasks</h6>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="hidden" style="display:none;">id</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Node</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Intervall</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Status</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    last execution</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if (count($tasks) > 0)
                                            @foreach ($tasks as $task)
                                                <tr>
                                                    <td class="hidden" style="display:none;">{{$task->node->mac}}</td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{$task->node->name}} [{{$task->node->mac}}]</p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$task->intervall)->format('H:i')}}</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        @if (isset($task->nodestat) && $task->nodestat->isonline == true)
                                                            <span class="badge badge-sm bg-gradient-success">Online</span>
                                                        @else
                                                            <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                                        @endif
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        @if ($task->lastrun != null)
                                                            <span class="text-secondary text-xs font-weight-bold">
                                                             </span>
                                                            <p class="text-xs font-weight-bold mb-0">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$task->lastrun)->diffForHumans(\Carbon\Carbon::Now())}}</p>
                                                            <p class="text-xs text-secondary mb-0">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$task->lastrun)->toDateTimeString()}}</p>
                                                        @endif
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="{{route('tasks.delete', $task->id)}}">
                                                            <span class="badge badge-sm bg-gradient-danger"><i class="fas fa-trash"></i></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-footers.auth></x-footers.auth>
            </div>
        </main>

</x-layout>
