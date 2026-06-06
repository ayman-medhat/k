<?php

namespace App\Livewire\Schools;

use App\Models\School;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app')]
class ManageForm extends Component
{
    use WithFileUploads;

    public ?School $school = null;

    public $nameEn = '';
    public $nameAr = '';
    public $address = '';
    public $phone = '';
    public $email = '';
    public $website = '';
    public $logo = '';
    public $principal_name = '';
    public $mission = '';
    public $vision = '';
    public $social_facebook = '';
    public $social_twitter = '';
    public $social_instagram = '';
    public $social_linkedin = '';
    public $established_year = '';

    public $logoFile = null;

    public function mount()
    {
        $this->school = School::first();

        if ($this->school) {
            foreach ($this->school->toArray() as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value ?? '';
                }
            }
        }
    }

    public function rules()
    {
        return [
            'nameEn' => 'required|string|max:255',
            'nameAr' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'logoFile' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'logo' => 'nullable|string|max:255',
            'principal_name' => 'nullable|string|max:255',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'social_facebook' => 'nullable|string|max:255',
            'social_twitter' => 'nullable|string|max:255',
            'social_instagram' => 'nullable|string|max:255',
            'social_linkedin' => 'nullable|string|max:255',
            'established_year' => 'nullable|integer|min:1900|max:2099',
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [];
        foreach (array_keys($this->rules()) as $field) {
            if ($field === 'logoFile') continue;
            $data[$field] = $this->$field;
        }

        if ($this->logoFile) {
            $path = $this->logoFile->store('school-logos', 'public');
            $data['logo'] = '/storage/' . $path;
        }

        if ($this->school) {
            $this->school->update($data);
        } else {
            School::create($data);
        }

        session()->flash('message', 'School information saved successfully.');
    }

    public function render()
    {
        return view('livewire.schools.manage-form');
    }
}
