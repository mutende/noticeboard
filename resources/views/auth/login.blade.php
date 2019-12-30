@extends('layouts.app')
@section('title','Login')
@section('login_content')
<br><br><br>
<div class="container h-100 mt-5 my-5">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="{{ asset('img/user-icon.png') }}" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form method="POST" action="{{ route('login') }}">
					@csrf
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class=""></i>@</span>
							</div>
							<input id="email" type="email" name="email" class="form-control input_user @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email">
							@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input id="password" type="password" name="password" class="form-control input_pass @error('password') is-invalid @enderror" value="" placeholder="password">
							@error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                                @enderror
						</div>


							<div class="d-flex flex-column justify-content-center mt-3 login_container">
				 	<button type="submit"  class="btn login_btn"> Login</button>
					<a class="btn btn-link" href="{{ route('password.request')}}">
						 Forgot Your Password?
				 </a>
				   </div>

					</form>
				</div>
			
			</div>
		</div>
	</div>
@endsection
