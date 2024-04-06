@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary waves-effect waves-light mt-1" data-bs-toggle="modal"
                            data-bs-target="#user-create-modal">Add users
                    </button>
                </div>
                <div class="card-body">
                    <div class="row mt-2">
                        <div id="users_table_ajax">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.users.modals.createUserModal')
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            users_table_ajax();
        });
        function users_table_ajax() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#donors_table_ajax').html(`<div class="text-center"><span class="spinner-border text-primary m-2"></span></div>`);
            $.ajax({
                method: "POST",
                url: "{{ route('users.users_table_ajax') }}",
                datatype:'json',
                data:{
                    'search' : $('#search_input').val()
                },
                success:function(data){
                    $('#users_table_ajax').html(data.view);
                },
                error:function(){

                }
            })
        }
    </script>
@endsection
