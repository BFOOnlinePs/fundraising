@extends('layouts.app')
@section('style')
@endsection
@section('content')
    @include('alert_message.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('settings.cites.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Arabic name</label>
                                    @error('city_name_ar')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="text" value="{{ old('city_name_ar',$data->city_name_ar) }}" class="form-control" name="city_name_ar">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">English name</label>
                                    @error('city_name_en')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="text" value="{{ old('city_name_en',$data->city_name_en) }}" class="form-control" name="city_name_en">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Description</label>
                                    @error('city_description')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <textarea class="form-control" name="city_description" id="" cols="30" rows="2">{{ old('city_description',$data->city_description) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
