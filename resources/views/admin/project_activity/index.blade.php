@extends('layouts.app')
@section('style')
@endsection
@section('content')
    @include('alert_message.success')
    @include('alert_message.fail')
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a type="button" href="{{ route('project_activity.add') }}" class="btn btn-primary waves-effect waves-light mt-1">Add project activity
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Project</th>
                                        <th>Activity</th>
                                        <th>Insert by</th>
                                        <th>Insert at</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($data->isEmpty())
                                        <tr>
                                            <td colspan="5" class="text-center">No Data</td>
                                        </tr>
                                    @else
                                        @foreach($data as $key)
                                            <tr>
                                                <td>{{ $key->project->project_name_en }}</td>
                                                <td>{{ $key->activity->activity_name_en ?? '' }}</td>
                                                <td>{{ $key->user->name }}</td>
                                                <td>{{ $key->insert_at }}</td>
                                                <td>
                                                    <a href="{{ route('project_activity.edit',['id'=>$key->id]) }}" class="btn btn-sm btn-success"><span class="fa fa-edit"></span></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
