<?php

namespace App\Services;

use App\Services\BaseService;
use App\Models\Language;

class LanguageService extends BaseService
{
    
    public function rules()
    {
        return [
            'country_id' => 'required|integer',
            'min' => 'required|string',
            'name' => 'required|string'
        ];
    }

    public function execute($id, $languages = [])
    {
        try
        {
            foreach($languages as $key => $value){
                $newLanguage = $this->createLanguage($id,$key,$value);

                $languageArray = json_decode(json_encode($newLanguage), true);
                $this->validate($languageArray);

                $newLanguage->save();
            }
            return 0;
        }
        catch (Exception $e) 
        {
            \Log::info($e);
            return $e->getMessage();
        }

    }

    private function createLanguage($id,$key, $data)
    {
        $language = new Language();
        $language->country_id = $id;
        $language->min = $key;
        $language->name = $data;

        return $language;
    }

}