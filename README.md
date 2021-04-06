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

Creacion Modelo Factory y migracion
```shel
php artisan m:model Post -fm
```

Creacion Modelo Factory y migracion
```shel
php artisan m:con Api\PostController --api --model=Post
```

Creacion bd para pruebas 

se crea el archivo `database\database.sqlite` y se configura el archivo `config\database.php`