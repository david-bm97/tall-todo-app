<div class="mb-2 shadow-lg navbar bg-neutral text-neutral-content rounded-box">
    <div class="flex-1 px-2 mx-2">
        <span class="text-lg font-bold">
            {{ config('app.name') }}
        </span>
    </div>
    <div class="flex space-x-2">
        <button x-data="themeToggle()" data-set-theme="cyberpunk" class="btn btn-square btn-ghost" @click="toggle">
            <x-heroicon-o-light-bulb x-show="currentTheme === 'dark'" class="w-6 h-6"/>
            <x-heroicon-o-moon x-show="currentTheme === 'light'" class="w-6 h-6"/>
        </button>
        <div class="flex-none">
            <div class="dropdown">
                <div tabindex="0" class="m-1 btn">{{ auth()->user()->email }}</div>
                <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box">
                    <li>
                        <a href="{{ route('logout') }}">Logout</a>
                    </li> 
                </ul>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        function themeToggle() {
            return {
                currentTheme: 'dark',
                toggle() {
                    this.currentTheme = this.currentTheme === 'dark' ? 'light' : 'dark'
                    setTheme(this.currentTheme)
                }
            }
        }
    </script>
@endpush
