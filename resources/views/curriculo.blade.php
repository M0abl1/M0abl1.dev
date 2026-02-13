@extends('layouts.site')

@section('content')

    @include('partials.header')

    <main id="conteudo-principal" class="container mx-auto p-5 md:p-10 max-w-6xl focus:outline-none" tabindex="-1">
        
        @include('partials.hero')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="col-span-1 lg:col-span-2 order-2 lg:order-1">
                @include('partials.skills')
            </div>

            <div class="col-span-1 order-1 lg:order-2">
                @include('partials.education')
            </div>
            
        </div>
    </main>

@endsection