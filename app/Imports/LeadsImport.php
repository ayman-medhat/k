<?php

namespace App\Imports;

use App\Models\Lead;
use Carbon\Carbon;
use OpenSpout\Reader\CSV\Reader as CsvReader;
use OpenSpout\Reader\XLSX\Reader as XlsxReader;
use OpenSpout\Reader\ODS\Reader as OdsReader;

class LeadsImport
{
    public int $imported = 0;
    public int $skipped = 0;
    public int $updated = 0;
    public array $errors = [];
    public string $duplicateAction = 'skip';

    protected function createReader(string $filePath): CsvReader|XlsxReader|OdsReader
    {
        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        return match ($ext) {
            'csv' => new CsvReader,
            'xlsx' => new XlsxReader,
            'xls' => new XlsxReader,
            'ods' => new OdsReader,
            default => throw new \InvalidArgumentException("Unsupported file type: {$ext}"),
        };
    }

    public function import(string $filePath): array
    {
        $reader = $this->createReader($filePath);
        $reader->open($filePath);

        $firstSheet = true;
        foreach ($reader->getSheetIterator() as $sheet) {
            if (!$firstSheet) break;
            $firstSheet = false;

            $headerRow = null;
            foreach ($sheet->getRowIterator() as $rowIndex => $row) {
                $cells = $row->toArray();
                if (empty(array_filter($cells))) continue;

                if ($headerRow === null) {
                    $headerRow = array_map(function ($val) {
                        return strtolower(str_replace([' ', '-'], '_', trim((string) $val)));
                    }, $cells);
                    continue;
                }

                $this->processRow($headerRow, $cells, $rowIndex);
            }
        }

        $reader->close();

        return [
            'imported' => $this->imported,
            'updated' => $this->updated,
            'skipped' => $this->skipped,
            'errors' => $this->errors,
        ];
    }

    public function detectDuplicates(string $filePath): array
    {
        $duplicates = [];
        $reader = $this->createReader($filePath);
        $reader->open($filePath);

        $firstSheet = true;
        foreach ($reader->getSheetIterator() as $sheet) {
            if (!$firstSheet) break;
            $firstSheet = false;

            $headerRow = null;
            foreach ($sheet->getRowIterator() as $rowIndex => $row) {
                $cells = $row->toArray();
                if (empty(array_filter($cells))) continue;

                if ($headerRow === null) {
                    $headerRow = array_map(function ($val) {
                        return strtolower(str_replace([' ', '-'], '_', trim((string) $val)));
                    }, $cells);
                    continue;
                }

                $data = [];
                foreach ($headerRow as $i => $header) {
                    $data[$header] = $cells[$i] ?? null;
                }

                if (empty($data['nameen'] ?? null)) continue;

                $nationalId = $data['national_id'] ?? $data['nationalid'] ?? null;
                if (!$nationalId) continue;

                $existing = Lead::where('national_id', $nationalId)->first();
                if ($existing) {
                    $duplicates[] = [
                        'row' => $rowIndex,
                        'data' => $data,
                        'existing' => [
                            'id' => $existing->id,
                            'nameEn' => $existing->nameEn,
                            'nameAr' => $existing->nameAr,
                            'national_id' => $existing->national_id,
                        ],
                    ];
                }
            }
        }

        $reader->close();
        return $duplicates;
    }

