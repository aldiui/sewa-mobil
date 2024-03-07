@extends('layouts.app')

@section('title', 'Beranda')

@push('style')
@endpush

@section('main')
    <div class="main-content text-dark">
        <div class="section">
            <div class="row justify-content-center align-items-center flex-column-reverse flex-lg-row py-5">
                <div class="col-lg-6 mb-3">
                    <div class="h3">Selamat Datang di <span class="font-weight-bold">{{ config('app.name') }}</span></div>
                    <p class="mb-3">CarEase, solusi terkemuka dalam perjalanan kendaraan Anda. Dengan teknologi canggih dan
                        layanan yang
                        responsif, kami menyediakan kenyamanan dan keamanan bagi pelanggan kami di setiap langkah. Nikmati
                        pengalaman berkendara yang tanpa hambatan dengan CarEase, di mana segala sesuatunya dirancang untuk
                        memenuhi kebutuhan Anda.</p>
                    <a href="{{ route('sewa-mobil.index') }}" class="btn btn-primary">Mulai Sewa Mobil</a>
                </div>
                <div class="col-lg-6 mb-3">
                    <img src="{{ asset('img/home.png') }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
        <section>
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-shield-alt custom-size-icon mb-3"></i>
                            <h5 class="card-title">Keamanan</h5>
                            <p class="card-text">Kami memprioritaskan keamanan sebagai yang utama. Dengan teknologi
                                terkini, Anda dapat merasa aman di setiap perjalanan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-car custom-size-icon mb-3"></i>
                            <h5 class="card-title">Kenyamanan</h5>
                            <p class="card-text">Pengalaman berkendara yang nyaman adalah salah satu dari banyak
                                keunggulan yang kami tawarkan kepada pelanggan kami.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-clock custom-size-icon mb-3"></i>
                            <h5 class="card-title">Ketepatan Waktu</h5>
                            <p class="card-text">Kami memahami pentingnya waktu Anda. Layanan kami selalu tepat waktu
                                untuk memastikan kepuasan pelanggan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-cogs custom-size-icon mb-3"></i>
                            <h5 class="card-title">Kemudahan</h5>
                            <p class="card-text">Mudah digunakan dan diakses, layanan kami dirancang untuk memberikan
                                kemudahan dalam penggunaan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
