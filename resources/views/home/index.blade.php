@extends('_layouts.application')

@section('content')

    <br><br>
    <div class="row-fluid hideInIE8 circleStats">

        <div class="span2" onTablet="span4" onDesktop="span2">
            <div class="circleStatsItemBox red">
                <div class="header">Eigene Nodes</div>
                <span class="percent">Prozent online</span>
                <div class="circleStat">
                    <input type="text" value="{{$onlineprocent}}" class="whiteCircle" />
                </div>
                <div class="footer">
                                <span class="count">
                                    <span class="number"></span>
                                    <span class="unit">Nodes</span>
                                </span>
                    <span class="sep"> / </span>
                                <span class="value">
                                    <span class="number">{{$mynodes}}</span>
                                    <span class="unit">Nodes</span>
                                </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <a class="quick-button metro red span2">
            <i class="icon-group"></i>
            <p>Clients auf eigenen Nodes</p>
            <span class="badge">{{$myclients}}</span>
        </a>
    </div>

@endsection
