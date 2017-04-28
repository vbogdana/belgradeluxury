<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -->

<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        <div>
            <p> Ime i prezime: {{ $name }} </p>
            <p> Broj telefona: {{ $phone }} </p>
            <p> Email: {{ $email }} </p>
            <p> Upit za: {{ $object }} </p>
            <p> URL: <a href='{{ $route }}' target='_blank'>{{ $route }}</a> </p>
            <p> Datum dolaska: {{ $date_start }} </p>
            <p> Datum odlaska: {{ $date_end }} </p>
            <p> Broj ljudi: {{ $people }} </p>
            <p> Poruka:  {{ $content }} </p>
        </div>
    </body>
</html>
