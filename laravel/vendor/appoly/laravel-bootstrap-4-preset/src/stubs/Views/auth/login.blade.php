@extends('layouts.app')

@section('content')

<div class="row justify-content-md-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <h4 class="card-header">Login</h4>
            <div class="card-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label for="email">E-Mail Address</label>
                        <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}">
                        
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" value="{{ old('password') }}">
                        
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    
                    </div>

                     <div class="form-group">
                        <div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-primary btn-block">
                                Sign In
                            </button>

                            <a class="btn btn-link text-right" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
