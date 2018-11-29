<?php 
    $success = false; // "Assume the worst"
    var_dump($_GET); // Sjekk om du fikk noe via GET (kommenter disse ut i prod)
    var_dump($_POST); // TSjekk om du fikk noe via POST
    
    $to   = "lasse@geek.no";    // Mottaker av skjema data
    $from = "noreply@geek.no";  // Default avsender (endres hvis et av form-feltene har nøkkelen email, se under)
    $msg  = "";                 // Tom streng til å bygge en e-post-melding

    if ($_GET) { // Sjekk om noe ble sendt via GET (method="get" i skjema)
        foreach ($_GET as $key => $value) { // GET er en array (liste), så vi går igjennom vha en for-løkke (foreach), som går igjennom alle nøkkel/verdi-par og skriver de ut, med en tabulator i starten av linjen og et linjeskift på slutten (et skjema felt per linje):
            $msg .= "\t"."$key: $value"."\r\n";
            if($key == "email") { // Hvis nøkkelen på et av feltene i skjema er "email", endre default sender til verdien av dette feltet (som vi har validert som en gyldig epost-adresse)
                $from = $value; 
            }
        }
    } elseif ($_POST) { // Hvis det IKKE ble sendt noe med GET, sjekk POST (method="post" i skjemaet). Hvis dette er tilfelle bygger vi meldingen med innholdet fra $_POST som også er en array (tilsvarende som over)
         foreach ($_POST as $key => $value) {
            $msg .= "\t"."Hemmelig $key: $value"."\r\n";
            if ($key == "email") {
                $from = $value; 
            }
         }
    } 

    if ($msg) { // Sjekk at vi har puttet noe inn i $msg (enten via post eller get)
        $msg = "Dette ble sendt inn:"."\r\n"."\r\n" . $msg; // Legger til litt ekstre
        // Sender to mailer: EN til skjemamottaker ($to) og en tilbake til den som fyller ut skjema ($from). PS! Hvis $from IKKE blir oppdatert så sendes den til default-avsender. Har "hardkodet" avsender på kvitteringen. 
        if (
            mail($to, "Mail from form test", $msg, "From: $from") && 
            mail($from, "Takk for din mail", $msg, "From: noreply@geek.no")
        ) {
        /* 
        For å teste dette på en Mac med MAMP så: 
        - Sjekk i Terminal App at sendmail is set up with 'which sendmail', og se om den svarer med '/usr/sbin/sendmail'
        - Sjekk MAMP sin phpInfo side og se om sendmail_path = "/usr/sbin/sendmail -t -i" (eller "sendmail -t -i").
        Dette SKAL være i orden fom. MAMP 4.4+
        PS! Hvis det er noe rot med dette, så kan du få "suksess" under uten at det faktisk sendes ut en mail.
         */ 
            $success = true; 
            # Success bare hvis begge mailene ble sendt!
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Sidetittel skrives ut basert på variabelen $success (true/false) -->
    <title><?= ($success)?"Success":"Failure"?></title>
    <style>
        * { font-size: 24px }
    </style>
</head>
<body>

<?php 
    // Lager to versjoner av denne siden
    // 1. Hvis $success er true - dvs mailen ble sendt
    if ($success):
?>
<p>The form worked!</p>
<p><a href="form.html">Back</a> / <a href="/">Home</a><p>
<?php 
    // 2. Hvis $success er false - dvs. (minst en) mail ikke ble sendt
    else:
?>
<p>Sorry, but something went wrong, please <a href="form.html">go back, and try again</a>!</p>
<?php 
    // Slutt på if...else...endif
    endif;
?>
<hr>
</body>
</html>