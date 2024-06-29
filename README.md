go to the folder you want to use it, and run this commands
```
git clone git@github.com:mosesket/service_dto.git
```


one-line create command
```
php artisan make:model Staff -mfscrR --policy && php artisan make:resource StaffResource

```
or 
```
php artisan make:model Staff -a && php artisan make:resource StaffResource
```


install api and sanctum
```
php artisan install:api
```

create service commands
```
php artisan  make:class Services/StaffService
```

create request commands
```
php artisan make:request UpdateStafRequest
```

create resource commands
```
php artisan make:resource StafResource 
```

create DTO commands
```
php artisan make:class DataTransferObjects/TestDto 
```
