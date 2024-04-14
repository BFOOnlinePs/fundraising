@extends('layouts.app')
@section('style')
@endsection
@section('content')
    @include('alert_message.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('settings.currency.add') }}" class="btn btn-primary waves-effect waves-light mt-1">Add Currency
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Arabic name</th>
                                    <th>English name</th>
                                    <th>Symbol</th>
                                    <th>Abbreviation</th>
                                    <th>Flag</th>
                                    <th>Is default</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">No Data</td>
                                    </tr>
                                @else
                                    @foreach($data as $key)
                                        <tr>
                                            <td>{{ $key->currency_name_ar }}</td>
                                            <td>{{ $key->currency_name_en }}</td>
                                            <td>{{ $key->currency_symbol }}</td>
                                            <td>{{ $key->currency_abbreviation }}</td>
                                            <td>
                                                <img src="{{ asset('storage/currency/'.$key->currency_flag) }}" style="width: 80px" alt="">
                                            </td>
                                            <td>
                                                @if($key->is_default == 1)
                                                    Yes
                                                @else
                                                    No
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-success" href="{{ route('settings.currency.edit',['id'=>$key->id]) }}"><span class="fa fa-edit"></span></a>
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
