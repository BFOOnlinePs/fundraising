<?php

namespace App\Imports;

use App\Models\DonorsCategoryModel;
use App\Models\DonorsModel;
use App\Models\RegionModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DonorsImport implements ToModel,WithStartRow
{
    public function model(array $row)
    {
        $existingDonor = DonorsModel::where('donors_arabic_name', $row[0])->first();

        if (!$existingDonor) {
            // Donor doesn't exist, proceed with creating new entry
            $donors_regions_id = -1;
            $donors_category_id = -1;

            if (!empty($row[8])) {
                $region = RegionModel::firstOrCreate(['regions_name' => $row[8]]);
                $donors_regions_id = $region->regions_id;
            }

            if (!empty($row[11])) {
                $donors_category = DonorsCategoryModel::firstOrCreate(['donors_categories_arabic_name' => $row[11]]);
                $donors_category_id = $donors_category->donors_categories_id;
            }

            $gender = $row[9] == 'غير محدد' ? 'other' : 'other';

            return new DonorsModel([
                'donors_arabic_name' => $row[0],
                'donors_english_name' => $row[1],
                'phone' => $row[2],
                'fax' => $row[3],
                'email' => $row[4],
                'address' => $row[5],
                'website' => $row[6],
                'work_field' => $row[7],
                'donors_regions_id' => $donors_regions_id,
                'gender' => $gender,
                'donors_donors_categories_id' => $donors_category_id,
                'notes' => $row[12],
            ]);
        } else {
            // Donor already exists, you may choose to skip or update existing entry
            // For now, let's skip it
            return null;
        }
    }

    public function startRow(): int
    {
        return 2;
    }}
