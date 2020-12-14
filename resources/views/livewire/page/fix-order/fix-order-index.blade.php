<div class="row layout-top-spacing">

    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">

                @if(session()->has('action_message'))
                {!! session('action_message') !!}
                @endif

                <h6>Fix Order</h6>

                <div class="widget-content widget-content-area animated-underline-content">

                    <ul class="nav nav-tabs  mb-3" id="animateLine" role="tablist">
                        @foreach($dataMasterMonth as $key => $masterMonth)
                        <li class="nav-item">
                            <a class="nav-link {{(date('m')-1 == $key) ? 'active' : ''}}" id="animated-underline-home-tab" data-toggle="tab"
                                href="#animated-underline-home" role="tab" aria-controls="animated-underline-home"
                                aria-selected="{{(date('m')-1 == $key) ? 'true' : 'false'}}">
                                <i class="far fa-calendar-alt"></i> 
                                {{$masterMonth->month}}
                                <!-- {{Str::substr($masterMonth->month, 0, 3)}} -->
                            </a>
                        </li>
                        @endforeach
                    </ul>

                    <button class="btn btn-primary mr-2" id="addButton"
                        wire:click.prevent="goTo('{{route('fix-order.add')}}')">Add</button>


                </div>


            </div>
        </div>
    </div>

</div>