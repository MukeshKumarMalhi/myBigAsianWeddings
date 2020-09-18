@extends('layouts.app')

@section('content')
<!-- section 1 signup-->
<div class="pt-r10 bg-center-url" style="background-image: url('web_asset/images/bb-background-crop@2x.png');">
    <div class="container bs-search-form text-left py-80">
        <div class="signup-box px-3" style="max-width: 500px;">
            <form action="{{ route('login') }}" method="POST">
              @csrf
                <div class="card mb-3">
                    <div class="p-4">
                        <div class="form-group">
                            <h2 class="font-weight-bold text-pink">Login</h2>
                        </div>
                        <div class="form-group">
                            <a href="{{ url('/auth/redirect/facebook') }}" class="btn link-light bg-facebook px-3 rounded mb-2 text-center d-block">Log in with Facebook</a>
                            <a href="{{ url('/auth/redirect/google') }}" class="btn link-light bg-google rounded mb-2 text-center d-block">Log in with Google</a>
                        </div>
                        <div class="form-group bs-form-db">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text rounded-0"><i class="fal fa-user text-pink"></i></span></div>
                                <!-- <input id="email" name="email" type="email" class="form-control pl-0" placeholder="Email Address" required> -->
                                <input id="email" type="email" class="form-control pl-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email">
                                @if($errors->has('email'))
                                  <span class="invalid-feedback" role="alert" style="margin-left: 40px; font-size: 14px;">
                                      <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ $errors->first('email') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group bs-form-db">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text rounded-0"><i class="fal fa-lock-alt text-pink"></i></span></div>
                                <!-- <input id="password" type="password" name="password" class="form-control pl-0" placeholder="Password" required> -->
                                <input id="password" type="password" class="form-control pl-0 @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                                @if($errors->has('password'))
                                  <span class="invalid-feedback" role="alert" style="margin-left: 40px; font-size: 14px;">
                                      <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ $errors->first('password') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                          @if($errors->has('acc'))
                              <p class="alert alert-danger" style="color: #F00;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ $errors->first('acc') }}</p>
                          @endif
                        </div>
                        <div class="clearfix">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-dark btn-purple font-weight-bold mb-2 rounded">Log in</button>
                            </div>
                            <div class="form-group text-center link-purple text-pink font-weight-bold">
                                Don't have a MyBigAsianWedding account?<a href="{{ url('/signup') }}"> Sign up</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="bg-purple py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="link-light text-light"> Facebook
                    <h2 class="font-weight-bold">Is MyBigAsianWedding for me?</h2>
                    <p>If you want a little less stress in your life and a little more time to bask in the engagement glow, then yes, MyBigAsianWedding is definitely for you! MyBigAsianWedding brings wedding planning into the 21st century - there’s everything you need to plan your wedding (without the stress!) all in one place, for free.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="link-light text-light">
                    <h2 class="font-weight-bold">Yes, it’s free</h2>
                    <p>We all know how expensive weddings can be, but luckily for you MyBigAsianWedding is completely free. No hidden costs or surprise charges. Instead, you get complete and personalised wedding planning guidance - without the price tag.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
