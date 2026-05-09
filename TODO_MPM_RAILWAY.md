# TODO: Fix “More than one MPM loaded” (Railway)

## Hecho
- Editado `docker/web/Dockerfile` para intentar resolver `AH00534` eliminando `mpm_*.load` y `mpm_*.conf` en `/etc/apache2/mods-enabled/` y dejando solo `mpm_prefork`.

## Pendiente (ahora)
- Segue apareciendo el mismo error tras el deploy.

## Próximos pasos
1. Cambiar la estrategia: en vez de tocar solo `mods-enabled`, deshabilitar explícitamente los MPM activos en Apache usando `a2dismod mpm_*` y luego `a2enmod mpm_prefork` (para evitar que Railway nos deje ambos `.load`/`.conf` o que haya configs en otro sitio).
2. (Opcional) Forzar desinstalación/limpieza de módulos MPM no deseados si existen en la imagen base.
3. Rebuild y redeploy.
4. Validar en logs que solo hay un MPM inicializado.

