@extends('layouts.app')

@section('content')
<section class="page-section" id="login">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header bg-warning text-white text-center">
                        <h3 class="font-weight-bold">Login</h3>
                    </div>
                    <div class="card-body">
                        <!-- Pesan error general dari session -->
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('login.process') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Masukkan Username" required autofocus>
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan Password" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-warning btn-block text-uppercase">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <small class="text-muted">Masukkan username dan password Anda untuk melanjutkan</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
