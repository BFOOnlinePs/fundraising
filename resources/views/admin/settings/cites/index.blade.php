@extends('layouts.app')
@section('style')
@endsection
@section('content')
    @include('alert_message.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('settings.cites.add') }}" class="btn btn-primary waves-effect waves-light mt-1">Add City
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Arabic name</th>
                                    <th>English name</th>
                                    <th>Description</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No Data</td>
                                    </tr>
                                @else
                                    @foreach($data as $key)
                                        <tr>
                                            <td>{{ $key->city_name_ar }}</td>
                                            <td>{{ $key->city_name_en }}</td>
                                            <td>{{ $key->city_description }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-success" href="{{ route('settings.cites.edit',['id'=>$key->id]) }}"><span class="fa fa-edit"></span></a>
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
