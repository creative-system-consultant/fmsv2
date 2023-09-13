@section('title', 'Sign in to your account')

<div>
    <form wire:submit.prevent="authenticate">
        <div>
            <x-input
                wire:model.defer="email"
                id="email"
                name="email"
                type="email"
                icon="user"
                placeholder="Email"
            />
        </div>

        <div class="mt-6">
            <x-inputs.password
                wire:model.defer="password"
                id="password"
                type="password"
                placeholder="Password"
            />
        </div>

        <div class="flex items-center justify-between mt-6">
            <div class="flex items-center">
                <x-checkbox wire:model.defer="remember" id="remember" class="w-4 h-4 transition duration-150 " />
                <label for="remember" class="block ml-2 text-sm leading-5 text-gray-900 dark:text-gray-200">
                    Remember
                </label>
            </div>

            <div class="text-sm leading-5">
                <a  href="{{ route('password.request') }}" class="font-medium transition duration-150 ease-in-out text-primary-600 hover:text-primary-500 focus:outline-none focus:underline">
                    Forgot your password?
                </a>
            </div>
        </div>

        <div class="mt-10">
            <span class="block w-full rounded-md shadow-sm">
                <x-button
                    type="submit"
                    primary
                    label="Sign in"
                    class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out "
                />
            </span>
        </div>
    </form>
</div>
