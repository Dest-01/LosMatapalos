<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>  
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
<div class="limiter">
		<div class="container-login100"  style="">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/logo2.png" alt="IMG">
				</div>
				<form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
				    @csrf
					<span class="login100-form-title">
					    {{ __('Administrador') }}
					</span>
					<div class="wrap-input100 validate-input">
						<input id="email" class="input100 form-control @error('email') is-invalid @enderror" type="text" name="email" placeholder="Email" value="{{ old('email') }}" >
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
						@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
					</div>
					<div class="wrap-input100 validate-input">
						<input id="password"  type="password" class="input100 form-control @error('password') is-invalid @enderror" name="password"  placeholder="Contraseña" >
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
						@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
					</div>			
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Entrar
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Olvido
						</span>
						<a class="txt2" href="#">
							Usuario / Contraseña?
						</a>
					</div>

					<div class="text-center p-t-136">
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.0.3/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
           scale: 1.2
        })
    </script>
</body>
</html>
