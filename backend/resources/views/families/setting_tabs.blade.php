<ul class="nav nav-tabs nav-justified my-2">
    <li class="nav-item">
        <a href="{{ route('users.setting_profile') }}" class="nav-link text-muted {{ $hasUser ? 'active' : '' }}">
            <i class="fas fa-cog mr-1"></i>ユーザ設定
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('families.setting') }}" class="nav-link text-muted {{ $hasFamily ? 'active' : '' }}">
            <i class="fas fa-cogs mr-1"></i>家族設定
        </a>
    </li>
</ul>
