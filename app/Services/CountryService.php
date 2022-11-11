<?php

namespace App\Services;

use App\Services\BaseService;
use App\Models\Country;

class CountryService extends BaseService
{
    
    public function rules()
    {
        return [
            'common' => 'required|string',
            'official' => 'required|string',
            'region' => 'string',
            'subregion' => 'string',
            'lat' => 'required|numeric',
            'lang' => 'required|numeric',
            'area' => 'required|numeric',
            'googleMaps' => 'string',
            'openStreetMaps' => 'string',
            'population' => 'required|integer',
            'flag_png' => 'string',
            'flag_svg' => 'string',
            'coat_of_arm_png' => 'string',
            'coat_of_arm_svg' => 'string'
        ];
    }


    public function execute($data)
    {
        try
        {
            
            $new_country = $this->createCountry($data);

            $countryArray = json_decode(json_encode($new_country), true);
            $this->validate($countryArray);

            $new_country->save();

            return $new_country;
        }
        catch (Exception $e) 
        {
            \Log::info($e);
            return $e->getMessage();
        }
    }

    private function createCountry($data)
    {
        $country = new Country();
    
        $country->common = isset($data['name']['common']) ? $data['name']['common'] : '';
        $country->official = isset($data['name']['official']) ? $data['name']['official'] : '';
                
        $country->region = isset($data['region']) ? $data['region'] : '';
        $country->subregion = isset($data['subregion']) ? $data['subregion'] : '';
    
        $country->lat = isset($data['latlng'][0]) ? $data['latlng'][0] : '';
        $country->lang = isset($data['latlng'][1]) ? $data['latlng'][1] : '';
        $country->area = isset($data['area']) ? $data['area'] : 0.0;
    
        $country->googleMaps = isset($data['maps']['googleMaps']) ? $data['maps']['googleMaps'] : '';
        $country->openStreetMaps = isset($data['maps']['openStreetMaps']) ? $data['maps']['openStreetMaps'] : '';
                
        $country->population = isset($data['population']) ? $data['population'] : 0;
    
        $country->flag_png = isset($data['flags']['png']) ? $data['flags']['png'] : '';
        $country->flag_svg = isset($data['flags']['svg']) ? $data['flags']['svg'] : '';
        $country->coat_of_arm_png = isset($data['coatOfArms']['png']) ? $data['coatOfArms']['png'] : '';
        $country->coat_of_arm_svg = isset($data['coatOfArms']['svg']) ? $data['coatOfArms']['svg'] : '';
    
        return $country;
        
    }
}