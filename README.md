# Countries demo
Darío Chiappello

After cloning the repository, move into the project directory and run:
```bash
composer install
php artisan migrate
```
Tables will be generated for countries, languages and currencies. A country can have more than one currency and language. The relationship is established in the model.

Then you have to run the command:
```bash
php artisan insert:countries
```
This [command](https://github.com/DarioChiappello/countries-demo/blob/main/app/Console/Commands/InsertCountries.php) will fetch the restcountries api to the following endpoint
[https://restcountries.com/v3.1/all](https://restcountries.com/v3.1/all)

Once the information is obtained, the command will fill the database with the api information using services created for each table but inheriting functionalities from a [base service](https://github.com/DarioChiappello/countries-demo/blob/main/app/Services/BaseService.php).

Once the execution of the command is finished, a simple get request to the project url + /api/countries will return the list of countries with their languages and currencies


