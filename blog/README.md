# Blog Basic Assets

Előre elkészített frontend oldali elemek a Blog feladathoz.

## Telepítés

1. Hozz létre egy új Laravel projektet, pl. `blog` néven:

    ```shell
    composer create-project --prefer-dist laravel/laravel blog
    ```

    Ezt követően lépj be a projekt mappájába:

    ```shell
    cd blog
    ```

2. Telepítsd a Laravel UI (User Interface)-t:

    ```shell
    composer require laravel/ui
    ```

3. A Laravel UI csak egy parancsot tesz elérhetővé, önmagában nem hoz létre semmilyen UI-t, azt neked kell a Laravel UI által bevezetett parancs segítségével létrehoznod. Az alábbi parancsot add ki, hogy Bootstrap 5-tel inicializálja a felhasználói felületet:

    ```shell
    php artisan ui bootstrap --auth
    ```
    - Fontos az `--auth` kapcsoló is, mivel azzal kigenerálja a teljes layoutot.
    - Utána kéri, hogy adj ki parancsokat, de még ne adj ki semmit, hanem kövesd továbbra is ezt az útmutatót.

4. :warning: (Fontos) Ezen a ponton másold be az itt lévő `public`, `resources` és `routes` mappát, rekurzívan felülírva a projektben az esetleges fájlokat. Másold át a `webpack.mix.js` fájlt is.
    - Amikor a 3. pontban kigenerálod a UI-t, akkor a `resources` mappában létrejönnek a UI-hoz tartozó blade fájlok. Ezért különösen fontos a 3. és a 4. pont egymás utánisága, vagyis az, hogy **előbb** generáld ki az alap UI-t (3. pont), és itt, a 4. pontban **írd felül** a generált fájlokat a **blog kezdőcsomag** fájljaival!

5. A Laravel UI inicializálta a `package.json`-t, azonban az npm-es csomagokat még külön telepíteni kell:

    ```shell
    npm i
    ```

6. Továbbá szükséges még egy npm-es csomag telepítése az ikonkészlet miatt:

    ```shell
    npm i -D @fortawesome/fontawesome-free
    ```

7. Ezt követően futtatni kell a Laravel Mix nevű programot. Ennek **nagyon leegyszerűsítve** az a lényege, hogy amikor a Laraveles projektedet megnyitod a böngészőben, akkor a `public` mappát tölti be, azonban mivel a `node_modules` mappát nem éred el, így onnan valahogyan át kéne kerüljenek a csomagok a `public`-ba. Ezt végzi el a Laravel Mix a `webpack.mix.json` alapján. Nyugodtan futtathatod production módban, kisebb lesz a kimenete:
  
    ```shell
    npm run prod
    ```

    - Elképzelhető, hogy első alkalommal 2x is futtatni kell a parancsot, de ezt úgyis kiírja.

8. Futtasd a Laravelt az alábbi parancs segítségével:

    ```shell
    php artisan serve
    ```

9. Nyisd meg a [http://localhost:8000/posts](http://localhost:8000/posts) oldalt, és ellenőrizd, hogy ezt a kimenetet látod-e:

    ![Főoldal előnézete](https://raw.githubusercontent.com/szerveroldali/blog_basic_assets/main/preview.png)

    - Ha minden megjelenik, amit a képen is látsz (gombok, ikonok, stb), akkor jól dolgoztál és sikeresen inicializáltad a blog feladat alapját. :)
