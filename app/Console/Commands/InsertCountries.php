<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Services\CountryService;
use App\Services\CurrencyService;
use App\Services\LanguageService;


class InsertCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:countries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert countries and currencies in tables';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $countryService;
    protected $currencyService;
    protected $languageService;

    public function __construct(CountryService $countryService, CurrencyService $currencyService, LanguageService $languageService)
    {
        parent::__construct();
        $this->countryService = $countryService;
        $this->currencyService = $currencyService;
        $this->languageService = $languageService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $insertCountries = $this->insertCountries();
        
        return 0;
    }

    protected function insertCountries()
    {
        try
        {
            $client = new \GuzzleHttp\Client(['verify' => false ]);
            $response = $client->request('GET', 'https://restcountries.com/v3.1/all');
            $data = json_decode($response->getBody(),true);
    
            foreach( $data as $country){
                // Add new country
                $newCountry = $this->countryService->execute($country);
    
                // Insert languages and currencies
                if(isset($country["languages"])){
                    $languages = $this->languageService->execute($newCountry->id, $country["languages"]);
                }

                if(isset($country["currencies"])){
                    $currencies = $this->currencyService->execute($newCountry->id, $country["currencies"]);
                }

            }
            return true;
        }
        catch (Exception $e) 
        {
            \Log::info($e);
            return $e->getMessage();
        }

    }
}
