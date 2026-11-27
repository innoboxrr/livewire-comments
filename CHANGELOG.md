# Changelog

Todas las modificaciones notables a este proyecto serán documentadas en este archivo.

El formato se basa en [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
y este proyecto sigue [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2026-11-27

Mayor: exige PHP 8.3, Laravel 13 y Livewire 3.7.11 o 4, y retira el modelo
`Comment`, su migración y la ruta `comments.store`, que nunca funcionaron.

### Cambiado

- **`larapack-generator` sale de `require`.** Pedía `^4.0` en tiempo de
  ejecución, y ninguna aplicación con el generador 9 podía instalar el
  paquete. El código no usa ninguna clase del generador: pasa a `require-dev`
  en `^9.0`, con `orchestra/testbench ^11.0` y PHPUnit 12.
- **Laravel 13 y PHP 8.3.** Se declaran `php ^8.3` e `illuminate/http` e
  `illuminate/support` `^13.0`. Antes no declaraba ninguno.
- **Livewire `^3.7.11 || ^4.0`**, en vez de `^2.12|^3.4`. Son las versiones que
  admiten Laravel 13; la suite pasa con la 3.7.11, la 3.8 y la 4.
- **Los proveedores heredan de `ServiceProvider`**, no de los de Foundation, y
  no leen la caché al arrancar. La clave de caché (`auth_policies`,
  `events_and_observers`) era la misma en todos los paquetes de esta
  generación, `php artisan migrate` fallaba en una aplicación nueva con
  `CACHE_STORE=database` antes de crear la tabla `cache`, las rutas de la
  aplicación se cargaban otra vez por paquete y el correo de verificación se
  registraba repetido.
- **El README describía otro paquete** (comentarios polimórficos guardados en
  la base, publicar y borrar, `<livewire:comment :model=...>`). Se reescribe con
  lo que hace: incrustar el servicio externo y listar sus comentarios.

### Eliminado

- **`Models\Comment`.** No se podía cargar: usaba cinco traits
  (`CommentRelations`, `CommentStorage`, …) que nunca existieron en el
  repositorio, y `Innoboxrr\Traits` sin declararlo. Ningún código lo usaba.
- **La migración de la tabla `comments`.** Nadie la lee ni la escribe (los
  comentarios viven en el servicio externo) y creaba en la aplicación una
  tabla de nombre genérico que choca con la suya. Quien ya la corrió conserva
  la tabla; el paquete no la toca.
- **La ruta `POST blocks/{blockId}/user/{userId}/comments`
  (`lwc.comments.comments.store`).** Apuntaba a `CommentController@store`, que
  nunca existió, y como ruta `web` sin excepción de CSRF tampoco la podía
  llamar un servicio externo.

### Corregido

- **`GET block/{blockId}/user/{userId}/comments` fallaba siempre.** Validaba
  `blockId` y `userId` como entrada de la petición, y vienen en la ruta.
- **El avatar de un usuario inexistente** daba un error 500; ahora 404.
- **`vendor:publish --tag=lwc-config`**, la orden del README, no publicaba
  nada: la etiqueta era `config`. Ahora publica con las dos.

### Añadido

- Suite de pruebas: el paquete arranca en Laravel 13 (proveedores, clases,
  rutas, sin tabla de caché, sin duplicar rutas ni listeners de la
  aplicación), el componente se registra y renderiza, y las rutas con el
  servicio de comentarios simulado.
- CI con los flujos reutilizables de `innoboxrr/.github`: pruebas y
  `larapack:audit` en cada push y pull request, y etiqueta a partir de
  `VERSION` cuando pasan.
