@extends('layouts.app')
@section('style')
@endsection
@section('content')
    @include('alert_message.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('settings.currency.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Arabic name</label>
                                    @error('currency_name_ar')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="text" value="{{ old('currency_name_ar') }}" class="form-control" name="currency_name_ar">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">English name</label>
                                    @error('currency_name_en')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="text" value="{{ old('currency_name_en') }}" class="form-control" name="currency_name_en">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Abbreviation</label>
                                    @error('currency_abbreviation')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="text" value="{{ old('currency_abbreviation') }}" class="form-control" name="currency_abbreviation">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Symbol</label>
                                    @error('currency_symbol')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="text" value="{{ old('currency_symbol') }}" class="form-control" name="currency_symbol">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Flag</label>
                                    @error('currency_flag')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="file" value="{{ old('currency_flag') }}" class="form-control" name="currency_flag">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
