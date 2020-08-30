# Web Technologien Abschlussarbeit
Dieses Repository beinhaltet die Abschlussarbeit aus dem Modul Web Technologien aus dem Frühlingssemester 2020 an der HSLU.<br>
Diese Arbeit wurde an einer anderen Form von MEP vorgezogen. Für eine genaue Erklärung lesen Sie bitte die Aufgabenstellung (siehe Verzeichnisstruktur).

## Themenwahl
Ich habe mich für den Zinses Zins Rechner entschieden.<br>

### Information
Erklärung was Zins ist und wie Rechner funktioniert!
(z.B. 30 Tage/Monat, 360Tage/Jahr, 12 Einzahlungen, etc.)

### Formular
1. Name --> input type=text
2. Kapital --> input type=number (muss weniger als billiarden Bereich sein)
3. Währung --> Radiobutton/Dropdown
4. Monatliche Zahlung --> input type=number
5. Zinssatz

### Canvas
Beim Canvas Element habe ich ein Dollar Zeichen gezeichnet.

### Zusatzfunktion:
Die Zusatzfunktion besteht aus einem Währungsumrechner.
Die Umrechnungswerte werden in der DB gespeichert.

### Cookie
Der Name wird in einem Cookie abgespeichert und beim erneuten aufrufen der Seite gleich erfasst.

## Verzeichnisstruktur
Die Struktur wurde aus der Aufgabenstellung übernommen.<br>
Der Hauptordner trägt den Namen des Erstellers. Dieser wurde zum Bewerten abgegeben.<br>
Der Ordner "doc" beinhaltet die Aufgabenstellung, sowie allfällige Dokumentation, welche während der Bearbeitung entstehen könnte.

## Zeitlicher Rahmen
Die Aufgabenstellung wurde am 11.05.2020 veröffentlicht.<br>
Der Abgabetermin war am 26.06.2020 um 23:59 Uhr.<br>
Damit beläuft sich die verfügbare Zeit auf ca. 7 Wochen.<br>
Die Aufgabe muss in der Freizeit bearbeitet werden.

## Verwendung/Ausführung
Das Projekt wurde mit/für Xampp erstellt. 
Es ist empfohlen, die Seite auch damit zu verwenden.
Andere Tools wurden nicht getestet!

### Setup
Starten Sie XAMPP.<br>
Klicken Sie auf "Config" beim "Apache"-Module.<br>
Wählen Sie "Apache (httpd.conf)" aus.<br>
Fügen Sie einen ALIAS Eintrag hinzu:
    
    Alias /webtech "C:/WebTechAbschlussarbeit/WEBT_FS20_KRAEMER_YANNIS/"

Speichern Sie die Datei.<br>
Starten Sie Apache mit einem Klick auf "Start".<br>
Starten Sie MySQL  mit einem Klick auf "Start".<br>
Öffnen Sie phpMyAdmin (MySQL) im Browser mit dieser URL:

    http://localhost/phpmyadmin/sql.php

Klicken Sie links in der Seitenleiste auf "Neu".<br>
Klicken Sie oben im Menu auf "SQL".<br>
Kopieren Sie den vollständigen Inhalt aus schema.sql in den Editor.<br>
Klicken Sie unten rechts auf "Ok".<br>
Sie sollten eine Bestätigung bekommen, dass alles ausgeführt werden konnte. Sie haben nun erfolgreich die Datenbank mit Daten angelegt.<br>
Öffnen Sie nun die Webseite über:

    http://localhost/webtech/

## Verwendung von Git
Ich habe mich entschieden Git als Versionskontrolle zu verwenden.
Git wurde anderen Tools gegenüber vorgezogen, da ich bereits viel Erfahrung damit habe und es sehr etabliert ist.

Warum eine Versionskontrolle verwendet werden sollte, können Sie [hier](https://www.atlassian.com/git/tutorials/what-is-version-control) nachlesen.

In diesem Projekt werden grundsätzlich keine Branches verwendet, da es nur einen einmaligen Release gibt, wobei keine nachträglichen Versionen möglich sind.
Der zusätzliche Aufwand macht für mich hier keinen Sinn.

## Technologien, Programmiersprachen und Libraries
Folgende Technologien wurden für dieses Projekt verwendet:
- JavaScript
- CSS
    - [w3.css](https://www.w3schools.com/w3css/4/w3.css)
- HTML5
- PHP

Auf zusätzliche Libraries wurde möglichst verzichtet, da diese nicht erlaubt waren (siehe Aufgabenstellung) und das Projekt nur unnötig kompliziert machen würden.

## Abkürzungsverzeichnis
DB = Datenbank<br>
MEP = Modulendprüfung<br>
HTML = Hypertext Markup Language<br>
z.B. = zum Beispiel<br>
