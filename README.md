## Instalação 
### Requisitos
 - Docker
 - Porta 80 liberada.
 - banco mysql configurado:
    - https://github.com/brediweb/banco-mysql-5.7

Execute um dos seguintes comandos na pasta raiz do projeto:

bash
```
bash install.sh
```

## Comandos úteis
```
./vendor/bin/sail artisan migrate
```
```
./vendor/bin/sail artisan key:generate
```

Endereço de acesso: http://localhost
