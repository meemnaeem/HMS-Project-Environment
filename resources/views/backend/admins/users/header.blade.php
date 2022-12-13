<ul class="nav nav-tabs nav-tabs-solid mb-2 mt-2 bg-white" id="myHeader">
    @foreach (App\Custom\Helper::getRoles() as $key => $role)
        <li class="nav-item">
            <a href="#" wire:click.prevent="getUserDataByRole('{{ $role->name }}')"
                class="nav-link {{ Str::lower($role->name) == $currentUrl ? 'active' : '' }}">
                {{-- @dd($currentUrl, $role->name) --}}
                {{ Str::upper(str_replace('-', ' ', $role->name)) }}
            </a>
        </li>
    @endforeach
</ul>
