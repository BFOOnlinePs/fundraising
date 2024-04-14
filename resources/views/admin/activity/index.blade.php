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
                    <a type="button" href="{{ route('activity.add') }}" class="btn btn-primary waves-effect waves-light mt-1">Add activity
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Arabic name</th>
                                        <th>English name</th>
                                        <th>Arabic description</th>
                                        <th>English description</th>
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
                                                <td>{{ $key->activity_name_ar }}</td>
                                                <td>{{ $key->activity_name_en }}</td>
                                                <td>{{ $key->activity_descripttion_ar }}</td>
                                                <td>{{ $key->activity_descripttion_en }}</td>
                                                <td>
                                                    <a href="" class="btn btn-sm btn-success"><span class="fa fa-edit"></span></a>
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
@section('script')
    <script>
        $(document).ready(function () {
            media_report_table_ajax();
        });
        function media_report_table_ajax() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "{{ route('media_report.media_report_table_ajax') }}",
                datatype:'json',
                data:{
                    'search' : $('#search_input').val()
                },
                success:function(data){
                    $('#media_report_table_ajax').html(data.view);
                },
                error:function(){

                }
            })
        }
    </script>
@endsection
