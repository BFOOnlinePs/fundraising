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
                    <form action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Activity name arabic</label>
                                    <input type="text" class="form-control" placeholder="Activity Name Arabic">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Activity name english</label>
                                    <input type="text" class="form-control" placeholder="Activity Name English">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Activity description arabic</label>
                                    <textarea name="activity_descripttion_ar" id="" class="form-control" placeholder="Activity Description Arabic" cols="30" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Activity description english</label>
                                    <textarea name="activity_descripttion_en" id="" class="form-control" placeholder="Activity Description English" cols="30" rows="2"></textarea>
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
