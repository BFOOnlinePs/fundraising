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
                    <form action="{{ route('project_activity.create') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Project</label>
                                    ( <a href="{{ route('projects.add') }}">Add Project</a> )
                                    @error('project_id')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <select class="form-control" name="project_id" id="">
                                        <option value="">Select project ...</option>
                                        @foreach($projects as $key)
                                            <option @if(old('project_id')) selected @endif value="{{ $key->id }}">{{ $key->project_name_en }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Activity</label>
                                    ( <a href="{{ route('activity.add') }}">Add Activity</a> )
                                    @error('activity_id')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <select class="form-control" name="activity_id" id="">
                                        <option value="">Select activity ...</option>
                                        @foreach($activites as $key)
                                            <option @if(old('activity_id')) selected @endif value="{{ $key->id }}">{{ $key->activity_name_en }}</option>
                                        @endforeach
                                    </select>
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
