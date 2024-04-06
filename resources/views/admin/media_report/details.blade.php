@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('content')
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('media_report.approved_media_report') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Arabic title</label>
                                            <textarea @if(auth()->user()->user_role == 4) readonly @endif type="text" class="form-control" name="title_ar" rows="1" placeholder="Arabic title">{{ $data->title_ar }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">English title</label>
                                            <textarea @if(auth()->user()->user_role == 4) readonly @endif type="text" class="form-control" name="title_en" rows="1" placeholder="English title">{{ $data->title_en }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mt-2">
                                            <label for="">Arabic media report</label>
                                            <textarea @if(auth()->user()->user_role == 4) readonly @endif class="form-control" name="media_report_content_ar" id="" cols="30" placeholder="English media report" rows="2">{{ $data->media_report_content_ar }}</textarea>
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
                                            <textarea @if(auth()->user()->user_role == 4) readonly @endif class="form-control" name="media_report_content_en" id="" cols="30" placeholder="English media report" rows="2">{{ $data->media_report_content_en }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <br>
                                    <img style="width: 200px" src="{{ asset('storage/product/'.$data->main_photo) }}" alt="">
                                    <input type="file" name="main_photo" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button @if($data->status != 'pending') disabled @endif class="mt-2 btn btn-success" name="submit" value="approved">Approved</button>
                        <button @if($data->status != 'pending') disabled @endif class="mt-2 btn btn-danger" name="submit" value="not_approved">Not approved</button>
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
    </script>

@endsection
