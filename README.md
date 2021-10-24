# Sistema Web: Call of Data

## Integrantes del grupo:

- Joel Bra Ortiz
- Bosco Aranguren Sáiz
- Diego Marta Hurtado

## Método de despliegue del proyecto

Situar la terminal dentro de la carpeta SistemaWeb

Descargar docker:
```bash
$ apt-get install docker
```

Crear la imagen web:
```bash
$ docker-build -t="web" .
```

Iniciar los contenedores:
```bash
$ docker-compose up -d
```

Mediante un navegador, acceder a http://localhost:8890/ . 

Iniciar sesión con usuario *admin* y contraseña *test*. 

Hacer click en "database" y luego "import", donde elegiremos el archivo *SistemaWeb/database.sql*.

Acceder a http://localhost:81/ .

En caso de querer detener el proyecto, en otra terminal:
```bash
$ docker-compose down
```
