<?php
// ============================================================
// Role-based navigation Volt component
// Renders section tabs controlled by $allowedSections per role
// ============================================================

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/');
    }

    public function setTheme(string $theme): void
    {
        $this->js("localStorage.setItem('appTheme', '{$theme}'); document.documentElement.setAttribute('data-theme', '{$theme}');");
    }
}; ?>

@php
$user = auth()->user();
$userRole = $user?->role ?? '';
$allowedSections = $user
    ? match($userRole) {
        'hr' => ['hr'],
        'student_affairs' => ['students'],
        'academic' => ['academic'],
        'control' => ['control'],
        'parent' => ['parent'],
        'guest' => ['students'],
        default => ['students', 'hr', 'academic', 'control', 'admin'],
    }
    : [];
$currentSection = !$allowedSections ? '' : (request('section') && in_array(request('section'), $allowedSections) ? request('section') : match(true) {
    request()->routeIs('subjects') || request()->routeIs('grade-subjects') => in_array('academic', $allowedSections) ? 'academic' : $allowedSections[0],
    request('categories') === 'Student,Parent' => in_array('students', $allowedSections) ? 'students' : $allowedSections[0],
    request('categories') === 'Employee' => in_array('hr', $allowedSections) ? 'hr' : $allowedSections[0],
    request('categories') === 'Student' => in_array('academic', $allowedSections) ? 'academic' : $allowedSections[0],
    request()->routeIs('attendance*') || request()->routeIs('exams*') || request()->routeIs('student-degrees') => in_array('academic', $allowedSections) ? 'academic' : (in_array('admin', $allowedSections) ? 'admin' : $allowedSections[0]),
    request()->routeIs('dashboard') || request()->routeIs('schools') || request()->routeIs('users*') || request()->routeIs('sections') || request()->routeIs('stages') || request()->routeIs('grades') || request()->routeIs('academic-years*') || request()->routeIs('terms*') || (request()->routeIs('leads') && !request('categories')) || (request()->routeIs('contacts') && !request('categories')) => in_array('admin', $allowedSections) ? 'admin' : $allowedSections[0],
    default => $allowedSections[0],
});
@endphp

