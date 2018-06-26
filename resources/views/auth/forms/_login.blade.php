<form action="{{ route('login') }}" method="POST">

    @csrf

    <div class="card-body">

        <!-- Email -->
        <div class="form-group row">
            <label for="email" class="form-control-label font-semibold">E-Mail Address</label>
            <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}" />

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    `
        <!-- Password -->
        <div class="form-group row">
            <label for="password" class="form-control-label font-semibold">Password</label>
            <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" />

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group row">
            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
            </label>
        </div>
    </div>

    <!-- Buttons -->
    <div class="row">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary btn-indigo focus:bg-indigo-dark">
                Login
            </button>
        </div>

        <div class="col-md-6">
            <a class="btn btn-link" href="{{ route('password.request') }}">
                <span class="font-semibold text-uppercase">Forgot password?</span>
            </a>
        </div>
    </div>

</form>