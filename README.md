# API-Ripetizioni

==============================
 APPLICAZIONE WEB: RIPETIZIONI
==============================

Autori: Chatibi Meriam, Edbiri Elias, Caroti Gianni, Parrini Gabriele
Data: Maggio 2025
Tecnologie: PHP, MySQL, HTML, CSS, JavaScript


 DESCRIZIONE
------------------------------
Questa applicazione web permette la gestione delle ripetizioni scolastiche, consentendo a studenti e tutor di registrarsi, selezionare una materia e visualizzare o offrire disponibilità per ripetizioni.


 RUOLI
------------------------------
- STUDENTE:
  • Seleziona la materia di cui ha bisogno.
  • Visualizza i tutor disponibili per quella materia.
  • Può selezionare un tutor per ricevere ripetizioni.

- TUTOR:
  • Inserisce la materia che può insegnare.
  • Viene registrato come disponibile per quella materia.


 STRUTTURA DEL PROGETTO
------------------------------
- ripetizioni.html / paginaStudente.html / paginaTutor.html
  • Pagine di accesso per ciascun ruolo.
  • Utilizzano moduli GET per inviare dati.

- phprova.php
  • Riceve i dati del form.
  • Aggiorna il database con la materia selezionata.
  • Per gli studenti, mostra una tabella con i tutor disponibili.

- finale.php
  • Gestisce la selezione definitiva dello studente verso un tutor.

- stileAPI.css
  • File di stile per form, bottoni, tabelle e layout.
  • Utilizzato da tutte le pagine HTML e PHP.


