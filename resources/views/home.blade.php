@extends('layouts.app')

@section('content')
    <div class="home-filter">
        @include('pc.filter')
    </div>
    <div class="container">
        <div class="grid-container">
            @php
                $product = ['cpu', 'motherboard', 'cpu cooler', 'case', 'gpu', 'ram', 'storage', 'case cooler', 'psu', 'os'];
            @endphp
            @foreach ($product as $p)
                <a href="/parttype/{{ $p }}">

                    <div class="grid-item">
                        <div class="component">
                            <span><?php echo $p; ?></span><br>
                            <img src="img/<?php echo $p; ?>.png" alt="" width="300">
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection