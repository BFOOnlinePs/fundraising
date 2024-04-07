@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#donors-create-modal">Add Donor
                    </button>
{{--                    <button type="button" class="btn btn-rounded btn-primary">Donors list</button>--}}
                    <a href="{{ route('fundraising_unit.donors.donors_category.index') }}" type="button" class="btn btn-rounded btn-success">Donors category</a>
                    <a href="#" id="send-email" class="btn btn-rounded btn-success">Send email</a>
                    <form action="{{ route('fundraising_unit.donors.import_donors_to_excel') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="donors_file">
                        <button type="submit" class="btn btn-rounded btn-success">Import Excel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Donors name</label>
                                <input onkeyup="donors_table_ajax()" id="search_donors_name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Region</label>
                                <select onchange="donors_table_ajax()" class="form-control" name="" id="region_id">
                                    <option value="">Select Region</option>
                                    @foreach($regions as $key)
                                        <option value="{{ $key->regions_id }}">{{ $key->regions_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Category</label>

                                <select onchange="donors_table_ajax()" class="form-control" name="" id="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($category_donors as $key)
                                        <option value="{{ $key->donors_categories_id }}">{{ $key->donors_categories_english_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Is partner</label>
                                <select onchange="donors_table_ajax()" class="form-control" name="" id="is_partner">
                                    <option value="">All</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="donors_table_ajax">

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('admin.fundraising_unit.donors.modals.donors_create_modal')
    @include('admin.fundraising_unit.donors.modals.donors_contact_person_modal')
    @include('admin.fundraising_unit.donors.modals.donors_edit_modal')
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            donors_table_ajax();
        })

        function donors_table_ajax() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#donors_table_ajax').html(`<div class="text-center"><span class="spinner-border text-primary m-2"></span></div>`);
            $.ajax({
                method: "POST",
                url: "{{ route('fundraising_unit.donors.donors_table_ajax') }}",
                datatype:'json',
                data:{
                  'search_donors_name':$('#search_donors_name').val(),
                  'region_id':$('#region_id').val(),
                  'category_id':$('#category_id').val(),
                  'is_partner':$('#is_partner').val(),
                },
                success:function(data){
                    $('#donors_table_ajax').html(data.view);
                },
                error:function(){

                }
            })
        }

        function save_donors_btn() {
            var checkbox = document.getElementById("donors_is_partner");
            var donors_is_partner_ckeckbox = 0;
            if (checkbox.checked) {
                donors_is_partner_ckeckbox = 1;
            } else {
                donors_is_partner_ckeckbox = 0;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // $('#donors_input_modal').html(`<div class="text-center"><span class="spinner-border text-primary m-2"></span></div>`);
            $.ajax({
                method: "POST",
                url: "{{ route('fundraising_unit.donors.create') }}",
                data:{
                    'donors_arabic_name':$('#donors_arabic').val(),
                    'donors_english_name':$('#donors_english').val(),
                    'donors_regions_id':$('#donors_region_id').val(),
                    'fax':$('#fax').val(),
                    'address':$('#address').val(),
                    'website':$('#website').val(),
                    'work_field':$('#work_field').val(),
                    'donors_donors_categories_id':$('#donors_donors_categories_id').val(),
                    'donors_is_partner':donors_is_partner_ckeckbox,
                },
                datatype:'json',
                success:function(data){
                    if(data.success === 'true'){
                        $('#contact_person_donors_id').val(data.data.donors_id);
                        $('#donors-create-modal').modal('hide');
                        $('#donors-contact-person-modal').modal('show');
                        contact_person_table_ajax();
                    }
                },
                error:function(){
                    alert('error');
                }
            })
        }

        function update_donors_btn() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // $('#donors_input_modal').html(`<div class="text-center"><span class="spinner-border text-primary m-2"></span></div>`);
            $.ajax({
                method: "POST",
                url: "{{ route('fundraising_unit.donors.update') }}",
                data:{
                    'donors_id':$('#donor_id').val(),
                    'donors_arabic_name':$('#donors_arabic_edit').val(),
                    'donors_english_name':$('#donors_english_edit').val(),
                    'donors_regions_id':$('#donors_region_id_edit').val(),
                    'donors_donors_categories_id':$('#donors_donors_categories_id_edit').val(),
                    'fax':$('#fax_edit').val(),
                    'address':$('#address_edit').val(),
                    'website':$('#website_edit').val(),
                    'work_field':$('#work_field_edit').val(),
                },
                datatype:'json',
                success:function(data){
                    $('#donors-edit-modal').modal('hide');
                    donors_table_ajax();
                },
                error:function(){
                    alert('error');
                }
            })
        }

        function contact_person_table_ajax() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // $('#donors_input_modal').html(`<div class="text-center"><span class="spinner-border text-primary m-2"></span></div>`);
            $.ajax({
                method: "POST",
                url: "{{ route('fundraising_unit.donors.contact_person_table_ajax') }}",
                data:{
                    'contact_person_donors_id':$('#contact_person_donors_id').val(),
                },
                datatype:'json',
                success:function(data){
                    if(data.success === 'true'){
                        $('#contact_person_table').html(data.view);
                    }
                },
                error:function(){

                }
            })
        }

        function contact_person_create() {
            if(($('#contact_person_name').val() === '') || ($('#contact_person_phone').val()) === '' || ($('#contact_person_email').val() === '') || ($('#contact_person_gender').val() === '') || ($('#contact_person_position').val() === '') ){
                alert('One of the fields is required');
            }
            else{
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                // $('#donors_input_modal').html(`<div class="text-center"><span class="spinner-border text-primary m-2"></span></div>`);
                $.ajax({
                    method: "POST",
                    url: "{{ route('fundraising_unit.donors.contact_person_create_ajax') }}",
                    data:{
                        'contact_person_donors_id':$('#contact_person_donors_id').val(),
                        'contact_person_name':$('#contact_person_name').val(),
                        'contact_person_phone':$('#contact_person_phone').val(),
                        'contact_person_email':$('#contact_person_email').val(),
                        'contact_person_gender':$('#contact_person_gender').val(),
                        'contact_person_position':$('#contact_person_position').val(),
                    },
                    datatype:'json',
                    success:function(data){
                        if(data.success === 'true'){
                            contact_person_table_ajax();
                            contact_person_data_empty();
                        }
                    },
                    error:function(){

                    }
                })
            }
        }

        function contact_person_data_empty() {
                $('#contact_person_name').val('');
                $('#contact_person_phone').val('');
                $('#contact_person_email').val('');
                $('#contact_person_gender').val('');
                $('#contact_person_position').val('');
        }

        function button_close_modal() {
            $('#donors-contact-person-modal').modal('hide');
        }

        function get_data_for_edit_donors(data) {
            $('#donor_id').val(data.donors_id);
            $('#donors_arabic_edit').val(data.donors_arabic_name);
            $('#donors_english_edit').val(data.donors_english_name);
            $('#donors_region_id_edit').val(data.donors_regions_id);
            $('#donors_donors_categories_id_edit').val(data.donors_donors_categories_id);
            $('#fax_edit').val(data.fax);
            $('#address_edit').val(data.address);
            $('#website_edit').val(data.website);
            $('#work_field_edit').val(data.work_field);
            $('#donors-edit-modal').modal('show');
        }
    </script>
@endsection
