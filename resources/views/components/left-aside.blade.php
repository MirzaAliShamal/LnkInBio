<div class="aside-logo">
    <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid" alt="Logo">
</div>

<div class="aside-menu">
    <ul>
        <li><a href="{{ route('dashboard.link.list') }}">Links</a></li>
        <li><a href="{{ route('dashboard.appearence.list') }}">Appearence</a></li>
        <li><a href="">Settings</a></li>
        <li><a href="">Pro</a></li>
        <li><a href="">Support</a></li>
        <li><a href="">Notifications</a></li>
    </ul>
</div>

<div class="aside-avatar">
    <div class="image-outer">
        <img src="{{ asset(auth()->user()->avatar) }}" class="img-fluid" alt="Logo">
    </div>
    <p>{{ auth()->user()->name }}</p>
</div>
