<li class="{{ Request::is(config('app.backend') . '/dashboard*') ? 'active' : '' }}">
    <a href="{!! route('dashboard') !!}"><i class="ion ion-speedometer"></i> &nbsp; <span>Dashboard</span></a>
</li>

<li class="{{ Request::is(config('app.backend') . '/sections*') ? 'active' : '' }}">
    <a href="{!! route('sections.index') !!}"><i class="ion ion-ios-albums-outline"></i> &nbsp; <span>Sections</span></a>
</li>

<li class="{{ Request::is(config('app.backend') . '/posts*') ? 'active' : '' }}">
    <a href="{!! route('posts.index') !!}"><i class="ion ion-ios-paper-outline"></i> &nbsp; <span>Posts</span></a>
</li>

<li class="{{ Request::is(config('app.backend') . '/contacts*') ? 'active' : '' }}">
    <a href="{!! route('contacts.index') !!}"><i class="ion ion-paper-airplane"></i> &nbsp; <span>Contacts</span></a>
</li>

<li class="{{ Request::is(config('app.backend') . '/users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="ion ion-ios-person-outline"></i> &nbsp; <span>Users</span></a>
</li>

<li class="{{ Request::is(config('app.backend') . '/localizations*') ? 'active' : '' }}">
    <a href="{!! route('localizations.index') !!}"><i class="ion ion-ios-flag"></i> &nbsp; <span>Localizations</span></a>
</li>

<li class="{{ Request::is(config('app.backend') . '/settings*') ? 'active' : '' }}">
    <a href="{!! route('settings.index') !!}"><i class="ion ion-ios-gear"></i> &nbsp; <span>Settings</span></a>
</li>
