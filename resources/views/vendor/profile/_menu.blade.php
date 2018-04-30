<div class="list-group">
    <a href="{{ route('profile') }}" class="list-group-item {{ Request::is('profile') ? 'active' : '' }}">Contact Info</a>
    <a href="{{ route('profile.security') }}"
       class="list-group-item {{ Request::is('profile/security') ? 'active' : '' }}">Security</a>
    <a href="{{ route('profile.delete.show') }}" class="list-group-item {{ Request::is('profile/delete-account') ? 'list-group-item-danger active' : '' }}">Delete
        Account</a>
</div>