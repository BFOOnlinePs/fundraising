@extends('layouts.app')
@section('style')
@endsection
@section('content')
    @include('alert_message.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary waves-effect waves-light mt-1" data-bs-toggle="modal"
                            data-bs-target="#region-create-modal">Add Region
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="region_table">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.settings.region.modals.region_create_modal')
    @include('admin.settings.region.modals.region_edit_modal')
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            region_table_ajax();
        });

        function region_table_ajax() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#region_table').html(`<div class="text-center"><span class="spinner-border text-primary m-2"></span></div>`);
            $.ajax({
                method: "POST",
                url: "{{ route('settings.region.region_table_ajax') }}",
                data:{

                },
                datatype:'json',
                success:function(data){
                    if (data.success === 'true'){
                        $('#region_table').html(data.view);
                    }
                },
                error:function(){
                    alert('error');
                }
            })
        }

        function get_data_from_region(data) {
            $('#region_id').val(data.regions_id);
            $('#regions_name_edit').val(data.regions_name);
            $('#region-edit-modal').modal('show');
        }

        function update_region_ajax() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // $('#region_table').html(`<div class="text-center"><span class="spinner-border text-primary m-2"></span></div>`);
            $.ajax({
                method: "POST",
                url: "{{ route('settings.region.update') }}",
                data:{
                    'region_id':$('#region_id').val(),
                    'regions_name':$('#regions_name_edit').val()
                },
                datatype:'json',
                success:function(data){
                    if (data.success === 'true'){
                        $('#region-edit-modal').modal('hide');
                        region_table_ajax();
                    }
                },
                error:function(){
                    alert('error');
                }
            })
        }
    </script>
@endsection
