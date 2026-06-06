<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
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

@php
$userRole = auth()->user()->role;
$allowedSections = match($userRole) {
    'hr' => ['hr'],
    'student_affairs' => ['students'],
    'academic' => ['academic'],
    'control' => ['control'],
    default => ['students', 'hr', 'academic', 'control', 'admin'],
};
$currentSection = match(true) {
    request()->routeIs('subjects') || request()->routeIs('grade-subjects') => in_array('academic', $allowedSections) ? 'academic' : $allowedSections[0],
    request('categories') === 'Student,Parent' => in_array('students', $allowedSections) ? 'students' : $allowedSections[0],
    request('categories') === 'Employee' => in_array('hr', $allowedSections) ? 'hr' : $allowedSections[0],
    request('categories') === 'Student' => in_array('academic', $allowedSections) ? 'academic' : $allowedSections[0],
    request()->routeIs('students*') => in_array('control', $allowedSections) ? 'control' : (in_array('students', $allowedSections) ? 'students' : $allowedSections[0]),
    request()->routeIs('dashboard') || request()->routeIs('schools') || request()->routeIs('users*') || request()->routeIs('sections') || request()->routeIs('stages') || request()->routeIs('grades') || (request()->routeIs('leads') && !request('categories')) || (request()->routeIs('contacts') && !request('categories')) => in_array('admin', $allowedSections) ? 'admin' : $allowedSections[0],
    default => $allowedSections[0],
};
@endphp

