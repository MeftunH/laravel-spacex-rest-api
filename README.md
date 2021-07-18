# LARAVEL SPACEX REST API :rocket:
## Deployed by heroku on this [address](http://github.comhttps://shrouded-lake-10232.herokuapp.com/)
* If you want to reach to swagger ui go to: https://shrouded-lake-10232.herokuapp.com/api/documentation
- [x] a PHP artisan command to get all data from SpaceX API and sync them into the database for every 3 minutes.
* php artisan sync:ToDatabase
- ![Screenshot_5](https://user-images.githubusercontent.com/48466124/126051362-a7396066-64ec-470e-9924-4330343c2b78.png)
- [x] an Event/Listener to fire it when the sync is started and completed.
- [x] a log when the sync is complete
-   ![Screenshot_4](https://user-images.githubusercontent.com/48466124/126051356-eefe2952-4579-4081-8bc1-75973cb30885.png)
- [x] To list all capsules, an endpoint that name GET api/capsules
- [x] To list all capsules by the status filter, an endpoint that name GET api/capsules?status=active|retired|unknown|etc  (with query parameters)
- [x] To list capsule detail, an endpoint that name GET api/capsules/{capsule_serial}
- [x] integration test to cover all endpoints
-   ![Screenshot_6](https://user-images.githubusercontent.com/48466124/126051412-da2362bd-7663-45dc-a26b-4ec582158bb0.png)
-   ![Screenshot_7](https://user-images.githubusercontent.com/48466124/126051426-0d8e1373-a42d-4731-96f0-ad1110439283.png)
- [x] integration test to cover artisan command
- [x] implement swagger for API documentation
- [x] OAuth mechanism using the passport


-**Endpoints For SPACEX API**
Name | Link
------------ | -------------
Get All Capsules API | https://api.spacexdata.com/v3/capsules
Get Capsules By Status API | https://api.spacexdata.com/v3/capsules?status=active
Get Capsule By Serial API | https://api.spacexdata.com/v3/capsules/C112

-For more details please see [spacex docs:](https://docs.spacexdata.com/ )


-You can use Bearer JWT token for login.

-**Endpoints For REST API**
Name | Link
------------ | -------------
Get All Capsules API | {domain}/api/capsules
Get Capsules By Status API | {domain}/api/capsules?status=active
Get Capsule By Serial API | {domain}/api/capsules/C112

## SET UP TO LOCALE
```
git clone https://github.com/MeftunH/laravel-spacex-rest-api.git
```
```
cp .env.example .env
```

```
Set your database on .env file
```

```
composer install
```
```
php artisan migrate
```
```
php artisan db:seed
```
```
php artisan passport:install
```
```
php artisan passport:keys
```
```
php artisan serve
```
```
php artisan l5-swagger:generate
```


