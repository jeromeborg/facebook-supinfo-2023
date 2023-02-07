@extends('layouts.app')

@section('contents')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center text-white text-2xl font-bold mb-4">
            Promotion: {{ $promotion->name }} ({{ $promotion->year }})
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-around">
                @foreach($promotion->users as $user)
                    @include('partials.user')
                
                @endforeach
            </div>
        </div>
    </div>
@endsection
