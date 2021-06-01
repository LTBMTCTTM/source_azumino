
<div class="row pagination-page">
    <div class="col-md-6 col-sm-12">
        <div class="dataTables_paginate paging_simple_numbers">
            <ul class="pagination justify-content-start">
                <li class="page-item {{ $page==1?"disabled":'' }}">
                    <a class="page-link" href="#" aria-label="First" page="{{ 1 }}" onclick="{!! $event !!}">
                        <span aria-hidden="true">＜＜</span>
                    </a>
                </li>
                <li class="page-item {{ $page==$prev?"disabled":'' }}">
                    <a class="page-link" href="#" aria-label="Previous" page="{{ $prev }}" onclick="{!! $event !!}">
                        <span aria-hidden="true">＜</span>
                    </a>
                </li>
                @foreach($arrBtn as $key => $btn)
                    <li class="page-item {{ $page==$btn?"active":'' }}">
                        <a class="page-link" href="#" page="{{ $btn }}" onclick="{!! $event !!}">{{ $btn }}</a>
                    </li>
                @endforeach
                <li class="page-item {{ $page==$next?"disabled":'' }}">
                    <a class="page-link" href="#" aria-label="Next" page="{{ $next }}" onclick="{!! $event !!}">
                        <span aria-hidden="true">＞</span>
                    </a>
                </li>
                <li class="page-item {{ $page==$pages?"disabled":'' }}">
                    <a class="page-link" href="#" aria-label="Last" page="{{ $pages }}" onclick="{!! $event !!}">
                        <span aria-hidden="true">＞＞</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-6  col-sm-12 text-right">
        <div class="dataTables_info font-weight-bold" role="status" aria-live="polite">{{$min}}-{{$max}}件/{{$total}}件</div>
    </div>
</div>