<nav      x-data="{ open: false, darkMode: localStorage.getItem('darkMode') === 'true', appTheme: localStorage.getItem('appTheme') || 'default', activeSection: '{{ $currentSection }}', switchSection(section) { this.activeSection = section; } }"
     x-init="$watch('darkMode', val => { localStorage.setItem('darkMode', val); document.documentElement.classList.toggle('dark', val); }); if (darkMode) document.documentElement.classList.add('dark'); $watch('appTheme', val => { localStorage.setItem('appTheme', val); document.documentElement.setAttribute('data-theme', val); }); document.documentElement.setAttribute('data-theme', appTheme);"
     style="position: sticky; top: 0; z-index: 99999; background: var(--crm-panel-bg); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border-bottom: 1px solid var(--crm-border);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div style="display: grid; grid-template-columns: 1fr auto 1fr; align-items: center; height: 4rem;">
            <div class="shrink-0 flex items-center">
                <a href="{{ url('/') }}" wire:navigate style="display: flex; align-items: center; gap: 0.5rem; text-decoration: none;">
                    @if(\App\Models\School::first()?->logo)
                        <img src="{{ \App\Models\School::first()->logo }}" alt="{{ \App\Models\School::first()->nameEn }}" style="height: 2.25rem; width: auto; border-radius: 0.375rem;">
                    @else
                        <x-application-logo class="block h-9 w-auto fill-current" style="color: var(--crm-text);" />
                    @endif
                </a>
            </div>

            <div class="hidden sm:flex sm:items-center sm:justify-center sm:gap-1">
                    @if(in_array('students', $allowedSections))
                    <button @click="switchSection('students')"
                            class="inline-flex items-center px-3 py-2 text-sm rounded-md transition duration-150 ease-in-out"
                            :class="activeSection === 'students' ? 'font-bold shadow-md bg-gray-200/80 dark:bg-gray-700/80 text-[#361d03] underline decoration-2 decoration-yellow-400 underline-offset-4' : 'font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
                            style="background: none; border: none; cursor: pointer;">
                        Students Affairs <svg class="ms-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </button>
                    @endif
                    @if(in_array('hr', $allowedSections))
                    <button @click="switchSection('hr')"
                            class="inline-flex items-center px-3 py-2 text-sm rounded-md transition duration-150 ease-in-out"
                            :class="activeSection === 'hr' ? 'font-bold shadow-md bg-gray-200/80 dark:bg-gray-700/80 text-[#361d03] underline decoration-2 decoration-yellow-400 underline-offset-4' : 'font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
                            style="background: none; border: none; cursor: pointer;">
                        HR <svg class="ms-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </button>
                    @endif
                    @if(in_array('academic', $allowedSections))
                    <button @click="switchSection('academic')"
                            class="inline-flex items-center px-3 py-2 text-sm rounded-md transition duration-150 ease-in-out"
                            :class="activeSection === 'academic' ? 'font-bold shadow-md bg-gray-200/80 dark:bg-gray-700/80 text-[#361d03] underline decoration-2 decoration-yellow-400 underline-offset-4' : 'font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
                            style="background: none; border: none; cursor: pointer;">
                        Academic <svg class="ms-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </button>
                    @endif
                    @if(in_array('control', $allowedSections))
                    <button @click="switchSection('control')"
                            class="inline-flex items-center px-3 py-2 text-sm rounded-md transition duration-150 ease-in-out"
                            :class="activeSection === 'control' ? 'font-bold shadow-md bg-gray-200/80 dark:bg-gray-700/80 text-[#361d03] underline decoration-2 decoration-yellow-400 underline-offset-4' : 'font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
                            style="background: none; border: none; cursor: pointer;">
                        Control <svg class="ms-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </button>
                    @endif
                    @if(in_array('admin', $allowedSections))
                    <button @click="switchSection('admin')"
                            class="inline-flex items-center px-3 py-2 text-sm rounded-md transition duration-150 ease-in-out"
                            :class="activeSection === 'admin' ? 'font-bold shadow-md bg-gray-200/80 dark:bg-gray-700/80 text-[#361d03] underline decoration-2 decoration-yellow-400 underline-offset-4' : 'font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
                            style="background: none; border: none; cursor: pointer;">
                        Administrator <svg class="ms-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </button>
                    @endif
                </div>

            <div class="hidden sm:flex sm:items-center sm:justify-end sm:ms-6 gap-2">
                <button @click="darkMode = !darkMode" type="button" class="inline-flex items-center p-2 rounded-md focus:outline-none transition duration-150 ease-in-out" style="color: var(--crm-text-muted);">
                    <svg x-show="!darkMode" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" /></svg>
                    <svg x-show="darkMode" x-cloak class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.444 5.668A1 1 0 0112 17h-1a1 1 0 110-2h1a3 3 0 00.272-5.92l-.773-1.541A1 1 0 019.093 8H7.782a1 1 0 00-.874 1.49l.717 1.11A5.002 5.002 0 0117 17h1a1 1 0 110 2h-1a7.001 7.001 0 01-.554-2.332z" clip-rule="evenodd" /></svg>
                </button>
                <button @click="appTheme = appTheme === 'natural' ? 'default' : 'natural'" type="button" class="inline-flex items-center px-3 py-2 border text-sm leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150" style="border-color: var(--crm-border); color: var(--crm-text-muted); background: var(--crm-btn-secondary-bg);">
                    Theme <span x-text="appTheme === 'natural' ? '🌿' : '🌞'"></span>
                </button>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border text-sm leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150" style="border-color: var(--crm-border); color: var(--crm-text-muted); background: var(--crm-btn-secondary-bg);">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                            <div class="ms-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>{{ __('Profile') }}</x-dropdown-link>
                        <button wire:click="logout" class="w-full text-start"><x-dropdown-link>{{ __('Log Out') }}</x-dropdown-link></button>
                    </x-slot>
                </x-dropdown>
            </div>

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

    {{-- Subnavbar --}}
    <div style="position: sticky; top: 4rem; z-index: 9998; border-bottom: 1px solid var(--crm-border); background: var(--crm-dropdown-bg, #ffffff); overflow: hidden;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div style="position: relative; min-height: 2.75rem;">

                {{-- Students Affairs subnav --}}
                @if(in_array('students', $allowedSections))
                <div x-show="activeSection === 'students'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     style="position: absolute; inset: 0;">
                    <div style="display: flex; justify-content: center; align-items: center; width: 100%; height: 100%;">
                        <div class="flex items-center gap-1">
                            <a href="{{ route('leads', ['categories' => 'Student,Parent']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->fullUrlIs('*leads*') && request('categories') === 'Student,Parent', 'text-gray-600 dark:text-gray-300' => !(request()->fullUrlIs('*leads*') && request('categories') === 'Student,Parent')]) style="background: var(--crm-btn-secondary-bg, transparent);">Leads</a>
                            <a href="{{ route('contacts', ['categories' => 'Student,Parent']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->fullUrlIs('*contacts*') && request('categories') === 'Student,Parent', 'text-gray-600 dark:text-gray-300' => !(request()->fullUrlIs('*contacts*') && request('categories') === 'Student,Parent')]) style="background: var(--crm-btn-secondary-bg, transparent);">Contacts</a>
                            <span style="width: 1px; height: 1.25rem; background: var(--crm-divider, #e5e7eb); margin: 0 0.5rem;"></span>
                            <a href="{{ route('students') }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('students'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('students')]) style="background: var(--crm-btn-secondary-bg, transparent);">Students</a>
                            <a href="{{ route('stages') }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('stages'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('stages')]) style="background: var(--crm-btn-secondary-bg, transparent);">Stages</a>
                            <a href="{{ route('grades') }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('grades'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('grades')]) style="background: var(--crm-btn-secondary-bg, transparent);">Grades</a>
                        </div>
                    </div>
                </div>
                @endif

                {{-- HR subnav --}}
                @if(in_array('hr', $allowedSections))
                <div x-show="activeSection === 'hr'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     style="position: absolute; inset: 0;">
                    <div style="display: flex; justify-content: center; align-items: center; width: 100%; height: 100%;">
                        <div class="flex items-center gap-1">
                            <a href="{{ route('leads', ['categories' => 'Employee']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->fullUrlIs('*leads*') && request('categories') === 'Employee', 'text-gray-600 dark:text-gray-300' => !(request()->fullUrlIs('*leads*') && request('categories') === 'Employee')]) style="background: var(--crm-btn-secondary-bg, transparent);">Leads</a>
                            <a href="{{ route('contacts', ['categories' => 'Employee']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->fullUrlIs('*contacts*') && request('categories') === 'Employee', 'text-gray-600 dark:text-gray-300' => !(request()->fullUrlIs('*contacts*') && request('categories') === 'Employee')]) style="background: var(--crm-btn-secondary-bg, transparent);">Contacts</a>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Academic subnav --}}
                @if(in_array('academic', $allowedSections))
                <div x-show="activeSection === 'academic'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     style="position: absolute; inset: 0;">
                    <div style="display: flex; justify-content: center; align-items: center; width: 100%; height: 100%;">
                        <div class="flex items-center gap-1">
                            <a href="{{ route('contacts', ['categories' => 'Student']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->fullUrlIs('*contacts*') && request('categories') === 'Student', 'text-gray-600 dark:text-gray-300' => !(request()->fullUrlIs('*contacts*') && request('categories') === 'Student')]) style="background: var(--crm-btn-secondary-bg, transparent);">Contacts</a>
                            <span style="width: 1px; height: 1.25rem; background: var(--crm-divider, #e5e7eb); margin: 0 0.5rem;"></span>
                            <a href="{{ route('stages') }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('stages'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('stages')]) style="background: var(--crm-btn-secondary-bg, transparent);">Stages</a>
                            <a href="{{ route('grades') }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('grades'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('grades')]) style="background: var(--crm-btn-secondary-bg, transparent);">Grades</a>
                            <a href="{{ route('subjects') }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('subjects'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('subjects')]) style="background: var(--crm-btn-secondary-bg, transparent);">Subjects</a>
                            <a href="{{ route('grade-subjects') }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('grade-subjects'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('grade-subjects')]) style="background: var(--crm-btn-secondary-bg, transparent);">Grade Subjects</a>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Control subnav --}}
                @if(in_array('control', $allowedSections))
                <div x-show="activeSection === 'control'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     style="position: absolute; inset: 0;">
                    <div style="display: flex; justify-content: center; align-items: center; width: 100%; height: 100%;">
                        <div class="flex items-center gap-1">
                            <a href="{{ route('students') }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('students'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('students')]) style="background: var(--crm-btn-secondary-bg, transparent);">Students</a>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Administrator subnav --}}
                @if(in_array('admin', $allowedSections))
                <div x-show="activeSection === 'admin'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     style="position: absolute; inset: 0;">
                    <div style="display: flex; justify-content: center; align-items: center; width: 100%; height: 100%;">
                        <div class="flex items-center gap-1">
                            <a href="{{ route('dashboard') }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('dashboard'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('dashboard')]) style="background: var(--crm-btn-secondary-bg, transparent);">Dashboard</a>
                            <span style="width: 1px; height: 1.25rem; background: var(--crm-divider, #e5e7eb); margin: 0 0.5rem;"></span>
                            <a href="{{ route('leads') }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('leads') && !request('categories'), 'text-gray-600 dark:text-gray-300' => !(request()->routeIs('leads') && !request('categories'))]) style="background: var(--crm-btn-secondary-bg, transparent);">Leads</a>
                            <a href="{{ route('contacts') }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('contacts') && !request('categories'), 'text-gray-600 dark:text-gray-300' => !(request()->routeIs('contacts') && !request('categories'))]) style="background: var(--crm-btn-secondary-bg, transparent);">Contacts</a>
                            <span style="width: 1px; height: 1.25rem; background: var(--crm-divider, #e5e7eb); margin: 0 0.5rem;"></span>
                            <a href="{{ route('stages') }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('stages'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('stages')]) style="background: var(--crm-btn-secondary-bg, transparent);">Stages</a>
                            <a href="{{ route('grades') }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('grades'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('grades')]) style="background: var(--crm-btn-secondary-bg, transparent);">Grades</a>
                            <a href="{{ route('subjects') }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('subjects'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('subjects')]) style="background: var(--crm-btn-secondary-bg, transparent);">Subjects</a>
                            <a href="{{ route('grade-subjects') }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('grade-subjects'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('grade-subjects')]) style="background: var(--crm-btn-secondary-bg, transparent);">Grade Subjects</a>
                            <a href="{{ route('sections') }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('sections'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('sections')]) style="background: var(--crm-btn-secondary-bg, transparent);">Classes</a>
                            <span style="width: 1px; height: 1.25rem; background: var(--crm-divider, #e5e7eb); margin: 0 0.5rem;"></span>
                            <a href="{{ route('users') }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('users'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('users')]) style="background: var(--crm-btn-secondary-bg, transparent);">Users</a>
                            <a href="{{ route('schools') }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('schools'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('schools')]) style="background: var(--crm-btn-secondary-bg, transparent);">School</a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(in_array('students', $allowedSections))
            <div style="border-bottom: 1px solid var(--crm-divider, #e5e7eb); padding: 0.25rem 0;">
                <div class="px-4 py-1 text-xs font-semibold uppercase tracking-wider" style="color: var(--crm-text-muted, #6b7280);">Students Affairs</div>
                <x-responsive-nav-link :href="route('leads', ['categories' => 'Student,Parent'])" :active="request()->fullUrlIs('*leads*') && request('categories') === 'Student,Parent'" wire:navigate>Leads</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('contacts', ['categories' => 'Student,Parent'])" :active="request()->fullUrlIs('*contacts*') && request('categories') === 'Student,Parent'" wire:navigate>Contacts</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('students')" :active="request()->routeIs('students')" wire:navigate>Students</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('stages')" :active="request()->routeIs('stages')" wire:navigate>Stages</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('grades')" :active="request()->routeIs('grades')" wire:navigate>Grades</x-responsive-nav-link>
            </div>
            @endif
            @if(in_array('hr', $allowedSections))
            <div style="border-bottom: 1px solid var(--crm-divider, #e5e7eb); padding: 0.25rem 0;">
                <div class="px-4 py-1 text-xs font-semibold uppercase tracking-wider" style="color: var(--crm-text-muted, #6b7280);">HR</div>
                <x-responsive-nav-link :href="route('leads', ['categories' => 'Employee'])" :active="request()->fullUrlIs('*leads*') && request('categories') === 'Employee'" wire:navigate>Leads</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('contacts', ['categories' => 'Employee'])" :active="request()->fullUrlIs('*contacts*') && request('categories') === 'Employee'" wire:navigate>Contacts</x-responsive-nav-link>
            </div>
            @endif
            @if(in_array('academic', $allowedSections))
            <div style="border-bottom: 1px solid var(--crm-divider, #e5e7eb); padding: 0.25rem 0;">
                <div class="px-4 py-1 text-xs font-semibold uppercase tracking-wider" style="color: var(--crm-text-muted, #6b7280);">Academic</div>
                <x-responsive-nav-link :href="route('contacts', ['categories' => 'Student'])" :active="request()->fullUrlIs('*contacts*') && request('categories') === 'Student'" wire:navigate>Contacts</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('stages')" :active="request()->routeIs('stages')" wire:navigate>Stages</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('grades')" :active="request()->routeIs('grades')" wire:navigate>Grades</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('subjects')" :active="request()->routeIs('subjects')" wire:navigate>Subjects</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('grade-subjects')" :active="request()->routeIs('grade-subjects')" wire:navigate>Grade Subjects</x-responsive-nav-link>
            </div>
            @endif
            @if(in_array('control', $allowedSections))
            <div style="border-bottom: 1px solid var(--crm-divider, #e5e7eb); padding: 0.25rem 0;">
                <div class="px-4 py-1 text-xs font-semibold uppercase tracking-wider" style="color: var(--crm-text-muted, #6b7280);">Control</div>
                <x-responsive-nav-link :href="route('students')" :active="request()->routeIs('students')" wire:navigate>Students</x-responsive-nav-link>
            </div>
            @endif
            @if(in_array('admin', $allowedSections))
            <div style="padding: 0.25rem 0;">
                <div class="px-4 py-1 text-xs font-semibold uppercase tracking-wider" style="color: var(--crm-text-muted, #6b7280);">Administrator</div>
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>Dashboard</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('leads')" :active="request()->routeIs('leads')" wire:navigate>Leads</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('contacts')" :active="request()->routeIs('contacts')" wire:navigate>Contacts</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('stages')" :active="request()->routeIs('stages')" wire:navigate>Stages</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('grades')" :active="request()->routeIs('grades')" wire:navigate>Grades</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('subjects')" :active="request()->routeIs('subjects')" wire:navigate>Subjects</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('grade-subjects')" :active="request()->routeIs('grade-subjects')" wire:navigate>Grade Subjects</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('sections')" :active="request()->routeIs('sections')" wire:navigate>Classes</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('users')" :active="request()->routeIs('users')" wire:navigate>Users</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('schools')" :active="request()->routeIs('schools')" wire:navigate>School</x-responsive-nav-link>
            </div>
            @endif
        </div>
        <div class="pt-4 pb-1" style="border-top: 1px solid var(--crm-border);">
            <div class="px-4">
                <div class="font-medium text-base" style="color: var(--crm-text);" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm" style="color: var(--crm-text-muted);">{{ auth()->user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>{{ __('Profile') }}</x-responsive-nav-link>
                <button wire:click="logout" class="w-full text-start"><x-responsive-nav-link>{{ __('Log Out') }}</x-responsive-nav-link></button>
            </div>
        </div>
    </div>
</nav>