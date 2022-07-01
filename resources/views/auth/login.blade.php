@extends('backend.layouts.admin.admin')

@section('title', 'Login')

@section('guest')
    <!-- BEGIN LOGIN SECTION -->
    <section class="section-account">
        <div class="row col-md-12 logo" align="center">
        </div>
        <div class="row col-md-12" align="center">
            <div class="card col-sm-4 col-sm-offset-4 ">
                <div class="card-body">
                    <br/>
                    <span class="text-lg text-bold text-primary" style="color: #6E2B86;">{{ (' ADMIN PANEL') }}</span>
                    <br/><br/>

                    <form class="form form-validate" role="form" style="text-align:left;" method="POST"
                          action="{{ url('/login') }}" autocomplete="off" novalidate>
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="email"
                                   class="text col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            {{--<div class="col-md-6">--}}
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" style="height: 57px"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                            {{--</div>--}}
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" style="height: 57px" id="password"
                                   name="password" required>
                            <label for="password">Password</label>
                            <p class="help-block">
                                <a href="{{ url('/password/reset') }}" target="_blank">Forgot?</a>
                            </p>
                        </div>
                        <br/>

                        <div class="form-group row">

                            <div class="col-xs-6 text-right">
                                <button class="btn btn-primary btn-raised" type="submit" style="background-color: #28A575;
                            border-color: #28A575;">Login</button>
                            </div><!--end .col -->
                        </div><!--end .row -->
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- END LOGIN SECTION -->

    <footer class="text-center">
        <p>
            Copyright &#183; {{ str_replace('_',' ',config('app.name'))}} &#183; {{date('Y')}}
        </p>
    </footer>
@endsection

@push('styles')
    <style type="text/css">
        .logo {
            margin-top: 60px;
            margin-bottom: 15px;
        }
    </style>
@endpush
