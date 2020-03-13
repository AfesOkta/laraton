@extends('layouts.adminbsb')
@section('title', 'SCRAPER')

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-left">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h2>Basic Setting</h2>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line success">
                                    <input type="text" id="setting-appname" name="appname" class="form-control" value="{{ $scraper->appname }}" required="required">
                                    <label class="form-label" for="setting-appname">Email <span class="col-red">*</span></label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line success">
                                    <input type="text" id="setting-subname" name="subname" class="form-control" value="{{ $scraper->subname }}" required="required">
                                    <label class="form-label" for="setting-subname">Password <span class="col-red">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h4>Search</h4>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line success">
                                    <input type="text" id="setting-search" name="subname" class="form-control" value="{{ $scraper->subname }}" required="required">
                                    <label class="form-label" for="setting-subname">IMO, NAME, COMPANY <span class="col-red">*</span></label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line success">
                                    <input type="checkbox" value="SHIP" id="ship" class="chk-col-green filled-in checkbox-group" name="ship"/>
                                    <label for="ship">SHIP</label>
                                    <input type="checkbox" value="COMPANY" id="company" class="chk-col-green filled-in checkbox-group" name="ship"/>
                                    <label for="company">Company</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('template/adminbsb/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"/>

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('template/adminbsb/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}"
          rel="stylesheet"/>

    <!-- Fontawesome Iconpicker -->
    <link href="{{ asset('ext/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css')}}" rel="stylesheet">
@endpush
