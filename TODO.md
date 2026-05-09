# TODO.md

## Correcció (Tasca 7)

- [x] El _middleware_ `IsAdmin` existeix, però no s'utilitza en cap ruta i a més té un error (`$request->check()` hauria de ser `auth()->check()`)
- [x] Les rutes `/admin`, `/monitor` i `/client` només estan protegides amb _auth_, no amb el _middleware_ de rol, de manera que qualsevol usuari autenticat podria intentar accedir-hi directament. La protecció real no ha d'estar al controlador, ha d'estar a la ruta.
- [x] **La més important**. Qualsevol `CLIENT` autenticat pot eliminar la reserva d'un altre `CLIENT` si coneix l'ID de l'URL, perquè no es comprova que la reserva pertanyi a qui fa l'acció. Això és una vulnerabilitat real que cal solucionar.