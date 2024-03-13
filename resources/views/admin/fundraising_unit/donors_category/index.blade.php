@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('fundraising_unit.donors.index') }}" type="button" class="btn btn-rounded btn-primary">Donors list</a>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary waves-effect waves-light mt-1" data-bs-toggle="modal"
                            data-bs-target="#donors-category-create-modal">Add donors category
                    </button>
                </div>
                <div class="card-body">
                    <div class="row mt-2">
                        <div id="donors_category_table_ajax">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.fundraising_unit.donors_category.modals.donors_category_create_modal')
    @include('admin.fundraising_unit.donors_category.modals.donors_category_edit_modal')
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            donors_category_table_ajax();
        })

        function donors_category_table_ajax() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#donors_category_table_ajax').html(`<div class="text-center"><span class="spinner-border text-primary m-2"></span></div>`);
            $.ajax({
                method: "POST",
                url: "{{ route('fundraising_unit.donors.donors_category.donors_category_table_ajax') }}",
                data:$('#donors_category_form').serialize(),
                datatype:'json',
                success:function(data){
                    $('#donors_category_table_ajax').html(data.view);
                },
                error:function(){

                }
            })
        }

        $('#donors_category_form').on('submit',function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "{{ route('fundraising_unit.donors.donors_category.create') }}",
                data:$('#donors_category_form').serialize(),
                datatype:'json',
                success:function(data){
                    console.log(data.message);
                    $('#donors-category-create-modals').modal('hide');
                    donors_category_table_ajax();
                },
                error:function(){

                }
            })
        })

        $('#donors_category_form_edit').on('submit',function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "{{ route('fundraising_unit.donors.donors_category.update') }}",
                data:$('#donors_category_form_edit').serialize(),
                datatype:'json',
                success:function(data){
                    console.log(data);
                    $('#donors-category-edit-modals').modal('hide');
                    donors_category_table_ajax();
                },
                error:function(){

                }
            })
        })

        function get_data_from_donors_category(data) {
            $('#donors_category_id').val(data.donors_categories_id);
            $('#donors_categories_arabic_name').val(data.donors_categories_arabic_name);
            $('#donors_categories_english_name').val(data.donors_categories_english_name);
            $('#donors-category-edit-modals').modal('show');
        }
    </script>
@endsection
