go to the folder you want to use it, and run this commands
```
git clone git@github.com:mosesket/service_dto.git
```

```
php artisan make:model Staff -mrc 
```
or 
```
php artisan make:model Staff -mc 
```
install api and sanctum
```
php artisan install:api
```
create service commands
```
php artisan  make:class Service/StaffService
```
create request commands
```
php artisan make:request UpdateStafRequest
```
create resource commands
```
php artisan make:resource StafResource 
```
