<div class="p-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 mb-4 shadow-sm sm:rounded-lg w-64 mx-2 box-border">
    <p class="mb-2"><img src='{{ asset('storage/images/'. $user->avatar) }}' alt='{{ $user->name }}'></p>
    <p class="font-bold">{{ $user->firstname }} {{ $user->name }}<p>
    <p>{{ $user->email }}</p>
    @if(auth()->check() && auth()->user()->id === $user->id)
    <p class='py-4'>
    	<a href='{{ route('profile.edit', ['id' => $user->id ]) }}' class='inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150' title='edit'>Edit</a>
    </p>
    @endif
</div>