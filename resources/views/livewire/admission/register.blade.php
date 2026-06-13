{{-- ============================================================
     Parent Registration View
     Public form at /admission/register
     Uses CRM CSS variables for light/dark mode
     Shows a scrolling stats marquee + parent info form
     ============================================================ --}}
<div class="crm-container">
<style>
    {{-- CRM container — gradient background using CRM CSS variables for dark mode support --}}
    .crm-container {
        font-family: 'Inter', system-ui, sans-serif;
        background: linear-gradient(135deg, var(--crm-bg-from) 0%, var(--crm-bg-to) 100%);
        min-height: 100vh;
        padding: 0.75rem 2rem;
    }
    .glass-panel {
        background: var(--crm-panel-bg);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 1rem;
        border: 1px solid var(--crm-panel-border);
        padding: 1.5rem;
        box-shadow: 0 10px 15px -3px var(--crm-panel-shadow);
    }
    .form-input {
        width: 100%;
        padding: 0.6rem 0.75rem;
        border-radius: 0.5rem;
        border: 1px solid var(--crm-input-border, #d1d5db);
        font-size: 0.9rem;
        box-sizing: border-box;
        background: var(--crm-input-bg, #f9fafb);
        color: var(--crm-text, #1f2937);
        transition: all 0.15s;
    }
    .form-input:focus {
        outline: none;
        border-color: var(--crm-input-focus-border, #6366f1);
        box-shadow: 0 0 0 3px var(--crm-input-focus-ring, rgba(99,102,241,0.2));
    }
    .form-label {
        display: block;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--crm-table-head, #4b5563);
        margin-bottom: 0.75rem;
    }
    .form-select {
        width: 100%;
        padding: 0.6rem 0.75rem;
        border-radius: 0.5rem;
        border: 1px solid var(--crm-input-border, #d1d5db);
        font-size: 0.9rem;
        box-sizing: border-box;
        background: var(--crm-input-bg, #f9fafb);
        color: var(--crm-text, #1f2937);
        transition: all 0.15s;
    }
    .form-select:focus {
        outline: none;
        border-color: var(--crm-input-focus-border, #6366f1);
        box-shadow: 0 0 0 3px var(--crm-input-focus-ring, rgba(99,102,241,0.2));
    }
    .marquee-track {
        overflow: hidden;
        white-space: nowrap;
        box-sizing: border-box;
    }
    .marquee-content {
        display: inline-block;
        animation: marquee 30s linear infinite;
    }
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
</style>

    <div class="marquee-track" style="background: var(--crm-banner-bg, linear-gradient(135deg, #fffbeb, #fef3c7)); border-bottom: 1px solid var(--crm-banner-border, #fde68a); padding: 0.5rem 0;">
        <div class="marquee-content">
            <span style="margin: 0 3rem; font-size: 0.85rem; color: var(--crm-banner-label, #92400e); font-weight: 600;">🎓 {{ $stats['students'] }}+ Students Enrolled</span>
            <span style="margin: 0 3rem; font-size: 0.85rem; color: var(--crm-banner-label, #92400e); font-weight: 600;">👨‍🏫 {{ $stats['teachers'] }}+ Teachers</span>
            <span style="margin: 0 3rem; font-size: 0.85rem; color: var(--crm-banner-label, #92400e); font-weight: 600;">🏆 {{ $stats['years'] }}+ Years of Excellence</span>
            <span style="margin: 0 3rem; font-size: 0.85rem; color: var(--crm-banner-label, #92400e); font-weight: 600;">📚 Accredited Curriculum</span>
            <span style="margin: 0 3rem; font-size: 0.85rem; color: var(--crm-banner-label, #92400e); font-weight: 600;">🎯 Holistic Development</span>
            {{-- Duplicate set for seamless infinite scroll loop --}}
            <span style="margin: 0 3rem; font-size: 0.85rem; color: var(--crm-banner-label, #92400e); font-weight: 600;">🎓 {{ $stats['students'] }}+ Students Enrolled</span>
            <span style="margin: 0 3rem; font-size: 0.85rem; color: var(--crm-banner-label, #92400e); font-weight: 600;">👨‍🏫 {{ $stats['teachers'] }}+ Teachers</span>
            <span style="margin: 0 3rem; font-size: 0.85rem; color: var(--crm-banner-label, #92400e); font-weight: 600;">🏆 {{ $stats['years'] }}+ Years of Excellence</span>
            <span style="margin: 0 3rem; font-size: 0.85rem; color: var(--crm-banner-label, #92400e); font-weight: 600;">📚 Accredited Curriculum</span>
            <span style="margin: 0 3rem; font-size: 0.85rem; color: var(--crm-banner-label, #92400e); font-weight: 600;">🎯 Holistic Development</span>
        </div>
    </div>

    @if($step === 1)
    <form wire:submit="submit" style="max-width: 600px; margin: 0 auto; padding: 2rem 1rem;">
        <div style="text-align: center; margin-bottom: 0.75rem;">
            <h1 style="font-size: 1.75rem; font-weight: 800; color: var(--crm-text, #1f2937); margin: 0;">{{ __('admission.page_title') }}</h1>
            <p style="color: var(--crm-text-muted, #6b7280); margin-top: 0.75rem; font-size: 0.9rem;">Create your parent account to track your children's admission status.</p>
        </div>

        <div class="glass-panel" style="margin-bottom: 0.75rem;">
            <h2 style="font-size: 1.125rem; font-weight: 700; color: var(--crm-text, #1f2937); margin: 0 0 1.25rem 0; padding-bottom: 0.75rem; border-bottom: 2px solid var(--crm-divider, #e5e7eb);">{{ __('general.parent_info') }}</h2>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div>
                    <label class="form-label">{{ __('general.name_en') }} <span style="color: #ef4444;">*</span></label>
                    <input type="text" wire:model="nameEn" class="form-input">
                    @error('nameEn') <span style="color: #ef4444; font-size: 0.75rem;">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="form-label">{{ __('general.name_ar') }} <span style="color: #ef4444;">*</span></label>
                    <input type="text" wire:model="nameAr" class="form-input" dir="rtl">
                    @error('nameAr') <span style="color: #ef4444; font-size: 0.75rem;">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="form-label">{{ __('general.email') }} <span style="color: #ef4444;">*</span></label>
                    <input type="email" wire:model="email" class="form-input">
                    @error('email') <span style="color: #ef4444; font-size: 0.75rem;">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="form-label">{{ __('general.phone') }}</label>
                    <input type="text" wire:model="phone" class="form-input">
                    @error('phone') <span style="color: #ef4444; font-size: 0.75rem;">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="form-label">{{ __('general.nationality') }} <span style="color: #ef4444;">*</span></label>
                    <select wire:model="nationality" class="form-select">
                        <option value="Egyptian">{{ __('general.egyptian') }}</option>
                        <option value="Other">{{ __('general.other') }}</option>
                    </select>
                    @error('nationality') <span style="color: #ef4444; font-size: 0.75rem;">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="form-label">{{ __('general.religion') }} <span style="color: #ef4444;">*</span></label>
                    <select wire:model="religion" class="form-select">
                        <option value="">{{ __('general.select') }}</option>
                        <option value="Muslim">{{ __('general.muslim') }}</option>
                        <option value="Christian">{{ __('general.christian') }}</option>
                    </select>
                    @error('religion') <span style="color: #ef4444; font-size: 0.75rem;">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="form-label">{{ __('general.gender') }} <span style="color: #ef4444;">*</span></label>
                    <select wire:model="gender" class="form-select">
                        <option value="">{{ __('general.select') }}</option>
                        <option value="Male">{{ __('general.male') }}</option>
                        <option value="Female">{{ __('general.female') }}</option>
                    </select>
                    @error('gender') <span style="color: #ef4444; font-size: 0.75rem;">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="form-label">{{ __('general.national_id') }}</label>
                    <input type="text" wire:model="national_id" maxlength="14" class="form-input">
                    @error('national_id') <span style="color: #ef4444; font-size: 0.75rem;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 0.75rem;">
                <div>
                    <label class="form-label">{{ __('general.password') }} <span style="color: #ef4444;">*</span></label>
                    <input type="password" wire:model="password" class="form-input">
                    @error('password') <span style="color: #ef4444; font-size: 0.75rem;">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="form-label">{{ __('auth.confirm_password') }} <span style="color: #ef4444;">*</span></label>
                    <input type="password" wire:model="password_confirmation" class="form-input">
                </div>
            </div>
        </div>

        <div style="text-align: center;">
            <button type="submit" style="padding: 0.75rem 3rem; background: var(--crm-btn-primary-bg); color: white; border: none; border-radius: 9999px; font-weight: 700; font-size: 1rem; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.4); transition: all 0.2s;">
                {{ __('auth.register') }}
            </button>
        </div>

        <div style="text-align: center; margin-top: 0.75rem;">
            <a href="{{ route('login') }}" style="color: #6366f1; font-size: 0.875rem; text-decoration: underline;">Already have an account? Log in</a>
        </div>
    </form>
    @else
    <div style="max-width: 500px; margin: 4rem auto; text-align: center; padding: 2rem;">
        <div style="font-size: 4rem; margin-bottom: 0.75rem;">🎉</div>
        <h1 style="font-size: 1.75rem; font-weight: 800; color: var(--crm-text, #1f2937); margin: 0 0 0.75rem 0;">Registration Successful!</h1>
        <p style="color: var(--crm-text-muted, #6b7280); line-height: 1.6; margin-bottom: 0.75rem;">
            Your parent account has been created. You can now log in to track your children's admission status.
        </p>
        <a href="{{ route('parent.dashboard') }}" wire:navigate style="display: inline-block; padding: 0.75rem 2rem; background: var(--crm-btn-primary-bg); color: white; border-radius: 9999px; font-weight: 700; text-decoration: none; box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.4);">
            Go to Dashboard
        </a>
    </div>
    @endif
</div>
