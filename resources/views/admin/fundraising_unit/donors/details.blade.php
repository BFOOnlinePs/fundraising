@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Contact person name</th>
                                <th>Contact person phone</th>
                                <th>Contact person email</th>
                                <th>Contact person gender</th>
                                <th>Contact person position</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($contact_person->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">No Data</td>
                            </tr>
                        @else
                            @foreach($contact_person as $key)
                                <tr>
                                    <td>{{ $key->contact_person_name }}</td>
                                    <td>{{ $key->contact_person_phone }}</td>
                                    <td>{{ $key->contact_person_email }}</td>
                                    <td>{{ $key->contact_person_gender }}</td>
                                    <td>{{ $key->contact_person_position }}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
