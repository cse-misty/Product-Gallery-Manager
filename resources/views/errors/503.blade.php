@extends('errors.master')
@section('title')Dashboard - Error @endsection
@section('content')

<div id="app">
    <section class="section">
      <div class="container">
        <div class="page-error">
          <div class="page-inner">
            <h1>503</h1>
            <div class="page-description">
              Be right back.
            </div>
            <div class="page-search">
                <img src="{{asset('backend')}}/img/error.gif" class="img-fluid"  style="max-width: 80%;height: auto; margin-top:-50px;" alt="">
              <div class="mt-3">
                <a class="btn btn-primary" href="{{ url('/') }}">Back to Home</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  @endsection
