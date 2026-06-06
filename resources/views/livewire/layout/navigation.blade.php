<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

    public function setTheme(string $theme): void
    {
        $this->js("localStorage.setItem('appTheme', '{$theme}'); document.documentElement.setAttribute('data-theme', '{$theme}');");
    }
}; ?>

<nav x-data="{ open: false, darkMode: localStorage.getItem('darkMode') === 'true', appTheme: localStorage.getItem('appTheme') || 'default' }" x-init="$watch('darkMode', val => { localStorage.setItem('darkMode', val); document.documentElement.classList.toggle('dark', val); }); if (darkMode) document.documentElement.classList.add('dark'); $watch('appTheme', val => { localStorage.setItem('appTheme', val); document.documentElement.setAttribute('data-theme', val); }); document.documentElement.setAttribute('data-theme', appTheme);" style="background: var(--crm-panel-bg); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border-bottom: 1px solid var(--crm-border);">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current" style="color: var(--crm-text);" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('leads')" :active="request()->routeIs('leads')" wire:navigate>
                        {{ __('Leads CRM') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contacts')" :active="request()->routeIs('contacts')" wire:navigate>
                        {{ __('Contacts') }}
                    </x-nav-link>
                    <x-nav-link :href="route('grades')" :active="request()->routeIs('grades')" wire:navigate>
                        {{ __('Grades') }}
                    </x-nav-link>
                    <x-nav-link :href="route('subjects')" :active="request()->routeIs('subjects')" wire:navigate>
                        {{ __('Subjects') }}
                    </x-nav-link>
                    <x-nav-link :href="route('sections')" :active="request()->routeIs('sections')" wire:navigate>
                        {{ __('Classes') }}
                    </x-nav-link>
                    <x-nav-link :href="route('grade-subjects')" :active="request()->routeIs('grade-subjects')" wire:navigate>
                        {{ __('Grade Subjects') }}
                    </x-nav-link>
                    <x-nav-link :href="route('stages')" :active="request()->routeIs('stages')" wire:navigate>
                        {{ __('Stages') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-2">
                <button @click="darkMode = !darkMode" type="button" class="inline-flex items-center p-2 rounded-md focus:outline-none transition duration-150 ease-in-out" style="color: var(--crm-text-muted);">
                    <svg x-show="!darkMode" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" /></svg>
                    <svg x-show="darkMode" x-cloak class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.444 5.668A1 1 0 0112 17h-1a1 1 0 110-2h1a3 3 0 00.272-5.92l-.773-1.541A1 1 0 019.093 8H7.782a1 1 0 00-.874 1.49l.717 1.11A5.002 5.002 0 0117 17h1a1 1 0 110 2h-1a7.001 7.001 0 01-.554-2.332z" clip-rule="evenodd" /></svg>
                </button>

                <button @click="appTheme = appTheme === 'natural' ? 'default' : 'natural'" type="button" class="inline-flex items-center px-3 py-2 border text-sm leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150" style="border-color: var(--crm-border); color: var(--crm-text-muted); background: var(--crm-btn-secondary-bg);">
                    Theme
                    <span x-text="appTheme === 'natural' ? '🌿' : '🌞'"></span>
                </button>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border text-sm leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150" style="border-color: var(--crm-border); color: var(--crm-text-muted); background: var(--crm-btn-secondary-bg);">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md transition duration-150 ease-in-out" style="color: var(--crm-text-muted);">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('leads')" :active="request()->routeIs('leads')" wire:navigate>
                {{ __('Leads CRM') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contacts')" :active="request()->routeIs('contacts')" wire:navigate>
                {{ __('Contacts') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('grades')" :active="request()->routeIs('grades')" wire:navigate>
                {{ __('Grades') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('subjects')" :active="request()->routeIs('subjects')" wire:navigate>
                {{ __('Subjects') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('sections')" :active="request()->routeIs('sections')" wire:navigate>
                {{ __('Classes') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('grade-subjects')" :active="request()->routeIs('grade-subjects')" wire:navigate>
                {{ __('Grade Subjects') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('stages')" :active="request()->routeIs('stages')" wire:navigate>
                {{ __('Stages') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1" style="border-top: 1px solid var(--crm-border);">
            <div class="px-4">
                <div class="font-medium text-base" style="color: var(--crm-text);" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm" style="color: var(--crm-text-muted);">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
