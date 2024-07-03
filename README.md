## Installation instructions

clone the repository
```bash
git clone git@github.com:mosesket/service_dto.git
```

navigate to the project directory
```bash
cd service_dto
```

activate API and install sanctum
```bash
php artisan install:api
```


scaffold using one-line command
```bash
php artisan make:model Staff -a && php artisan make:resource StaffResource && php artisan make:class Services/StaffService && php artisan make:class DataTransferObjects/StaffDto 
```

alternatively, create model, migration, factory, seeder, resource controller, requests, and policy
```bash
php artisan make:model Staff -mfscrR --policy
```

create resource 
```bash
php artisan make:resource StafResource 
```

create service 
```bash
php artisan make:class Services/StaffService
```

create DTO 
```bash
php artisan make:class DataTransferObjects/StaffDto 
```

create a Pest test file
```bash
php artisan make:test StaffTest --pest
```

run test
```bash
php artisan test
```