<nav      x-data="{ open: false, darkMode: localStorage.getItem('darkMode') === 'true', appTheme: localStorage.getItem('appTheme') || 'default', activeSection: '{{ $currentSection }}', switchSection(section) { this.activeSection = section; } }"
     x-init="$watch('darkMode', val => { localStorage.setItem('darkMode', val); document.documentElement.classList.toggle('dark', val); }); if (darkMode) document.documentElement.classList.add('dark'); $watch('appTheme', val => { localStorage.setItem('appTheme', val); document.documentElement.setAttribute('data-theme', val); }); document.documentElement.setAttribute('data-theme', appTheme);"
     style="position: sticky; top: 0; z-index: 99999; background: var(--crm-panel-bg); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border-bottom: 1px solid var(--crm-border);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div style="display: grid; grid-template-columns: 1fr auto 1fr; align-items: center; height: 2.8125rem;">
            <div class="shrink-0 flex items-center">
                <a href="{{ url('/') }}" wire:navigate style="display: flex; align-items: center; gap: 0.5rem; text-decoration: none;">
                    @if(\App\Models\School::first()?->logo)
                        <img src="{{ \App\Models\School::first()->logo }}" alt="{{ \App\Models\School::first()->nameEn }}" style="height: 2.8125rem; width: auto; border-radius: 0.375rem;">
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
                        {{ __('nav.students_affairs') }} <svg class="ms-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </button>
                    @endif
                    @if(in_array('hr', $allowedSections))
                    <button @click="switchSection('hr')"
                            class="inline-flex items-center px-3 py-2 text-sm rounded-md transition duration-150 ease-in-out"
                            :class="activeSection === 'hr' ? 'font-bold shadow-md bg-gray-200/80 dark:bg-gray-700/80 text-[#361d03] underline decoration-2 decoration-yellow-400 underline-offset-4' : 'font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
                            style="background: none; border: none; cursor: pointer;">
                        {{ __('nav.hr') }} <svg class="ms-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </button>
                    @endif
                    @if(in_array('academic', $allowedSections))
                    <button @click="switchSection('academic')"
                            class="inline-flex items-center px-3 py-2 text-sm rounded-md transition duration-150 ease-in-out"
                            :class="activeSection === 'academic' ? 'font-bold shadow-md bg-gray-200/80 dark:bg-gray-700/80 text-[#361d03] underline decoration-2 decoration-yellow-400 underline-offset-4' : 'font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
                            style="background: none; border: none; cursor: pointer;">
                        {{ __('nav.academic') }} <svg class="ms-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </button>
                    @endif
                    @if(in_array('control', $allowedSections))
                    <button @click="switchSection('control')"
                            class="inline-flex items-center px-3 py-2 text-sm rounded-md transition duration-150 ease-in-out"
                            :class="activeSection === 'control' ? 'font-bold shadow-md bg-gray-200/80 dark:bg-gray-700/80 text-[#361d03] underline decoration-2 decoration-yellow-400 underline-offset-4' : 'font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
                            style="background: none; border: none; cursor: pointer;">
                        {{ __('nav.control') }} <svg class="ms-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </button>
                    @endif
                    @if(in_array('admin', $allowedSections))
                    <button @click="switchSection('admin')"
                            class="inline-flex items-center px-3 py-2 text-sm rounded-md transition duration-150 ease-in-out"
                            :class="activeSection === 'admin' ? 'font-bold shadow-md bg-gray-200/80 dark:bg-gray-700/80 text-[#361d03] underline decoration-2 decoration-yellow-400 underline-offset-4' : 'font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
                            style="background: none; border: none; cursor: pointer;">
                        {{ __('nav.administrator') }} <svg class="ms-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </button>
                    @endif
                    @if(in_array('parent', $allowedSections))
                    <button @click="switchSection('parent')"
                            class="inline-flex items-center px-3 py-2 text-sm rounded-md transition duration-150 ease-in-out"
                            :class="activeSection === 'parent' ? 'font-bold shadow-md bg-gray-200/80 dark:bg-gray-700/80 text-[#361d03] underline decoration-2 decoration-yellow-400 underline-offset-4' : 'font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'"
                            style="background: none; border: none; cursor: pointer;">
                        {{ __('nav.my_dashboard') }}
                    </button>
                    @endif
                </div>

            <div class="hidden sm:flex sm:items-center sm:justify-end sm:ms-6 gap-2">
                <button @click="darkMode = !darkMode" type="button" class="inline-flex items-center p-2 rounded-md focus:outline-none transition duration-150 ease-in-out" style="color: var(--crm-text-muted);">
                    <span x-show="!darkMode" x-cloak style="font-size: 1.25rem; line-height: 1;">🌙</span>
                    <span x-show="darkMode" x-cloak style="font-size: 1.25rem; line-height: 1;">☀️</span>
                </button>
