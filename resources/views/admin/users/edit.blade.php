@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form class="col-md-12" action="{{ route('users.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $data->id }}" name="id">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mt-2">
                                                <label for="">Name</label>
                                                <input type="text" value="{{ $data->name }}" name="name" class="form-control" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group mt-2">
                                                <label for="">Email</label>
                                                <input type="email" value="{{ $data->email }}" name="email" class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mt-2">
                                                <label for="">Password</label>
                                                <input type="password" name="password" class="form-control" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mt-2">
                                                <label for="">Phone 1</label>
                                                <input type="text" value="{{ $data->user_phone1 }}" name="user_phone1" class="form-control" placeholder="Phone 1">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mt-2">
                                                <label for="">Phone 2</label>
                                                <input type="text" value="{{ $data->user_phone2 }}" name="user_phone2" class="form-control" placeholder="Phone 2">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mt-2">
                                                <label for="">Role</label>
                                                <select class="form-control" name="user_role" id="">
                                                    <option value="">Select role ...</option>
                                                    <option @if($data->user_role == 1) selected @endif value="1">Admin</option>
                                                    <option @if($data->user_role == 2) selected @endif value="2">Recruiting money</option>
                                                    <option @if($data->user_role == 3) selected @endif value="3">Employee</option>
                                                    <option @if($data->user_role == 4) selected @endif value="4">Media officer</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mt-2">
                                                <label for="">Address</label>
                                                <textarea class="form-control" name="user_address" id="" cols="30" rows="2" placeholder="Address">{{ $data->user_address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mt-2">
                                                <label for="">Notes</label>
                                                <textarea class="form-control" name="user_notes" id="" cols="30" rows="2" placeholder="Notes">{{ $data->user_notes }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="form-group">
                                                <label for="">Image</label>
                                                <br>
                                                @if($data->user_photo == 'avatar.png')
                                                    <img style="width: 200px" src="{{ asset('img/avatar.png') }}" alt="">
                                                @else
                                                    <img style="width: 200px" src="{{ asset('storage/users/'.$data->user_photo) }}" alt="">
                                                @endif
                                                <input type="file" name="image" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary mt-2" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

