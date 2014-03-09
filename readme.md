##instafetch

Kleines Script zum sammeln von Instagram-Fotos mittels #hashtag. Das Script nutzt den Instagram RSS-Feed und benötigt daher keinen API Zugang.

###Installation für MODX

1. Snippet mit Namen "instafetch" anlegen und Script hineinkopieren
2. Dokument für Cronjob anlegen und dort das Snippet wie folgt aufrufen: [[!instafetch? &cronjob=`1`]]
3. Cronjob für soeben angelegtes Dokument erstellen und alle 5min ausführen
4. Snippet an gewünschter Stelle ausgeben: [[!instafetch]]
