@extends('layouts.index')

@section('content')
<script src="{{ asset('lte') }}/plugins/jquery/jquery.min.js"></script>
<div class="card" style="margin-bottom: 25px;">
    <div class="card-header bg-info text-white" style="cursor: pointer;">
        <h4>
            <strong>Update User #{{ $user->name }}</strong>
        </h4>
    </div>
    <div class="card-body">
        <form action="{{ route('users.update', $user->id) }}" method="post" id="crud-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="name"><strong>Name: {!! required() !!}</strong></label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                </div>
                <div class="col-md-3">
                    <label for="email"><strong>Email: {!! required() !!}</strong></label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                </div>
                <div class="col-md-2">
                    <label for="username"><strong>Username: {!! required() !!}</strong></label>
                    <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}">
                </div>
                <div class="col-md-2">
                    <label for="gender"><strong>Gender: {!! required() !!}</strong></label>
                    <select name="gender" class="form-control select2bs4" id="gender">
                        @foreach (genders() as $key => $gender)
                        <option value="{{ $key }}" {{ $user->gender == $key ? 'selected' : '' }}>{{ $gender }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="image_file"><strong>Image:</strong></label>
                    <input type="file" name="image_file" id="image_file" class="form-control">
                </div>
            </div>
            <div class="form-group row mb-5">
                <div class="col-md-4">
                    <label for="roles"><strong>Choose Roles :</strong></label>
                    <select name="roles[]" class="form-control select2bs4" id="roles" multiple>
                      @if(isset($roles[0]))
                      @foreach ($roles as $key => $role)
                        <option value="{{$role->id}}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{$role->name}}</option>
                      @endforeach
                      @endif
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="type"><strong>Choose Type: {!! required() !!}</strong></label>
                    <select name="type" id="type" class="form-control select2bs4" onchange="getUserType()">
                        <option value="admin" {{ $user->type == 'admin' ? 'selected' : ''}}>Admin</option>
                        <option value="employee" {{ $user->type == 'employee' ? 'selected' : ''}}>Employee</option>
                        <option value="supplier" {{ $user->type == 'supplier' ? 'selected' : ''}}>Supplier</option>
                        <option value="customer" {{ $user->type == 'customer' ? 'selected' : ''}}>Customer</option>
                    </select>
                </div>
                <div class="col-md-2 divs employee-div">
                    <label for="employee_id"><strong>Choose Employee: {!! required() !!}</strong></label>
                    <select name="employee_id" id="employee_id" class="form-control select2bs4">
                        <option value="{{ null }}">Choose an Employee</option>
                        @if(isset($employees[0]))
                        @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $user->employee_id == $employee->id ? 'selected' : ''}}>{{ $employee->first_name.' '.$employee->middle_name.' '.$employee->last_name }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-2 divs supplier-div">
                    <label for="supplier_id"><strong>Choose Supplier: {!! required() !!}</strong></label>
                    <select name="supplier_id" id="supplier_id" class="form-control select2bs4">
                        <option value="{{ null }}">Choose a Supplier</option>
                        @if(isset($suppliers[0]))
                        @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ $user->supplier_id == $supplier->id ? 'selected' : ''}}>{{ $supplier->name }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-2 divs customer-div">
                    <label for="customer_id"><strong>Choose Customer: {!! required() !!}</strong></label>
                    <select name="customer_id" id="customer_id" class="form-control select2bs4">
                        <option value="{{ null }}">Choose a Customer</option>
                        @if(isset($customers[0]))
                        @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $user->customer_id == $customer->id ? 'selected' : ''}}>{{ $customer->name }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="password"><strong>New Password (If Any) :</strong></label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="col-md-2">
                    <label for="password_confirmation"><strong>Confirm New Password :</strong></label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>
            </div>

            <div class="form-group row mt-3">
                @php
                    $c = 0;
                @endphp
                @if(isset($modules[0]))
                @foreach($modules as $key => $module)
                    @foreach($permissions->where('module', $module)->chunk(10) as $key => $chunk)
                    @php
                        $c++;
                    @endphp
                        <div class="col-md-2 mb-3">
                            <h4 class="mb-0">
                                <div class="icheck-info d-inline">
                                    <input type="checkbox" id="chunk-{{ $c }}" class="chunk" data-key="{{ $c }}" {{ ($chunk->count() == $chunk->whereIn('id', $user->permissions->pluck('id')->toArray())->count()) ? 'checked' : '' }}>
                                    <label for="chunk-{{ $c }}" class="text-info">
                                      {{ $module }}
                                    </label>
                                </div>
                            </h4>
                            <hr class="mt-1 pt-0">
                            @foreach($chunk as $key => $permission)
                                <p class="mb-0">
                                    <div class="icheck-dark d-inline">
                                        <input type="checkbox" id="permission-{{ $permission->id }}" class="permission-{{ $c }}" name="permissions[]" value="{{ $permission->id }}" {{ in_array($permission->id, $user->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                                        <label for="permission-{{ $permission->id }}" class="text-dark">
                                          {{ $permission->name }}
                                        </label>
                                    </div>
                                </p>
                            @endforeach
                        </div>
                    @endforeach
                @endforeach
                @endif
            </div>
            <button type="submit" class="btn btn-primary crud-button"><i class="fa fa-save"></i>&nbsp; Update User</button>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $.each($('.chunk'), function(index, val) {
            var ch = $(this);
            ch.click(function(event) {
                $('.permission-'+ch.attr('data-key')).prop('checked', ch.is(':checked'));
            });
        });
    });

    getUserType();
    function getUserType(){
        $('.divs').hide();
        $('.'+($('#type').find(':selected').val())+'-div').show();
    }
</script>
@include('layouts.crudFormJs')
@endsection