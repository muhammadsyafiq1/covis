@extends('layouts.app')
    @section('content')
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle wide-md mx-auto">
                        <div class="nk-block-content nk-error-ld text-center">
                            <img class="nk-error-gfx" src="images/gfx/error-504.svg" alt="">
                            <div class="wide-xs mx-auto">
                                <h3 class="nk-error-title">Coming Soon</h3>
                                <p class="nk-error-text">We are very sorry for inconvenience. It looks like the page you're looking for is under construction.</p>
                                <a href="{{ url('dashboard') }}" class="btn btn-lg btn-primary mt-2">Back to Dashboard</a>
                            </div>
                        </div>
                    </div>
                </div>
    @endsection