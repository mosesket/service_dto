clone the repository
```
git clone git@github.com:mosesket/service_dto.git
```
navigate to the project directory
```
cd service_dto
```

activate API and install sanctum
```
php artisan install:api
```


scaffold using one-line command
```
php artisan make:model Staff -a && php artisan make:resource StaffResource && php artisan make:class Services/StaffService && php artisan make:class DataTransferObjects/StaffDto 

```

alternatively, create model, migration, factory, seeder, resource controller, requests, and policy
```
php artisan make:model Staff -mfscrR --policy
```
create resource 
```
php artisan make:resource StafResource 
```
create service 
```
php artisan make:class Services/StaffService
```
create DTO 
```
php artisan make:class DataTransferObjects/StaffDto 
```

create a Pest test file
```
php artisan make:test StaffTest --pest
```
run test
```
php artisan test
```
