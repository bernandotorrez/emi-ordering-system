<div class="row layout-top-spacing">

    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">

                @if(session()->has('action_message'))
                {!! session('action_message') !!}
                @endif

                <form id="contact" class="section contact">
                    <div class="info">
                        <h5 class="mb-4" >{{ $pageTitle }}</h5>
                        <div class="row">
                            <div class="col-md-11 mx-auto">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <select class="form-control" id="country">
                                                <option>All Countries</option>
                                                <option selected="">United States</option>
                                                <option>India</option>
                                                <option>Japan</option>
                                                <option>China</option>
                                                <option>Brazil</option>
                                                <option>Norway</option>
                                                <option>Canada</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control mb-4" id="address"
                                                placeholder="Address" value="New York">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="location">Location</label>
                                            <input type="text" class="form-control mb-4" id="location"
                                                placeholder="Location">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control mb-4" id="phone"
                                                placeholder="Write your phone number here" value="+1 (530) 555-12121">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control mb-4" id="email"
                                                placeholder="Write your email here" value="Jimmy@gmail.com">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="website1">Website</label>
                                            <input type="text" class="form-control mb-4" id="website1"
                                                placeholder="Write your website here">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    Livewire.on('triggerDelete', function () {

        Swal.fire({
            icon: 'question',
            title: 'Are You Sure?',
            text: 'this Record will be deleted!',
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                // call function deleteProcess() in Livewire Controller
                @this.deleteProcess()
            }
        });
    });
</script>
@endpush
