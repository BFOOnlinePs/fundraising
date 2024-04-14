@extends('layouts.app')
@section('style')
@endsection
@section('content')
    @include('alert_message.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('settings.type_of_beneficiaries.add') }}" class="btn btn-primary waves-effect waves-light mt-1">Add Place
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Type name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data->isEmpty())
                                    <tr>
                                        <td colspan="2" class="text-center">No Data</td>
                                    </tr>
                                @else
                                    @foreach($data as $key)
                                        <tr>
                                            <td>{{ $key->type_name }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-success" href="{{ route('settings.type_of_beneficiaries.edit',['id'=>$key->id]) }}"><span class="fa fa-edit"></span></a>
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
@endsection
