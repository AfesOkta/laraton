@extends('layouts.adminbsb')
@section('title', 'SCRAPPER')

@section('content')

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
