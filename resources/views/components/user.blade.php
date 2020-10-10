<div class="flex items-center text-base rounded-full">
    @if ($user !== null)
        <img class="border-2 border-blue-200 h-8 w-8 rounded-full object-cover" src="{{ $user->profile_photo_url ?? asset('storage/anon.jpg') }}" alt="{{ $user->name }}" />
    @else
        <svg class="border-2 border-blue-200 rounded-full w-8 h-8 p-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
    @endif
    <span class="ml-2 mr-4">
        {{ $user->name ?? 'Anon user' }}
    </span>
</div>
