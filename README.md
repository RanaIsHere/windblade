<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Windblade

This project is created for a school project that will never be used in a real-life circumstances, other than learning purposes. Windblade uses Laravel 8, TailwindCSS, and DaisyUI to style the website appearance and uses minimal JQuery.

# Indonesian Documentation

Project ini menggunakan TailwindCSS dan Laravel 8. Secara requirement membutuhkan:

+ NodeJS 16
+ Composer
+ PHP 8.0^

Silahkan clone project ini dengan melakukan, dan masuk ke dalam folder tersebut setelah sudah di clone:

```
    git clone https://github.com/RanaIsHere/windblade.git
    cd windblade
```

Untuk melakukan pertama setup, lakukan pertama installan dengan Composer dan NodeJS package manager:

```
    composer install
    npm install
```

Jika semua installan sudah selesai, lakukan pembuatan .env file untuk koneksi dengan database MySQL:

```
    cp .env.example .env
```

Dan edit .env file tersebut dengan ketentuan project yang ada, jika sudah diganti dengan ketentuan, lakukan:

```
    php artisan key:generate
```

Setelah itu, membuat database dengan nama tertentu yang ada di dalam .env file kamu, contohnya:

```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=windblade
    DB_USERNAME=root
    DB_PASSWORD=
```

Selesai? Jalankan command instruksi ini untuk membangkitkan aplikasi dan menyelesaikan setup:

```
    php artisan migrate:fresh --seed
```

Sesudah dan sukses? Jalankan website melalui dua command yang tidak boleh di close:

```
    php artisan serve
    npm run watch
```

Selamat, project ini berjalan!