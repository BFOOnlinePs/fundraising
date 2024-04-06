@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a type="button" href="{{ route('media_report.add') }}" class="btn btn-primary waves-effect waves-light mt-1">Add media report
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mt-2">
                        <div id="media_report_table_ajax">

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
