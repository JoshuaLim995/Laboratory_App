
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- return Bouncer::role()->all(); --}}

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">User Type</label>

                            <div class="col-md-6">
                                {!! Form::select('type', Bouncer::role()->pluck('title', 'name'), null, [
                                'class' => 'form-control select2',
                                'placeholder' => 'Select User Type',
                                'multiple' => false,
                                'required',
                                ]) !!}
                                @if ($errors->has('type'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="required">

                                @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact" class="col-md-4 col-form-label text-md-right">Contact</label>

                            <div class="col-md-6">
                                <input id="contact" type="text" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" name="contact" value="{{ old('contact') }}" required>

                                @if ($errors->has('contact'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('contact') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>

                                @if ($errors->has('username'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right">Department</label>

                            <div class="col-md-6">
                                <input id="department" type="text" class="form-control{{ $errors->has('department') ? ' is-invalid' : '' }}" name="department" value="{{ old('department') }}" required>

                                @if ($errors->has('department'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('department') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="programme" class="col-md-4 col-form-label text-md-right">Programme</label>

                            <div class="col-md-6">
                                <input id="programme" type="text" class="form-control{{ $errors->has('programme') ? ' is-invalid' : '' }}" name="programme" value="{{ old('programme') }}">

                                @if ($errors->has('programme'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('programme') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="supervisor" class="col-md-4 col-form-label text-md-right">Supervisor</label>

                            <div class="col-md-6">
                                <input id="supervisor" type="text" class="form-control{{ $errors->has('supervisor') ? ' is-invalid' : '' }}" name="supervisor" value="{{ old('supervisor') }}">

                                @if ($errors->has('supervisor'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('supervisor') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="work_bench" class="col-md-4 col-form-label text-md-right">Work Bench</label>

                            <div class="col-md-6">
                                <input id="work_bench" type="text" class="form-control{{ $errors->has('work_bench') ? ' is-invalid' : '' }}" name="work_bench" value="{{ old('work_bench') }}">

                                @if ($errors->has('work_bench'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('work_bench') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="office" class="col-md-4 col-form-label text-md-right">Office</label>

                            <div class="col-md-6">
                                <input id="office" type="text" class="form-control{{ $errors->has('office') ? ' is-invalid' : '' }}" name="office" value="{{ old('office') }}">

                                @if ($errors->has('office'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('office') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
