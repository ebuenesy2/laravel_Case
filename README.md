# Müşteri İşlemleri

##  Version
```
V1.0.0
```

## Çalıştırma
```
php artisan serve
```

## Site Adresi
```
http://localhost:8000/
```

## Port Değişitirme
```
php artisan serve --host=localhost --port=8080
``` 
 
## Başlangıc [ vendor ]  Yükleme
```
composer i
``` 
```
composer update
```

## İçindekiler
```
Middleware
Migration
Seeder
Model
Excel Toplu Yükleme
```

# Veri Tabanı İşlemleri

## Veri Tabanı Oluşturma [ migrate ]
```
php artisan migrate
```

## Veri Tabanı - Verileri Başlangıcta Kaydetme [ seeder ]
```
php artisan db:seed
```
```
php artisan migrate:fresh --seed
```
