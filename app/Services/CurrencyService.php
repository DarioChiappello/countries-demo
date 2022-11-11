<?php

namespace App\Services;

use App\Services\BaseService;
use App\Models\Currency;

class CurrencyService extends BaseService
{
    
    public function rules()
    {
        return [
            'country_id' => 'required|integer',
            'min' => 'required|string',
            'name' => 'string',
            'symbol' => 'nullable|string',
        ];
    }
    
    

    public function execute($id, $currencies = [])
    {

        try
        {
            foreach($currencies as $key => $value){
                $newCurrency = $this->createCurrency($id,$key,$value);

                $currencyArray = json_decode(json_encode($newCurrency), true);
                $this->validate($currencyArray);

                $newCurrency->save();
            }
            return 0;
        }
        catch (Exception $e) 
        {
            \Log::info($e);
            return $e->getMessage();
        }

    }

    private function createCurrency($id,$key, $data)
    {
        $currency = new Currency();
        $currency->country_id = $id;
        $currency->min = $key;
        $currency->name = isset($data['name']) ? $data['name'] : '';
        $currency->symbol = isset($data['symbol']) ? $data['symbol'] : '';

        return $currency;
    }
}