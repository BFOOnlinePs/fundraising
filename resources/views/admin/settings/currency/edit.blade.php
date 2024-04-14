@extends('layouts.app')
@section('style')
@endsection
@section('content')
    @include('alert_message.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('settings.currency.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Arabic name</label>
                                    @error('currency_name_ar')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="text" value="{{ old('currency_name_ar',$data->currency_name_ar) }}" class="form-control" name="currency_name_ar">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">English name</label>
                                    @error('currency_name_en')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="text" value="{{ old('currency_name_en',$data->currency_name_en) }}" class="form-control" name="currency_name_en">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Abbreviation</label>
                                    @error('currency_abbreviation')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="text" value="{{ old('currency_abbreviation',$data->currency_abbreviation) }}" class="form-control" name="currency_abbreviation">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Symbol</label>
                                    @error('currency_symbol')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="text" value="{{ old('currency_symbol',$data->currency_symbol) }}" class="form-control" name="currency_symbol">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Flag</label>
                                    <br>
                                    @if(!empty($data->currency_flag))
                                        <img style="width: 100px" src="{{ asset('storage/currency/'.$data->currency_flag) }}" alt="">
                                    @endif
                                    @error('currency_flag')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="file" value="{{ old('currency_flag',$data->currency_flag) }}" class="form-control" name="currency_flag">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
