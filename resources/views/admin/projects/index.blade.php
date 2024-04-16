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
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <div id="project_table_ajax">

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
            project_table_ajax();

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                project_table_ajax(page);
            });
        });
        function project_table_ajax(page) {
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
                    'search' : $('#search_input').val(),
                    'page' : page
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
