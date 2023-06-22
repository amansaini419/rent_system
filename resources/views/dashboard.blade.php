@extends('layouts.master')

@section('title')
  Dashboard
@endsection

@section('own-style')
  <style>
    .card-dash{
      height: 450px;
    }
  </style>
@endsection

@if (Auth::user()->user_type == 'TENANT')
  @include('dashboard-tenant')
@elseif (Auth::user()->user_type == 'STAFF' || Auth::user()->user_type == 'AGENT')
  @include('dashboard-staff')
@elseif (Auth::user()->user_type == 'ADMIN')
  @include('dashboard-admin')
@endif

@section('theme-script')
  <script src="{{ asset('assets/pages/widget/amchart/amcharts.js') }}"></script>
  <script src="{{ asset('assets/pages/widget/amchart/pie.js') }}"></script>
@endsection