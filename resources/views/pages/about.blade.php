@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-darkLaravel">
                    <div class="card-header">{{ __('About') }}</div>

                    <div class="card-body">
                        <p>Welcome to Game PC, the ultimate destination for building your dream gaming PC. Whether
                            you're a seasoned gamer or just starting out, we've got everything you need to build the
                            perfect rig.</p>
                        <p>Our website is designed to make the process of building a PC as easy and stress-free as
                            possible. You can browse through a wide range of components, from CPUs and GPUs to
                            motherboards and memory, and select the parts that best suit your needs and budget.</p>
                        <p>We understand that not everyone has the time or expertise to build a PC from scratch, which
                            is why we also offer the option to order a non-completed build. This way, you can use your
                            existing components and we'll take care of the rest.</p>
                        <p>We pride ourselves on offering only the highest quality components from the most reputable
                            brands in the industry. All of our products are rigorously tested and come with a warranty,
                            giving you peace of mind when making your purchase.</p>
                        <p>At Game PC, we're passionate about gaming and committed to helping you build the ultimate
                            gaming experience. Thank you for choosing us as your go-to PC builder.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection