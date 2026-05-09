# TODO: Fix “More than one MPM loaded” (Railway)

## Hecho
- Actualitzat `docker/web/Dockerfile` per eliminar múltiples mòduls MPM a `/etc/apache2/mods-enabled/` i forçar `mpm_prefork`.

## Próxims passos
1. Fer rebuild i redeploy a Railway (push a GitHub/GitLab o trigger del pipeline).
2. Revisar logs del container/Apache a Railway i verificar que NO apareix `AH00534: More than one MPM loaded`.
3. Confirmar que la web ja no retorna `502 Bad Gateway`.

