@extends('layouts.app')
@section('style')
@endsection
@section('content')
    @include('alert_message.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('settings.places.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Arabic name</label>
                                    @error('place_name_ar')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="text" value="{{ old('place_name_ar') }}" class="form-control" name="place_name_ar">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">English name</label>
                                    @error('place_name_en')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="text" value="{{ old('place_name_en') }}" class="form-control" name="place_name_en">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Description</label>
                                    @error('place_description')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <textarea class="form-control" name="place_description" id="" cols="30" rows="2">{{ old('place_description') }}</textarea>
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
