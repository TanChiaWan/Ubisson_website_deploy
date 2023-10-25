@extends('layouts.app')

@section('content')
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>
    Login
</title>
<body>
<div class='loginimg'>
        <img class='bio-tective-logo' src='images/BioTectiveLogo.png' alt='BioTectiveLogo' />


        <h1 class='title'>BioTective Disease Resource Centre</h1>

    </div>

    <div class='loginimg'>
        <img class='loginline' src='images/line.png' alt='loginline' />
    </div>
    <link href="{{asset('css/loginstyle.css')}}" rel="stylesheet">

    
        <div class="loginimg row mb-2">
            <div class="overlap-group">
                <div class="rectangle-373">
                    <div class="log-in">{{ __('Log In') }}</div>
                </div>
                    <div class="rectangle-1"></div>
                    
                    <form method="POST" action="{{ url('/login') }}">
                        @csrf
                       
                        <div class="loginimg row mb-2">
                       
                            <label for="organisation-id" class="organisation-id  text-md-front">{{ __('Organisation ID: ') }}</label>
                    
                            <div class="col-md-5">
                            <div class="rectangle-2"></div>
                                <input class='inputnumber' id="organizationid" type="number" class="form-control" name="organizationid" value="{{ old('organizationid') }}" required autofocus autocomplete="off">
                                @if ($errors->has('organizationid'))
                        <div class=' error '>
                                    <span class="text-danger">{{ $errors->first('organizationid') }}</span>
</div>
                                    @endif
                                
                            </div>
                        </div>
                        <div class="loginimg row mb-2">
                        @if ($errors->has('username'))
                        <div class='error'>
                                    <span class=" text-danger">{{ $errors->first('username') }}</span>
</div>
                                    @endif
                            <label for="username" class="username   text-md-front">{{ __('Username: ') }}</label>

                            <div class="col-md-6">
                            <div class="rectangle-3"></div>
                                <input class='usernamefld' id="username" type="text" class="form-control" name="username" required autocomplete="false">

                              
                            </div>
                        </div>

                        <div class="loginimg row mb-2">
                        @if ($errors->has('password'))
                        <div class='error'>
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
</div>
                                    @endif
                            <label for="password" class="password  text-md-front">{{ __('Password: ') }}</label>

                            <div class="col-md-6">
                            <div class="rectangle-4"></div>
                                <input class='passwordfld' id="password" type="password" class="form-control" name="password" required  autocomplete="new-password">

                            
                            </div>
                        </div>

                        <div class="loginimg row mb-2">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="remember " type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="remember-me form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        
                        </div>

                        
                        <div class='logindiv'>
                                <button type="submit" class=" loginbutton">
                                    {{ __('Login') }}
                                </button>
                              
</div>
                  
                    </form>
                
            </div>
        </div>
</body>

@endsection
