<?
    // Feladat: olvassuk be a blogposztokat a korábban előállított JSON fájlból
    // listázzuk ki a blogposztokat a címükkel, szerzőjükkel és összefoglalójukkal
    // és linkeljünk a blogposzt végoldalára. Ha a GET mezőben kapunk egy ID-t,
    // akkor keressük meg, hogy van-e olyan blogposzt és ha igen, akkor azt jelenítsük meg.
    // ha nincs, jelezzük, hogy az adott ID-val nem szerepel poszt az "adatbázisban"

    // be kell tölteni a fájlt
    // megnézni, hogy adott-e get mezőben az ID - isses($_GET['id'])
    // végigiterálunk a betöltött JSON-on és keressük az ID-t
    // ha nem találjuk ($post == null, erre inicializálunk), akkor unknown, ha megtaláljuk, akkor létrehozzuk a $post-ot
    // a html-ben pedig megnézzük, hogy volt-e ID, ha igen, akkor $post alapján kiírjuk annak adatait, vagy azt, hogy nem volt ilyen blogposzt
    // ha nem volt ID, akkor listázzuk az összeset.

?>