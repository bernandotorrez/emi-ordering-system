<div class="row layout-top-spacing">

    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">

                @if(session()->has('action_message'))
                    {!! session('action_message') !!}
                @endif

                <button type="button" 
                class="btn btn-primary mr-4" 
                id="addButton"
                wire:click.prevent="addForm"> Add
                </button>

                <button type="button" 
                class="btn btn-success mr-4" 
                id="editButton"
                wire:click.prevent="editForm"
                @if(count($checked) != 1) disabled @endif
                > Edit
                </button>

                <button type="button" 
                class="btn btn-danger" 
                id="deleteButton"
                wire:click.prevent="$emit('triggerDelete')"
                @if(count($checked) <= 0 ) disabled @endif
                > Delete
                </button>

                <!-- @dump($checked) -->

                <!-- Modal -->
                <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ $pageTitle }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form>
                                    @if(session()->has('message_duplicate'))
                                     {!! session('message_duplicate') !!}
                                    @endif

                                    <div class="row mb-4">
                                        <div class="col">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" maxlength="100"
                                                placeholder="Username" wire:model.lazy="bind.username">
                                            @error('bind.username') <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" maxlength="100" autocomplete="off"
                                                placeholder="Example : tes@gmail.com" wire:model.lazy="bind.email">
                                            @error('bind.email') <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col">
                                            <label for="nama_user">Nama User</label>
                                            <input type="text" class="form-control" id="nama_user" maxlength="100"
                                                placeholder="Nama User" wire:model.lazy="bind.nama_user">
                                            @error('bind.nama_user') <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label for="status_atpm">Status ATPM</label>
                                            <select class="form-control" id="status_atpm"
                                                placeholder="Status ATPM" wire:model.lazy="bind.status_atpm">
                                                <option value="">- Choose Status ATPM -</option>
                                                <option value="atpm">ATPM</option>
                                                <option value="dealer">Dealer</option>
                                            </select>
                                            @error('bind.status_atpm') <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>   
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col">
                                            <label for="level_access">Level Access</label>
                                            <select class="form-control" id="level_access"
                                                placeholder="Level Access" wire:model.lazy="bind.level_access">
                                                <option value="">- Choose Level Access -</option>
                                                <option value="1">Admin</option>
                                                <option value="4">User</option>
                                            </select>
                                            @error('bind.level_access') <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label for="id_user_group">User Group</label>
                                            <select class="form-control" id="id_user_group"
                                                wire:model.lazy="bind.id_user_group">
                                                <option value="">- Choose User Group -</option>
                                                @foreach($dataUserGroup as $data)
                                                    <option value="{{ $data->id_user_group }}">{{ $data->nama_group }}</option>
                                                @endforeach
                                            </select>
                                            @error('bind.id_user_group') <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                    Discard</button>
                                @if($isEdit)
                                <button type="button" class="btn btn-success" id="update"
                                    wire:click.prevent="editProcess" wire:offline.attr="disabled"> Update </button>
                                @else
                                <button type="button" class="btn btn-primary" id="submit"
                                    wire:click.prevent="addProcess" 
                                    wire:offline.attr="disabled"
                                    @error('bind.*') disabled @enderror> Submit </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->

                <p></p>

                <div class="table-responsive mt-4">
                    <div class="d-flex">
                        <div class="p-2 align-content-center align-items-center" class="text-center">Per Page : </div>
                        <div class="p-2">
                            <select class="form-control" wire:model.lazy="perPageSelected">
                                @foreach($perPage as $page)
                                <option value="{{ $page }}">{{ $page }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="ml-auto p-2 text-center alert alert-info" wire:loading
                            wire:target="car_model_paginate">Loading ... </div>
                        <div class="ml-auto p-2">
                            <input type="text" class="form-control" wire:model="search" placeholder="Search...">
                        </div>
                    </div>
                    <table class="table table-striped table-bordered" id="users-table">
                        <thead>
                            <th width="5%">
                                <input type="checkbox"
                                class="new-control-input"
                                wire:model="allChecked"
                                wire:click="allChecked">
                            </th>
                            <th width="10%">No</th>
                            <th wire:click="sortBy('username')">
                                <a href="javascript:void(0);">Username
                                    @include('livewire.datatable-icon', ['field' => 'username'])
                                </a>
                            </th>
                            <th wire:click="sortBy('nama_user')">
                                <a href="javascript:void(0);">Nama User
                                    @include('livewire.datatable-icon', ['field' => 'nama_user'])
                                </a>
                            </th>
                            <th wire:click="sortBy('email')">
                                <a href="javascript:void(0);">Email
                                    @include('livewire.datatable-icon', ['field' => 'email'])
                                </a>
                            </th>
                            <th wire:click="sortBy('id_user_group')">
                                <a href="javascript:void(0);">User Group
                                    @include('livewire.datatable-icon', ['field' => 'id_user_group'])
                                </a>
                            </th>
                            <th wire:click="sortBy('level_access')">
                                <a href="javascript:void(0);">Level Access
                                    @include('livewire.datatable-icon', ['field' => 'level_access'])
                                </a>
                            </th>
                            <th wire:click="sortBy('status_atpm')">
                                <a href="javascript:void(0);">Status ATPM
                                    @include('livewire.datatable-icon', ['field' => 'status_atpm'])
                                </a>
                            </th>
                        </thead>
                        <tbody>
                            @foreach($dataUser as $data)
                            <tr>
                                <td>
                                    <input type="checkbox" 
                                    value="{{ $data->id_user }}" 
                                    class="new-control-input"
                                    wire:model="checked">
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->username }}</td>
                                <td>{{ $data->nama_user }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->userGroup->nama_group }}</td>
                                <td>{{ $data->level_access }}</td>
                                <td>{{ $data->status_atpm }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $dataUser->links('livewire.pagination-links') }}
                    </div>

                </div>

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
