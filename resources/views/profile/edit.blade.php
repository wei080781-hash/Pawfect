    @extends('layouts.member')

    @section('content')

    <div class="space-y-6">

        <!-- Profile Information -->

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

            <div class="max-w-xl">

                @include('profile.partials.update-profile-information-form')

            </div>

        </div>


        <!-- Update Password -->

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

            <div class="max-w-xl">

                @include('profile.partials.update-password-form')

            </div>

        </div>


        <!-- Delete User -->

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

            <div class="max-w-xl">

                @include('profile.partials.delete-user-form')

            </div>

        </div>

    </div>

    @endsection