
<div class="position-relative">
    <a class="nav-link" href="{{ route('admin.messages.index') }}">My messages</a>
    @if (count($unread_messages) > 0)
        <div class="num-message">{{ count($unread_messages) }}</div>
    @endif
</div>