<button @click="appTheme = appTheme === 'default' ? 'natural' : appTheme === 'natural' ? 'forest' : 'default'" type="button" class="inline-flex items-center px-3 py-2 border text-sm leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150" style="border-color: var(--crm-border); color: var(--crm-text-muted); background: var(--crm-btn-secondary-bg);">
                        Theme <span x-text="appTheme === 'default' ? '🌞' : appTheme === 'natural' ? '🌰' : '🌿'" style="margin-left: 0.25rem;"></span>
                    </button>
                <a href="{{ route('language.switch', app()->getLocale() === 'en' ? 'ar' : 'en') }}" class="inline-flex items-center justify-center w-9 h-9 rounded-md focus:outline-none transition ease-in-out duration-150" style="color: var(--crm-text-muted); background: transparent; text-decoration: none;">
                    @if (app()->getLocale() === 'en')
                        <img src="{{ asset('Egypt-Flag.ico') }}" alt="Arabic" class="h-5 w-5" style="border-radius: 2px;">
                    @else
                        <img src="{{ asset('flag_united_nations.ico') }}" alt="English" class="h-5 w-5" style="border-radius: 2px;">
                    @endif
                </a>
                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border text-sm leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150" style="border-color: var(--crm-border); color: var(--crm-text-muted); background: var(--crm-btn-secondary-bg);">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                            <div class="ms-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>{{ __('nav.profile') }}</x-dropdown-link>
                        <button wire:click="logout" class="w-full text-start"><x-dropdown-link>{{ __('nav.log_out') }}</x-dropdown-link></button>
                    </x-slot>
                </x-dropdown>
                @endauth
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
    <div style="position: sticky; top: 2.8125rem; z-index: 9998; border-bottom: 1px solid var(--crm-border); background: var(--crm-dropdown-bg, #ffffff); overflow: hidden;">
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
                            <a href="{{ route('leads', ['categories' => 'Student,Parent', 'section' => 'students']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->fullUrlIs('*leads*') && request('categories') === 'Student,Parent', 'text-gray-600 dark:text-gray-300' => !(request()->fullUrlIs('*leads*') && request('categories') === 'Student,Parent')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.leads') }}</a>
                            <a href="{{ route('contacts', ['categories' => 'Student,Parent', 'section' => 'students']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->fullUrlIs('*contacts*') && request('categories') === 'Student,Parent', 'text-gray-600 dark:text-gray-300' => !(request()->fullUrlIs('*contacts*') && request('categories') === 'Student,Parent')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.contacts') }}</a>
                            <span style="width: 1px; height: 1.25rem; background: var(--crm-divider, #e5e7eb); margin: 0 0.5rem;"></span>
                            <a href="{{ route('students', ['section' => 'students']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('students'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('students')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.students') }}</a>
                            <a href="{{ route('enrollments', ['section' => 'students']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('enrollments'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('enrollments')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.enrollments') }}</a>
                            <a href="{{ route('student-degrees', ['section' => 'students']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('student-degrees'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('student-degrees')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.degrees') }}</a>
                            <span style="width: 1px; height: 1.25rem; background: var(--crm-divider, #e5e7eb); margin: 0 0.5rem;"></span>
                            <a href="{{ route('stages', ['section' => 'students']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('stages'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('stages')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.stages') }}</a>
                            <a href="{{ route('grades', ['section' => 'students']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('grades'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('grades')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.grades') }}</a>
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
                            <a href="{{ route('leads', ['categories' => 'Employee', 'section' => 'hr']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->fullUrlIs('*leads*') && request('categories') === 'Employee', 'text-gray-600 dark:text-gray-300' => !(request()->fullUrlIs('*leads*') && request('categories') === 'Employee')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.leads') }}</a>
                            <a href="{{ route('contacts', ['categories' => 'Employee', 'section' => 'hr']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->fullUrlIs('*contacts*') && request('categories') === 'Employee', 'text-gray-600 dark:text-gray-300' => !(request()->fullUrlIs('*contacts*') && request('categories') === 'Employee')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.contacts') }}</a>
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
                            <a href="{{ route('contacts', ['categories' => 'Student', 'section' => 'academic']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->fullUrlIs('*contacts*') && request('categories') === 'Student', 'text-gray-600 dark:text-gray-300' => !(request()->fullUrlIs('*contacts*') && request('categories') === 'Student')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.contacts') }}</a>
                            <span style="width: 1px; height: 1.25rem; background: var(--crm-divider, #e5e7eb); margin: 0 0.5rem;"></span>
                            <a href="{{ route('stages', ['section' => 'academic']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('stages'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('stages')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.stages') }}</a>
                            <a href="{{ route('grades', ['section' => 'academic']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('grades'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('grades')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.grades') }}</a>
                            <a href="{{ route('subjects', ['section' => 'academic']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('subjects'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('subjects')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.subjects') }}</a>
                            <a href="{{ route('grade-subjects', ['section' => 'academic']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('grade-subjects'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('grade-subjects')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.grade_subjects') }}</a>
                            <a href="{{ route('students', ['section' => 'academic']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('students'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('students')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.students') }}</a>
                            <span style="width: 1px; height: 1.25rem; background: var(--crm-divider, #e5e7eb); margin: 0 0.5rem;"></span>
                            <a href="{{ route('attendance', ['section' => 'academic']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('attendance'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('attendance')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.attendance') }}</a>
                            <a href="{{ route('exams', ['section' => 'academic']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('exams*'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('exams*')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.exams') }}</a>
                            <a href="{{ route('student-degrees', ['section' => 'academic']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('student-degrees'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('student-degrees')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.degrees') }}</a>
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
                            <a href="{{ route('students', ['section' => 'control']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('students'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('students')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.students') }}</a>
                            <a href="{{ route('student-degrees', ['section' => 'control']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('student-degrees'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('student-degrees')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.degrees') }}</a>
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
                            <a href="{{ route('dashboard', ['section' => 'admin']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('dashboard'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('dashboard')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.dashboard') }}</a>
                            <span style="width: 1px; height: 1.25rem; background: var(--crm-divider, #e5e7eb); margin: 0 0.5rem;"></span>
                            <a href="{{ route('leads', ['section' => 'admin']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('leads') && !request('categories'), 'text-gray-600 dark:text-gray-300' => !(request()->routeIs('leads') && !request('categories'))]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.leads') }}</a>
                            <a href="{{ route('contacts', ['section' => 'admin']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('contacts') && !request('categories'), 'text-gray-600 dark:text-gray-300' => !(request()->routeIs('contacts') && !request('categories'))]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.contacts') }}</a>
                            <span style="width: 1px; height: 1.25rem; background: var(--crm-divider, #e5e7eb); margin: 0 0.5rem;"></span>
                            <a href="{{ route('stages', ['section' => 'admin']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('stages'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('stages')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.stages') }}</a>
                            <a href="{{ route('grades', ['section' => 'admin']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('grades'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('grades')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.grades') }}</a>
                            <a href="{{ route('subjects', ['section' => 'admin']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('subjects'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('subjects')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.subjects') }}</a>
                            <a href="{{ route('grade-subjects', ['section' => 'admin']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('grade-subjects'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('grade-subjects')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.grade_subjects') }}</a>
                            <a href="{{ route('attendance', ['section' => 'admin']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('attendance'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('attendance')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.attendance') }}</a>
                            <a href="{{ route('exams', ['section' => 'admin']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('exams*'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('exams*')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.exams') }}</a>
                            <a href="{{ route('student-degrees', ['section' => 'admin']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('student-degrees'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('student-degrees')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.degrees') }}</a>
                            <a href="{{ route('sections', ['section' => 'admin']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('sections'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('sections')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.classes') }}</a>
                            <span style="width: 1px; height: 1.25rem; background: var(--crm-divider, #e5e7eb); margin: 0 0.5rem;"></span>
                            <a href="{{ route('users', ['section' => 'admin']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('users'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('users')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.users') }}</a>
                            <a href="{{ route('academic-years', ['section' => 'admin']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('academic-years'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('academic-years')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.academic_years') }}</a>
                            <a href="{{ route('terms', ['section' => 'admin']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('terms'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('terms')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.terms') }}</a>
                            <span style="width: 1px; height: 1.25rem; background: var(--crm-divider, #e5e7eb); margin: 0 0.5rem;"></span>
                            <a href="{{ route('schools', ['section' => 'admin']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('schools'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('schools')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.school') }}</a>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Parent subnav --}}
                @if(in_array('parent', $allowedSections))
                <div x-show="activeSection === 'parent'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     style="position: absolute; inset: 0;">
                    <div style="display: flex; justify-content: center; align-items: center; width: 100%; height: 100%;">
                        <div class="flex items-center gap-1">
                            <a href="{{ route('parent.dashboard') }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-[#361d03] font-semibold underline decoration-2 decoration-yellow-400 underline-offset-4' => request()->routeIs('parent.dashboard'), 'text-gray-600 dark:text-gray-300' => !request()->routeIs('parent.dashboard')]) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.my_dashboard') }}</a>
                            <a href="{{ route('leads', ['categories' => 'Student,Parent', 'section' => 'students']) }}" wire:navigate @class(['inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition', 'text-gray-600 dark:text-gray-300']) style="background: var(--crm-btn-secondary-bg, transparent);">{{ __('nav.admission_status') }}</a>
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
                <div class="px-4 py-1 text-xs font-semibold uppercase tracking-wider" style="color: var(--crm-text-muted, #6b7280);">{{ __('nav.students_affairs') }}</div>
                <x-responsive-nav-link :href="route('leads', ['categories' => 'Student,Parent', 'section' => 'students'])" :active="request()->fullUrlIs('*leads*') && request('categories') === 'Student,Parent'" wire:navigate>{{ __('nav.leads') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('contacts', ['categories' => 'Student,Parent', 'section' => 'students'])" :active="request()->fullUrlIs('*contacts*') && request('categories') === 'Student,Parent'" wire:navigate>{{ __('nav.contacts') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('students', ['section' => 'students'])" :active="request()->routeIs('students')" wire:navigate>{{ __('nav.students') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('enrollments', ['section' => 'students'])" :active="request()->routeIs('enrollments')" wire:navigate>{{ __('nav.enrollments') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('student-degrees', ['section' => 'students'])" :active="request()->routeIs('student-degrees')" wire:navigate>{{ __('nav.degrees') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('stages', ['section' => 'students'])" :active="request()->routeIs('stages')" wire:navigate>{{ __('nav.stages') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('grades', ['section' => 'students'])" :active="request()->routeIs('grades')" wire:navigate>{{ __('nav.grades') }}</x-responsive-nav-link>
            </div>
            @endif
            @if(in_array('hr', $allowedSections))
            <div style="border-bottom: 1px solid var(--crm-divider, #e5e7eb); padding: 0.25rem 0;">
                <div class="px-4 py-1 text-xs font-semibold uppercase tracking-wider" style="color: var(--crm-text-muted, #6b7280);">{{ __('nav.hr') }}</div>
                <x-responsive-nav-link :href="route('leads', ['categories' => 'Employee', 'section' => 'hr'])" :active="request()->fullUrlIs('*leads*') && request('categories') === 'Employee'" wire:navigate>{{ __('nav.leads') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('contacts', ['categories' => 'Employee', 'section' => 'hr'])" :active="request()->fullUrlIs('*contacts*') && request('categories') === 'Employee'" wire:navigate>{{ __('nav.contacts') }}</x-responsive-nav-link>
            </div>
            @endif
            @if(in_array('academic', $allowedSections))
            <div style="border-bottom: 1px solid var(--crm-divider, #e5e7eb); padding: 0.25rem 0;">
                <div class="px-4 py-1 text-xs font-semibold uppercase tracking-wider" style="color: var(--crm-text-muted, #6b7280);">{{ __('nav.academic') }}</div>
                <x-responsive-nav-link :href="route('contacts', ['categories' => 'Student', 'section' => 'academic'])" :active="request()->fullUrlIs('*contacts*') && request('categories') === 'Student'" wire:navigate>{{ __('nav.contacts') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('stages', ['section' => 'academic'])" :active="request()->routeIs('stages')" wire:navigate>{{ __('nav.stages') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('grades', ['section' => 'academic'])" :active="request()->routeIs('grades')" wire:navigate>{{ __('nav.grades') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('subjects', ['section' => 'academic'])" :active="request()->routeIs('subjects')" wire:navigate>{{ __('nav.subjects') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('grade-subjects', ['section' => 'academic'])" :active="request()->routeIs('grade-subjects')" wire:navigate>{{ __('nav.grade_subjects') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('attendance', ['section' => 'academic'])" :active="request()->routeIs('attendance')" wire:navigate>{{ __('nav.attendance') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('exams', ['section' => 'academic'])" :active="request()->routeIs('exams')" wire:navigate>{{ __('nav.exams') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('student-degrees', ['section' => 'academic'])" :active="request()->routeIs('student-degrees')" wire:navigate>{{ __('nav.degrees') }}</x-responsive-nav-link>
            </div>
            @endif
            @if(in_array('control', $allowedSections))
            <div style="border-bottom: 1px solid var(--crm-divider, #e5e7eb); padding: 0.25rem 0;">
                <div class="px-4 py-1 text-xs font-semibold uppercase tracking-wider" style="color: var(--crm-text-muted, #6b7280);">{{ __('nav.control') }}</div>
                <x-responsive-nav-link :href="route('students', ['section' => 'control'])" :active="request()->routeIs('students')" wire:navigate>{{ __('nav.students') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('student-degrees', ['section' => 'control'])" :active="request()->routeIs('student-degrees')" wire:navigate>{{ __('nav.degrees') }}</x-responsive-nav-link>
            </div>
            @endif
            @if(in_array('admin', $allowedSections))
            <div style="padding: 0.25rem 0;">
                <div class="px-4 py-1 text-xs font-semibold uppercase tracking-wider" style="color: var(--crm-text-muted, #6b7280);">{{ __('nav.administrator') }}</div>
                <x-responsive-nav-link :href="route('dashboard', ['section' => 'admin'])" :active="request()->routeIs('dashboard')" wire:navigate>{{ __('nav.dashboard') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('leads', ['section' => 'admin'])" :active="request()->routeIs('leads')" wire:navigate>{{ __('nav.leads') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('contacts', ['section' => 'admin'])" :active="request()->routeIs('contacts')" wire:navigate>{{ __('nav.contacts') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('stages', ['section' => 'admin'])" :active="request()->routeIs('stages')" wire:navigate>{{ __('nav.stages') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('grades', ['section' => 'admin'])" :active="request()->routeIs('grades')" wire:navigate>{{ __('nav.grades') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('subjects', ['section' => 'admin'])" :active="request()->routeIs('subjects')" wire:navigate>{{ __('nav.subjects') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('grade-subjects', ['section' => 'admin'])" :active="request()->routeIs('grade-subjects')" wire:navigate>{{ __('nav.grade_subjects') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('attendance', ['section' => 'admin'])" :active="request()->routeIs('attendance')" wire:navigate>{{ __('nav.attendance') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('exams', ['section' => 'admin'])" :active="request()->routeIs('exams')" wire:navigate>{{ __('nav.exams') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('student-degrees', ['section' => 'admin'])" :active="request()->routeIs('student-degrees')" wire:navigate>{{ __('nav.degrees') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('sections', ['section' => 'admin'])" :active="request()->routeIs('sections')" wire:navigate>{{ __('nav.classes') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('users', ['section' => 'admin'])" :active="request()->routeIs('users')" wire:navigate>{{ __('nav.users') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('academic-years', ['section' => 'admin'])" :active="request()->routeIs('academic-years')" wire:navigate>{{ __('nav.academic_years') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('terms', ['section' => 'admin'])" :active="request()->routeIs('terms')" wire:navigate>{{ __('nav.terms') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('schools', ['section' => 'admin'])" :active="request()->routeIs('schools')" wire:navigate>{{ __('nav.school') }}</x-responsive-nav-link>
            </div>
            @endif
            @if(in_array('parent', $allowedSections))
            <div style="padding: 0.25rem 0;">
                <div class="px-4 py-1 text-xs font-semibold uppercase tracking-wider" style="color: var(--crm-text-muted, #6b7280);">{{ __('nav.parent') }}</div>
                <x-responsive-nav-link :href="route('parent.dashboard')" :active="request()->routeIs('parent.dashboard')" wire:navigate>{{ __('nav.my_dashboard') }}</x-responsive-nav-link>
            </div>
            @endif
        </div>
        @auth
        <div class="pt-4 pb-1" style="border-top: 1px solid var(--crm-border);">
            <div class="px-4">
                <div class="font-medium text-base" style="color: var(--crm-text);" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm" style="color: var(--crm-text-muted);">{{ auth()->user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>{{ __('nav.profile') }}</x-responsive-nav-link>
                <button wire:click="logout" class="w-full text-start"><x-responsive-nav-link>{{ __('nav.log_out') }}</x-responsive-nav-link></button>
            </div>
        </div>
        @endauth
    </div>
</nav>