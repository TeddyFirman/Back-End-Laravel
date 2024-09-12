<h1 align="center">Challenge Backend Laravel</h1>

## Author

Dikembangkan oleh :

- Github : <a href="https://github.com/TeddyFirman"> Teddy Firman Winarto </a>
- Inspiring: https://roadmap.sh/projects/todo-list-api

## Fitur 

- Autentikasi Admin dan User
- CRUD Postingan
- CRUD Komen
- CRD User (oleh Admin)
- RD Postingan (oleh Admin)
- Search Postingan dari keyword = judul postingan atau postingan
- Dan lain-lain (Bisa di improve lagi)

## User

**Admin**

- email: admin@gmail.com
- Password: password

**User**

- email: user@gmail.com
- Password: password

## Install

**Clone Repository**

```bash
git clone https://github.com/TeddyFirman/First-Laravel-Project-84.git
```

**Download zip**

```bash
extract file zip
```

## Buka di kode editor


## Install composer

```bash
composer install
```

## Copy .Env

```bash
copy .env.example menjadi .env
```

## Buka Web Server


## Buat database di localhost 

```bash
nama database : <Sesuai keinginan kalian>
```

## Setting database di .env

```bash
DB_PORT=3306
DB_DATABASE=<Sesuai keinginan kalian>
DB_USERNAME=root
DB_PASSWORD=
```

## Generate key

```bash
php artisan key:generate
```

## Jalankan migrate dan seeder

```bash
php artisan migrate --seed
```


## Jalankan Serve

```bash
php artisan serve
```

## 1. Penjelasan Project
 - Project ini terinspirasi dari aplikasi X atau sosial media lainnya, dimana user di aplikasi ini bisa CRUD Postingan dan Komen tetapi di aplikasi ini juga terdapat admin untuk authorization atau "super admin" dimana admin bisa mengelola user dan postingan untuk kenyamanan aplikasi ini, tentu masih banyak yang bisa di improve lagi dari project ini

## 2. Desain Database
<img width="666" alt="design_database" src="https://github.com/TeddyFirman/Backend_Laravel/assets/44187690/014aef45-43ff-4d0d-b15c-f1ed910a5843">

Dimana sesuai gambar diatas ada user yang bisa CRUD table posts dan comments, dimana logika relasinya yaitu: 
 - 1 **user** bisa mempunyai banyak **posts**
 - 1 **user** bisa mempunyai banyak **comments**
 - 1 **posts** bisa mempunyai banyak **comments**
 - NB : **user admin** bisa mengelola **user** dan **posts**

## 3. Screenshoot Aplikasi 
Karena project ini backend maka tidak ada yang bisa ditunjukkan.

NB: Saya lampirkan hasil dari postman di repo ini pada folder app/Http/API

## 4. Dependency
 - Database MySQL
 - PHP
 - Composer
 - Postman / Aplikasi penguji API lainnya
 - Web Server (Laragon / XAMPP atau lainnya)
 - Text Editor

## License

- Copyright © 2024 TeddyFirman.
