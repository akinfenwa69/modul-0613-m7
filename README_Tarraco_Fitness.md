# Projecte DAW – Gestió de Classes, Usuaris i Valoracions

Aquest projecte permet gestionar usuaris, classes, reserves i valoracions dins d’un gimnàs, utilitzant Laravel 12 amb PHP 8.4, integrat amb MySQL i Docker.
Inclou tot l’entorn de desenvolupament, sense necessitat d’instal·lar PHP o MySQL localment.

## Entitat migrada i justificació de les decisions preses

| Entitat | Taula DB | Justificació |
|-------|-------------|-------------|
| Usuari | usuaris | Emmagatzema les dades dels usuaris: nom, cognom, correu electrònic, telèfon i rol (CLIENT, MONITOR, ADMIN). |
| Sala | salas | Emmagatzema les dades de les sales: nom, descripcio, capacitat |
| Classe | classes | Representa les activitats ofertes amb horari, dia i places disponibles. |
| Reserva | reservas | Emmagatzema les dades de les reservas: data inici, data final |
| Valoració | valoracions | Permet als usuaris valorar les classes amb títol, descripció i estrelles (1-5). |

## Estructura del CRUD final


**Models**
- ``Usuari``, ``Classe``, ``Reserva``, ``Valoracio``, ``Sala``.
- ``$fillable`` definit per evitar errors de mass assignment.
- ``$timestamps`` desactivat on no necessari

**Controladors**
- ``UsuariController``, ``SalaController``, ``ReservaController``, ``ValoracioController``, ``SalaController``.
- Funcions: index, create, store, edit, update, destroy.
- Validació amb Request->validate() abans de crear o actualitzar dades.

**Vistes**
- Blade templates amb _form.blade.php compartits entre create i edit.
- Layout base ``layout.blade.php`` amb ``TailwindCSS``.
- Index amb paginació ``(paginate(10))`` i accions CRUD.


## Validacions i bones pràctiques aplicades

- Validació de camps amb required, string, integer, enum, date_format.
- Ús de ``$fillable`` i firstOrCreate per evitar duplicats.
- Separació de _form.blade.php per reutilitzar codi entre create i edit.
- Paginació per llistats llargs.
- TailwindCSS per estil i consistència visual.

## Tasques i rols de cada membre

| Membre | Tasca principal |
|--------|-------------|
| Júlia  | MVC de ``classes``, ``sala``, ``valoració``, ``reserva``, documentació i estructura final de laravel |
| Pol    | MVC d'``usuaris``, documentació i estructura base de ``laravel`` |
| Andreu | MVC de ``reserva`` |
| Alex   | - |

## Tasques i rols de cada membre

**Crear migracions**

``php artisan make:migration create_usuaris_table``

``php artisan make:migration create_classes_table``

``php artisan make:migration create_reservas_table``

``php artisan make:migration create_valoracions_table``

**Crear models amb controlador i migració**

``php artisan make:model Usuari -mcr``

``php artisan make:model Classe -mcr``

``php artisan make:model Reserva -mcr``

``php artisan make:model Valoracio -mcr``

**Executar migracions**

``php artisan migrate``

**Crear dades de prova**

``php artisan tinker``

**o rutes específiques per crear usuaris, classes, reservas i valoracions**
