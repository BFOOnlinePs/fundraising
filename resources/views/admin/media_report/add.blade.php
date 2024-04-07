@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('style')
    <style>
        /*.preview-item {*/
        /*    margin-right: 10px;*/
        /*    width: 20px; !* Adjust as needed *!*/
        /*    height: 60px; !* Adjust as needed *!*/
        /*    overflow: hidden;*/
        /*    position: relative;*/
        /*    display: inline-block;*/
        /*}*/
        /*.preview-item img {*/
        /*    width: 100%;*/
        /*    height: 100%;*/
        /*    object-fit: cover;*/
        /*}*/
        .remove-btn {
            position: absolute;
            top: 2px; /* Adjust as needed */
            right: 2px; /* Adjust as needed */
            cursor: pointer;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 2px;
            border-radius: 50%;
        }
    </style>
@endsection
@section('content')
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('media_report.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Arabic title</label>
                                            <textarea required dir="rtl" type="text" class="form-control" name="title_ar" rows="4" placeholder="ضع عنوان"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">English title</label>
                                            <textarea required type="text" class="form-control" name="title_en" rows="4" placeholder="English title"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mt-2">
                                            <label for="">Arabic media report</label>
                                            <textarea required class="form-control" dir="rtl" name="media_report_content_ar" id="" cols="30" placeholder="اكتب وصف" rows="2"></textarea>
                                            {{--                                <div class="summernote" id="summernote">--}}

                                            {{--                                </div>--}}
                                            {{--                                <textarea name="" id="summernote" cols="30" rows="10"></textarea>--}}
                                            {{--                                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>--}}

                                            {{--                                <script>--}}
                                            {{--                                    $(document).ready(function() {--}}
                                            {{--                                        $('#summernote').summernote();--}}
                                            {{--                                    });--}}
                                            {{--                                </script>--}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mt-2">
                                            <label for="">English media report</label>
                                            <textarea required class="form-control" name="media_report_content_en" id="" cols="30" placeholder="English media report" rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mt-2">
                                            <label for="">Attachment</label>
                                            <input type="file" class="form-control" id="image-input" name="images[]" multiple accept="image/*">
                                        </div>
                                        <div class="preview-container row" id="image-preview"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <p style="font-size: 100px"><span class="fa fa-image"></span></p>
                                    <input required type="file" name="main_photo" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button class="mt-2 btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>

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

        $(document).ready(function() {
            $('#image-input').on('change', function() {
                const files = $(this)[0].files;
                const previewContainer = $('#image-preview');

                if (files.length === 0) {
                    console.log('No files selected.');
                    return; // No files selected, exit the function
                }

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const removeBtn = $('<span>').addClass('remove-btn text-danger').html('&times;');
                        const img = $('<img>').attr('src', e.target.result).attr('width','250px');
                        const previewItem = $('<div>').addClass('preview-item').addClass('col-md-3').append(removeBtn, img);

                        // Assign data attribute to remove button
                        $(removeBtn).attr('data-index', i);

                        removeBtn.on('click', function() {
                            const index = $(this).attr('data-index');
                            $(this).closest('.preview-item').remove();
                            // Remove corresponding file from cloned input
                            const fileName = files[index].name;
                            const clonedInput = $('#image-input-clone')[0];
                            $(clonedInput).val(''); // Clear cloned input value
                            const files = clonedInput.files;
                            for (let j = 0; j < files.length; j++) {
                                if (files[j].name !== fileName) {
                                    $(clonedInput).prop('files').push(files[j]); // Add back other files
                                }
                            }
                        });

                        previewContainer.append(previewItem);
                    };

                    reader.readAsDataURL(file);
                }

                // Clone the input field and hide the original
                const clonedInput = $(this).clone().attr('id', 'image-input-clone').hide();
                $(this).after(clonedInput);
                // Clear the file input to allow selecting additional images
                $(this).val('');
            });
        });
    </script>
@endsection
