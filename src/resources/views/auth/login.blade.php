@extends('auth.layout')

@section('content')

           <section class="loginPanel">
               <span class="loginPanel__header">{{ __('auth.login') }} admin</span>
               <div class="loginPanel__formWrapper">
                   <form method="POST" action="{{ route('login') }}">
                       @csrf

                       <div class="form-group row">
                           <label for="email" class="col-md-4 col-form-label text-md-right"> </label>

                               <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('auth.email') }}" required autocomplete="email" autofocus>

                               @error('email')
                               <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                               @enderror
                       </div>

                       <div class="form-group row">
                           <label for="password" class="col-md-4 col-form-label text-md-right"> </label>

                               <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('auth.password') }}">

                               @error('password')
                               <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                               @enderror
                       </div>

                       <div class="form-group row">
                               <div class="form-check">
                                   <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                   <label class="form-check-label" for="remember">
                                       {{ __('auth.remember_me') }}
                                   </label>
                               </div>
                           </div>


                          <div class="form-group row mb-0 mt-3 flex-wrapper">
                              <button type="submit" class="btn button -yellow mr-1" style="width: 100%">
                                  {{ __('auth.sign_in') }}
                              </button>

{{--                              @if (Route::has('password.request'))--}}
{{--                                  <a class="btn button  -red mr-1" href="{{ route('password.request') }}">--}}
{{--                                      {{ __('auth.forgot_password') }}--}}
{{--                                  </a>--}}
{{--                              @endif--}}
                          </div>

                   </form>
               </div>
           </section>
@endsection
