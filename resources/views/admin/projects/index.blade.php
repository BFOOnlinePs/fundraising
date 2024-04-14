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
                    <a type="button" href="{{ route('projects.add') }}" class="btn btn-primary waves-effect waves-light mt-1">Add project
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mt-2">
                        <div id="project_table_ajax">

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
            project_table_ajax();
        });
        function project_table_ajax() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "{{ route('projects.project_table_ajax') }}",
                datatype:'json',
                data:{
                    'search' : $('#search_input').val()
                },
                success:function(data){
                    if(data.success == 'true'){
                        $('#project_table_ajax').html(data.view);
                    }
                },
                error:function(){

                }
            })
        }
    </script>
@endsection
