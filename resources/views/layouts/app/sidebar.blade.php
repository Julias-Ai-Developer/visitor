<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-[#f3f5f7] text-zinc-900 antialiased dark:bg-zinc-950 dark:text-zinc-100">
        @php
            $visitorNavItems = [
                [
                    'label' => __('Dashboard'),
                    'icon' => 'squares-2x2',
                    'href' => route('dashboard'),
                    'active' => request()->routeIs('dashboard'),
                    'navigate' => true,
                ],
                [
                    'label' => __('Add New Visitor'),
                    'icon' => 'user-plus',
                    'href' => url('/visitors/create'),
                    'active' => request()->is('visitors/create'),
                    'navigate' => false,
                ],
                [
                    'label' => __('Visitor List'),
                    'icon' => 'calendar-days',
                    'href' => url('/visitors'),
                    'active' => request()->is('visitors'),
                    'navigate' => false,
                ],
                [
                    'label' => __('Report'),
                    'icon' => 'chart-bar-square',
                    'href' => url('/reports'),
                    'active' => request()->is('reports*'),
                    'navigate' => false,
                ],
                [
                    'label' => __('Notifications'),
                    'icon' => 'bell',
                    'href' => url('/notifications'),
                    'active' => request()->is('notifications*'),
                    'navigate' => false,
                ],
                [
                    'label' => __('Setting'),
                    'icon' => 'cog-6-tooth',
                    'href' => route('profile.edit'),
                    'active' => request()->is('settings*'),
                    'navigate' => true,
                ],
            ];
        @endphp

        <flux:sidebar sticky collapsible="mobile" class="visitor-sidebar border-0 bg-[#315f66] px-4 py-5 text-white lg:w-[242px]">
            <flux:sidebar.header class="mb-7 flex items-center justify-center p-0">
                <a href="{{ route('dashboard') }}" class="text-[32px] font-extrabold italic leading-none tracking-normal text-white" wire:navigate>
                    visitor
                </a>
                <flux:sidebar.collapse class="absolute right-3 top-4 text-white lg:hidden" />
            </flux:sidebar.header>

            <nav class="grid gap-2" aria-label="{{ __('Visitor management') }}">
                @foreach ($visitorNavItems as $item)
                    <a
                        href="{{ $item['href'] }}"
                        @if ($item['navigate']) wire:navigate @endif
                        @class([
                            'flex h-10 items-center gap-4 rounded-md px-4 text-[15px] font-bold leading-none transition',
                            'bg-white text-[#315f66] shadow-sm' => $item['active'],
                            'text-white hover:bg-white/10' => ! $item['active'],
                        ])
                    >
                        <flux:icon :name="$item['icon']" class="size-5 shrink-0" />
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach

            </nav>

            <flux:spacer />

            <x-desktop-user-menu class="visitor-user-menu hidden lg:block" :name="auth()->user()->name" />
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="border-b border-[#315f66]/20 bg-white lg:hidden">
            <flux:sidebar.toggle class="lg:hidden text-[#315f66]" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar
                                    :name="auth()->user()->name"
                                    :initials="auth()->user()->initials()"
                                />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                            {{ __('Settings') }}
                        </flux:menu.item>
                        <flux:menu.item :href="route('appearance.edit')" icon="moon" wire:navigate>
                            {{ __('Appearance') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item
                            as="button"
                            type="submit"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer"
                            data-test="logout-button"
                        >
                            {{ __('Log out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
