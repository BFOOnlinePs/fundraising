@extends('layouts.app')
@section('style')
@endsection
@section('content')
    @include('alert_message.success')
    @include('alert_message.fail')
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('activity.create') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Activity name arabic</label>
                                    @error('activity_name_ar')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="text" name="activity_name_ar" value="{{ old('activity_name_ar') }}" class="form-control" placeholder="Activity Name Arabic">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Activity name english</label>
                                    @error('activity_name_en')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="text" class="form-control" name="activity_name_en" value="{{ old('activity_name_en') }}" placeholder="Activity Name English">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Activity description arabic</label>
                                    @error('activity_description_ar')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <textarea name="activity_description_ar" id="" class="form-control" placeholder="Activity Description Arabic" cols="30" rows="2">{{ old('activity_description_ar') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Activity description english</label>
                                    @error('activity_description_en')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <textarea name="activity_description_en" id="" class="form-control" placeholder="Activity Description English" cols="30" rows="2">{{ old('activity_description_en') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
