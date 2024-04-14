@extends('layouts.app')
@section('style')
@endsection
@section('content')
    @include('alert_message.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('settings.type_of_beneficiaries.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Type name</label>
                                    @error('type_name')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="text" value="{{ old('type_name') }}" class="form-control" name="type_name">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
