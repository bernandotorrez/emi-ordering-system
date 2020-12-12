<div class="row layout-top-spacing">

    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">

                @if(session()->has('action_message'))
                {!! session('action_message') !!}
                @endif

                <button class="btn btn-primary mr-2" id="addButton" 
                    wire:click.prevent="goTo('{{route('fix-order.add')}}')" >Add</button>

                <p></p>

                
            </div>
        </div>
    </div>

</div>