
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
                    <div class="modal-dialog" role="document">
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

                                    <div class="form-group mb-4">
                                        <label for="id_user_group">User Group</label>
                                        <select type="text" class="form-control" id="id_user_group" 
                                        wire:model.lazy="bind.id_user_group">
                                            <option value="">- Choose User Group -</option>

                                            @foreach($dataUserGroup as $userGroup)
                                            <option value="{{$userGroup->id_user_group}}">
                                            {{$userGroup->nama_group}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('bind.id_user_group') <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="id_parent_menu">Parent Menu</label>
                                        <select class="form-control" id="id_parent_menu" name="id_parent_menu"
                                        wire:model.lazy="bind.id_parent_menu">
                                            <option value="">- Choose Parent Menu -</option>

                                            @foreach($dataParentMenu as $parentMenu)
                                                <option value="{{ $parentMenu->id_parent_menu }}">
                                                    {{ $parentMenu->nama_parent_menu }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('bind.id_parent_menu') <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="id_child_menu">Child Menu</label>
                                        <select class="form-control" id="id_child_menu" name="id_child_menu"
                                        wire:model.lazy="bind.id_child_menu">
                                            <option value="">- Choose Child Menu -</option>

                                            @foreach($dataChildMenu as $childMenu)
                                                <option value="{{ $childMenu->id_child_menu }}">
                                                    {{ $childMenu->nama_child_menu }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('bind.id_child_menu') <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="sub_child_position">Sub Child Position</label>
                                        <input type="text" class="form-control" id="child_position" maxlength="10"
                                            placeholder="Example : 1" wire:model.lazy="bind.sub_child_position">
                                        @error('bind.sub_child_position') <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="nama_sub_child_menu">Nama Sub Child Menu</label>
                                        <input type="text" class="form-control" id="nama_sub_child_menu" maxlength="100"
                                            placeholder="Example : Sales Order" wire:model.lazy="bind.nama_sub_child_menu">
                                        @error('bind.nama_sub_child_menu') <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="url">URL</label>
                                        <input type="text" class="form-control" id="url" maxlength="250"
                                            placeholder="Example : /admin/parent-menu" wire:model.lazy="bind.url">
                                        @error('bind.url') <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="icon">Icon</label>
                                        <input type="text" class="form-control" id="icon" maxlength="250"
                                            placeholder="Example : fa fa-example" wire:model.lazy="bind.icon">
                                        @error('bind.icon') <span class="error">{{ $message }}</span>
                                        @enderror
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
                            <th wire:click="sortBy('nama_group')">
                                <a href="javascript:void(0);">User Group
                                    @include('livewire.datatable-icon', ['field' => 'nama_group'])
                                </a>
                            </th>
                            <th wire:click="sortBy('nama_parent_menu')">
                                <a href="javascript:void(0);">Parent Menu
                                    @include('livewire.datatable-icon', ['field' => 'nama_parent_menu'])
                                </a>
                            </th>
                            <th wire:click="sortBy('nama_child_menu')">
                                <a href="javascript:void(0);">Child Menu
                                    @include('livewire.datatable-icon', ['field' => 'nama_child_menu'])
                                </a>
                            </th>
                            <th wire:click="sortBy('sub_child_position')">
                                <a href="javascript:void(0);">Sub Child Position
                                    @include('livewire.datatable-icon', ['field' => 'sub_child_position'])
                                </a>
                            </th>
                            <th wire:click="sortBy('nama_sub_child_menu')">
                                <a href="javascript:void(0);">Nama Sub Child Menu
                                    @include('livewire.datatable-icon', ['field' => 'nama_sub_child_menu'])
                                </a>
                            </th>
                            <th wire:click="sortBy('url')">
                                <a href="javascript:void(0);">URL
                                    @include('livewire.datatable-icon', ['field' => 'url'])
                                </a>
                            </th>
                            <th wire:click="sortBy('icon')">
                                <a href="javascript:void(0);">Icon
                                    @include('livewire.datatable-icon', ['field' => 'icon'])
                                </a>
                            </th>
                        </thead>
                        <tbody>
                            @foreach($dataSubChildMenu as $data)
                            <tr>
                                <td>
                                    <input type="checkbox" 
                                    value="{{ $data->id_sub_child_menu }}" 
                                    class="new-control-input"
                                    wire:model="checked">
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama_group }}</td>
                                <td>{{ $data->nama_parent_menu }}</td>
                                <td>{{ $data->nama_child_menu }}</td>
                                <td>{{ $data->sub_child_position }}</td>
                                <td>{{ $data->nama_sub_child_menu  }}</td>
                                <td>{{ $data->url  }}</td>
                                <td>{{ $data->icon  }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $dataSubChildMenu->links('livewire.pagination-links') }}
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
