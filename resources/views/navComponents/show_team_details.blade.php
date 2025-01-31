<div class="container-fluid container-xxl" >
    <div class="container-fluid d-flex justify-content-center align-content-stretch" style="height: 18.75rem">
        @if (!empty($user->profile_picture))
            <img src="{{ route('profile_picture', ['filename' => $user->profile_picture]) }}" alt="Image" class="custom-img rounded p-1">
        @else
            <img src="{{ asset('images/avatars/01.png') }}" alt="User-Profile" class="custom-img rounded p-1">
        @endif
    </div>
    <p><strong>Name: </strong> {{ $user->full_name }}</p>
    <p><strong>Position: </strong> {{ $user->userProfile->titles ?? 'N/A'}}</p>
    <p style="text-align: justify !important;"><strong>Description: </strong> {{ $user->userProfile->description ?? 'N/A'}}</p>
</div>
<style>
    .custom-img {
        width: 27.5rem;
        height: 18.75rem !important;
    }

    @media (max-width: 576px) {
        .custom-img {
            width: 25.5rem !important;
        }
    }

    @media (max-width: 435px) {
        .custom-img {
            width: 20rem !important;
        }
    }
</style>
