@extends('layouts.app')

@section('contents')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden ">
                @foreach($promotions as $promotion)
                <div class="p-6 bg-white dark:bg-gray-800  text-gray-900 dark:text-gray-100 mb-4 shadow-sm sm:rounded-lg">
                    <a href='{{ route('promotion.show', $promotion) }}' title='{{ $promotion->name }}'>{{ $promotion->name }} - ({{ $promotion->year }}) {{ $promotion->users_count }} students</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
