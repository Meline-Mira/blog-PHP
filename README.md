# Blog Emeline Numérique

## Lancer le projet en local

```
php -S localhost:8000 -t public
tailwind -i ./assets/css/main.css -o public/css/main.css --watch
```

## Compiler le CSS pour la production

```
tailwind -i ./assets/css/main.css -o public/css/main.css --minify
```
