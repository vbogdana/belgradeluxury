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
            <p> Email: {{ $email }} </p>
            <p> Drzava: {{ $country }} </p>
            @if ($subject === "Business inquiry")
            <p> Kompanija: <?php echo $company ?> </p>
            <p> Website: <?php echo $website ?> </p>
            @endif
            <p> Poruka:  {{ $content }} </p>
        </div>
    </body>
</html>
