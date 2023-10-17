<x-guest-layout>
<form method="POST" class="flex flex-col gap-4">
    @csrf

    <input type="hidden" name="email" value="{{ $user->email }}"/>

    <div>
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Password') }}</label>

        <div>
            <input id="password" type="password" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 text-xs focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 @error('password') border-red-700 @enderror"
                   name="password" required autocomplete="new-password">

            @error('password')
            <span>
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div>
        <label for="password-confirm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Confirm Password') }}</label>

        <div>
            <input id="password-confirm" type="password" name="password_confirmation" required
                   autocomplete="new-password" class="block w-full p-2 text-gray-900 border border-gray-300 rounded bg-gray-50 text-xs focus:ring-gray-500 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500">
        </div>
    </div>

    <div>
        <button type="submit" class="inline-flex items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded px-3 py-2 text-xs dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
            {{ __('Save password and login') }}
        </button>
    </div>
</form>
</x-guest-layout>
