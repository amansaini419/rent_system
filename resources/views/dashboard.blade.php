@extends('layouts.master')

@section('title')
  Dashboard
@endsection

@if (Auth::user()->user_type == 'TENANT')
  @include('dashboard-tenant')
@elseif (Auth::user()->user_type == 'STAFF' || Auth::user()->user_type == 'AGENT')
  @include('dashboard-staff')
@elseif (Auth::user()->user_type == 'ADMIN')
  @include('dashboard-admin')
@endif