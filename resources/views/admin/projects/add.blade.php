@extends('layouts.app')
@section('style')
@endsection
@section('content')
    @include('alert_message.success')
    @include('alert_message.fail')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('projects.create') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="">Reference number</label>
                                    @error('reference_number')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="text" value="{{ old('reference_number') }}" class="form-control" name="reference_number" placeholder="Reference number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Project name arabic</label>
                                    @error('project_name_ar')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="text" value="{{ old('project_name_ar') }}" class="form-control" name="project_name_ar" placeholder="Project arabic name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Project name english</label>
                                    @error('project_name_en')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="text" value="{{ old('project_name_en') }}" class="form-control" name="project_name_en" placeholder="Project english name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="">Project name description</label>
                                    @error('project_description')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <textarea name="project_description" id="" cols="30" rows="2" placeholder="Project Description" class="form-control">{{ old('project_description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Planned start date</label>
                                    @error('planned_start_date')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="date" value="{{ old('planned_start_date') }}" class="form-control" name="planned_start_date" placeholder="Reference number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Planned end date</label>
                                    @error('planned_end_date')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="date" value="{{ old('planned_end_date') }}" name="planned_end_date" class="form-control" placeholder="Reference number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Institution role</label>
                                    @error('institution_role')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <select class="form-control" name="institution_role" id="">
                                        <option value="">Select institution ...</option>
                                        <option @if(old('institution_role') == 'partner') selected @endif value="partner">Partner</option>
                                        <option @if(old('institution_role') == 'main_applicant') selected @endif value="main_applicant">Main applicant</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Budget</label>
                                    @error('budget')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <input type="text" value="{{ old('budget') }}" name="budget" class="form-control" placeholder="Budget">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Beneficiary type</label>
                                    ( <a href="{{ route('settings.type_of_beneficiaries.add') }}">Add Beneficiary</a> )
                                    @error('beneficiary_id')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <select class="form-control" name="beneficiary_id" id="">
                                        <option value="">Select beneficiary ...</option>
                                        @foreach($beneficiary as $key)
                                            <option @if(old('beneficiary_id') == $key->id) selected @endif value="{{ $key->id }}">{{ $key->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Currency</label>
                                    ( <a href="{{ route('settings.currency.add') }}">Add Currency</a> )
                                    @error('currency_id')
                                    (<span class="text-danger">{{ $message }}</span>)
                                    @enderror
                                    <select class="form-control" name="currency_id" id="">
                                        <option value="">Select currency ...</option>
                                        @foreach($currency as $key)
                                            <option @if(old('currency_id') == $key->id) selected @endif value="{{ $key->id }}">{{ $key->currency_symbol }} {{ $key->currency_name_en }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success mt-2">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
