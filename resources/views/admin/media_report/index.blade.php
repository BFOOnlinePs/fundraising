@extends('layouts.app')
@section('style')
    <style>
        td{
            white-space:pre-wrap;
            word-wrap:break-word;
        }
    </style>
@endsection
@section('content')
    @include('alert_message.success')
    @include('alert_message.fail')
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a type="button" href="{{ route('media_report.add') }}" class="btn btn-primary waves-effect waves-light mt-1">Add media report
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-md-12 mb-2">
                            <input onkeyup="media_report_table_ajax()" id="search_input" type="text" placeholder="Ar Title or En Title" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <div id="media_report_table_ajax">

                                </div>
                            </div>
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

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                media_report_table_ajax(page);
            });
        });
        function media_report_table_ajax(page) {
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
                    'search' : $('#search_input').val(),
                    'page' : page
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
