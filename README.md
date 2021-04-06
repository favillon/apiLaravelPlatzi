# Api laravel

```shel
composer create-project --prefer-dist laravel/laravel api-new "6.*" 
```

Creacion test carpeta Feature
```shel
 php artisan  m:test PageTest
```

Creacion test carpeta Unit
```shel
php artisan  m:test PageTest --unit
```

Ejecutar pruebas
```shel
php vendor\bin\phpunit
```

## TDD
* Falla
* Funciona 
* Refactorizar


crea Test

```shel
php artisan m:test Http\Controllers\Api\PostControllerTest
```