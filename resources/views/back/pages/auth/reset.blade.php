@extends('back.layouts.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Reset password')
@section('content')

<div class="page page-center">
    <div class="container container-tight py-4">
      <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark"><img src="{{ App\Models\Setting::find(2)->blog_logo }}" height="60" alt=""></a>
      </div>
    <div class="card card-md">
        <div class="card-body">
          <h2 class="h2 text-center mb-4">Reset your password</h2>
          @livewire('author-reset-form')
        </div>
    </div>
</div>
@endsection

