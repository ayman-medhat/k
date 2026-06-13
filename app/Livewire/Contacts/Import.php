<?php

namespace App\Livewire\Contacts;

use App\Imports\ContactsImport;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app')]
class Import extends Component
{
    use WithFileUploads;

    public $file;
    public $results = null;
    public bool $importing = false;

    public bool $showDuplicateModal = false;
    public array $duplicates = [];
    public ?string $pendingFilePath = null;

    public function import()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv,cvs,ods|max:10240',
        ]);

        $this->importing = true;
        $this->results = null;

        $path = $this->file->store('imports');
        $fullPath = Storage::path($path);

        try {
            $importer = new ContactsImport;
            $duplicates = $importer->detectDuplicates($fullPath);

            if (!empty($duplicates)) {
                $this->duplicates = $duplicates;
                $this->pendingFilePath = $fullPath;
                $this->showDuplicateModal = true;
                $this->importing = false;
                return;
            }

            $this->results = $importer->import($fullPath);
        } catch (\Exception $e) {
            $this->results = [
                'imported' => 0,
                'updated' => 0,
                'skipped' => 0,
                'errors' => ["Import failed: {$e->getMessage()}"],
            ];
        } finally {
            if (!$this->showDuplicateModal) {
                Storage::delete($path);
                $this->file = null;
                $this->importing = false;
            }
        }
    }

    public function confirmImport(string $action)
    {
        $this->showDuplicateModal = false;

        if (!$this->pendingFilePath || !file_exists($this->pendingFilePath)) {
            $this->results = [
                'imported' => 0,
                'updated' => 0,
                'skipped' => 0,
                'errors' => ['Import file not found. Please try again.'],
            ];
            $this->file = null;
            $this->importing = false;
            return;
        }

        $this->importing = true;

        try {
            $importer = new ContactsImport;
            $importer->duplicateAction = $action;
            $this->results = $importer->import($this->pendingFilePath);
        } catch (\Exception $e) {
            $this->results = [
                'imported' => 0,
                'updated' => 0,
                'skipped' => 0,
                'errors' => ["Import failed: {$e->getMessage()}"],
            ];
        } finally {
            if ($this->file) {
                Storage::delete($this->file->getPathname());
            }
            $this->file = null;
            $this->pendingFilePath = null;
            $this->duplicates = [];
            $this->importing = false;
        }
    }

    public function cancelImport()
    {
        $this->showDuplicateModal = false;
        $this->duplicates = [];
        $this->pendingFilePath = null;
        $this->file = null;
        $this->importing = false;
    }

    public function render()
    {
        return view('livewire.contacts.import');
    }
}