    protected function processRow(array $headers, array $cells, int $rowIndex): void
    {
        $data = [];
        foreach ($headers as $i => $header) {
            $data[$header] = $cells[$i] ?? null;
        }

        if (empty($data['nameen'] ?? null) && empty($data['namear'] ?? null)) {
            $this->skipped++;
            $this->errors[] = "Row {$rowIndex}: Both nameEn and nameAr are missing.";
            return;
        }

        if (empty($data['nameen'] ?? null)) {
            $data['nameen'] = $data['namear'];
        }

        $nationalId = $data['national_id'] ?? $data['nationalid'] ?? null;

        $existing = null;
        if ($nationalId) {
            $existing = Lead::where('national_id', $nationalId)->first();
        }

        if ($existing) {
            if ($this->duplicateAction === 'skip') {
                $this->skipped++;
                $this->errors[] = "Row {$rowIndex}: Duplicate national_id ({$nationalId}) — skipped.";
                return;
            }
            if ($this->duplicateAction === 'update') {
                $existing->update($this->mapData($data, $existing));
                $this->updated++;
                return;
            }
            $this->skipped++;
            return;
        }

        try {
            Lead::create($this->mapData($data));
            $this->imported++;
        } catch (\Exception $e) {
            $this->skipped++;
            $this->errors[] = "Row {$rowIndex}: {$e->getMessage()}";
        }
    }

    protected function mapData(array $data, ?Lead $existing = null): array
    {
        $record = $existing ? $existing->toArray() : [];

        $fields = [
            'nameEn' => 'nameen',
            'nameAr' => 'namear',
            'email' => 'email',
            'phone' => 'phone',
            'nationality' => 'nationality',
            'religion' => 'religion',
            'gender' => 'gender',
            'national_id' => ['national_id', 'nationalid'],
            'passport_no' => ['passport_no', 'passportno'],
            'status' => 'status',
            'source' => 'source',
            'notes' => 'notes',
            'grade_id' => ['grade_id', 'gradeid'],
            'second_language_subject_id' => ['second_language_subject_id', 'secondlanguagesubjectid'],
        ];

        foreach ($fields as $modelField => $keys) {
            $keys = (array) $keys;
            foreach ($keys as $key) {
                if (isset($data[$key]) && $data[$key] !== '' && $data[$key] !== null) {
                    $record[$modelField] = $data[$key];
                    break;
                }
            }
        }

        if ($birthDate = $this->parseDate($data['birth_date'] ?? $data['birthdate'] ?? null)) {
            $record['birth_date'] = $birthDate;
        }

        if ($categories = $this->parseCategories($data['categories'] ?? null)) {
            $record['categories'] = $categories;
        }

        if (!isset($record['status'])) {
            $record['status'] = 'New';
        }

        $parentNationalId = $data['parent_national_id'] ?? $data['parentnationalid'] ?? null;
        if ($parentNationalId) {
            $parent = Lead::where('national_id', $parentNationalId)->first();
            if (!$parent) {
                $parent = Lead::create([
                    'nameEn' => $data['parent_name'] ?? $data['parentname'] ?? 'Imported Parent',
                    'nameAr' => $data['parent_name_ar'] ?? $data['parentnamear'] ?? 'Imported Parent',
                    'national_id' => $parentNationalId,
                    'categories' => ['Parent'],
                    'status' => 'New',
                ]);
            }
            $record['parent_id'] = $parent->id;
        }

        $motherNationalId = $data['mother_national_id'] ?? $data['mothernationalid'] ?? null;
        if ($motherNationalId) {
            $mother = Lead::where('national_id', $motherNationalId)->first();
            if (!$mother) {
                $mother = Lead::create([
                    'nameEn' => $data['mother_name'] ?? $data['mothername'] ?? 'Imported Mother',
                    'nameAr' => $data['mother_name_ar'] ?? $data['mothernamear'] ?? 'Imported Mother',
                    'national_id' => $motherNationalId,
                    'categories' => ['Parent'],
                    'status' => 'New',
                ]);
            }
            $record['mother_id'] = $mother->id;
        }

        return $record;
    }

    protected function parseCategories(?string $value): array
    {
        if (empty($value)) return ['Lead'];
        return array_map('trim', explode(',', $value));
    }

    protected function parseDate(mixed $value): ?string
    {
        if (empty($value)) return null;
        try {
            if ($value instanceof \DateTimeInterface) {
                return $value->format('Y-m-d');
            }
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
