# Tema_5_TSS_Gavrila_Vlad-Theodor_si_Dorian_Istrate
Acesta este repository-ul pe care se va incarca tema 5 de la materia Testarea sistemelor

Aplicația noastră este una frontend și backend, folosind PHP, și Mysql (cu mariaDB). Serviciul este unul de notițe, care permite crearea unei note 
cu un titlu, conținut text (de tip longtext) și este salvată data creării pentru a face mai facilă sortarea sau criteriile de menținere a unei evidențe
a utilizatorului. Partea de frontend constă dintr-un index, unde avem formularul de trimitere, și unde putem vedea notițele din baza de date. Restul fișierelor
reprezintă acțiuni de tip CRUD, (putem crea notiță în baza de date, putem citi toate notițele, putem edita notițe într-o pagină separată, și sterge o notiță).
Avem în src fișierele index.php, delete.php, edit.php, insert.php. În tests avem, deleteTest.php, editTest.php, indexTest.php, insertTest.php, unde la testul de delete
avem 2 scenarii. Vom începe prin a prezenta cum am folosit biblioteca, după care vom explica fiecare script in parte, de ce am ales aceste scenarii, și ce am întâmpinat
în crearea designului.

Aplicatia are ca referinta codul de la acest repozitoriu, testele fiind create de noi. https://github.com/yogeshgiri904/to-do 

La începutul fiecărui script, includem biblioteca PHPUnit în felul acesta "use PHPUnit\Framework\TestCase;". Structura fiind similară la fiecare test, face posibilă crearea unor scaffolds plecând de la acelasi template, din moment ce nu sunt dependințe diferite, dar proiectul nefiind unul amplu nu am combătut boilerplate code.
Fiecare clasă de test moștenește clasa TestCase, deci implicit și metodele sale. În fiecare caz am instanțiat cu metode private conexiunea la baza de date, iar metodele de test le am declarat publice pentru a fi vizibile de către PHPUnit.

Pentru Testul de Delete, am considerat 2 scenarii, cel în care vrem să verificăm dacă s-a șters o notă, și cel în care verificăm dacă nu cumva vrem să ștergem un ID inexistent. Le-am denumit testDeleteNote(), testDeleteNonExistingNote(). De obicei se folosesc instanțe mockup, metode sau clase după caz care au o structură mai simplificată a featureului. În cazul nostru acest lucru se poate face și replicînd aceleași funcționalități, fiind puține linii de cod. Pentru testDeleteNode experimentul a constat în a insera o valoare de test, iar ulterior de a aplica queryul de ștergere din baza de date pentru acel id. Metoda assertTrue moștenită din 
clasa TestCase, verifică dacă rezultatul metodei mysqli_query este nenul, adică dacă s-a produs cu succes queryul. Următorul experiment constă din a face un query
pentru a verifica dacă cumva notita stearsa a ramas în baza de date. Metoda assertEquals moștenită din clasa TestCase, Verifică dacă numărul de înregistrări pentru idul
șters este egal cu 0. Pentru testul în care vedem dacă se șterge un id inexistent, încercăm să ștergem un id arbitrar care nu exista in BD, și verificăm dacă queryul s-a executat cu succes sau nu.

Pentru featureurile de edit, insert, fetch am aplicat o structură și un raționament similar, așa cum am menționat mai sus. Pentru restul nu am verificat ca și la delete, scenariu în care am putea accesa un id inexistent, deoarece celelalte operațiuni nu implică modificări asupra id-ului. Cu toate acestea, dacă am fi implementat feature de sortare și căutare, am fi aplicat pentru fetch după id un test similar.

Testele se ruleaza ducîndu ne in directorul cu php unit și dand ca parametru folderul tests.

Observații și concluzii legate de implementarea designului, constau în faptul că PHPUnit a făcut mult mai facilă testarea decît dacă rulam direct codul și așteptam să apară erori, și să căutăm pe moment cazuri. De exemplu, phpunit imi arata in terminal erori daca incercam sa fac o asertie necorespunzatoare responseului (la fetchul pentru toate notitele, initial voiam sa folosesc tot assertTrue, dar pentru fecthuri de mai multe randuri functia mysqli_query nu returneaza un boolean ci un obiect in cazul in care s-au fetchuit mai multe randuri)


