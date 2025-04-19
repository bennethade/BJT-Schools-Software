@extends('layouts.app')

{{-- @section('title', 'Server Error') --}}

@section('content')

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div style="text-align: center; margin-top: 50px;">
                        <h1 style="font-size: 60px; color: #E74C3C;">500</h1>
                        <h2>Oops! Something went wrong on your end.</h2>
                        <h4 style="color: red">There is probably no score entered for this particular child for the class you chose</h4>
                        <p>Kindly go back, choose the right class and term for this child and proceed</p>
                        {{-- <a href="{{ url('/') }}" style="text-decoration: none; color: #3498DB;">Go back to Homepage</a> --}}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
