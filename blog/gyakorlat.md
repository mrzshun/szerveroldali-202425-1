https://laravel.com/docs/11.x/encryption
Ha fel akarjuk telepíteni az alkalmazást letöltés után, akkor app key-t kell generálni a .env fájlba, amelyet a .env.example duplikálásával és átnevezésével állítunk elő
Parancs:
php artisan key:generate


Migrációk:
https://laravel.com/docs/11.x/migrations

Futtatás:
php artisan migrate
php artisan migrate:fresh

Seeder:
https://laravel.com/docs/11.x/seeding

php artisan db:seed
php artisan migrate:fresh --seed


Artisan, Tinker:
https://laravel.com/docs/11.x/artisan
https://laravel.com/docs/11.x/artisan#tinker

Artisan parancsok listája:
php artisan list

Belépni Tinkerbe és kipróbálni migráció után:
User::count()
User::all()
User::find(1)


Laravel ORM: Eloquent
https://laravel.com/docs/11.x/eloquent

Collection-ök:
https://laravel.com/docs/11.x/collections

Blog feladat

Adatmodell:
Blogposztok     Post
Kategóriák      Category
Felhasználók    User // Laravel beépített User modeljét használjuk

Kapcsolatok - később:
posztok kategóriákhoz kapcsoltak, egy poszthoz több kategória lehet
posztoknak lehet szerzője, egy db, de nem kötelező 

Post: title, description, hidden, author (később), text
Category: name, text_color, bg_color

Modellek közötti relációk

https://webprogramozas.inf.elte.hu/#!/subjects/webprog-server/handouts/laravel-04-rel%C3%A1ci%C3%B3k

1-1 adatkapcsolat
1-n adatkapcsolat // 1-sok
n-n adatkapcsolat // sok-sok, n-m

1-1 - állampolgár és személyi igazolvány
1-sok - állampolgár és autó
sok-sok - blogposzt - kategória