<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -->

<script>
    var type = "<?php 
    if (sizeof($types) > 0) {
        echo $types[0];
    } else {
        echo "";
    }
            ?>";
    
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getPlaces(page, type);
            }
        }
    });

    $(document).ready(function() {
        $(document).on('click', '.nav-pills li a', function (e) {
            var hash = $(this).attr('href').replace('#', '');
            type = hash;
            e.preventDefault();
        });
        $(document).on('click', '.pagination a', function (e) {
            getPlaces($(this).attr('href').split('page=')[1], type);
            e.preventDefault();
        });
    });
    
    function getPlaces(page, type) {
        $.ajax({
            url : '?page=' + page + '&type=' + type,
            dataType: 'json'
        }).done(function (data) {
            $('#' + type).html(data);
            location.hash = page;
        }).fail(function () {
            alert(type.replace("_", " ") + ' could not be loaded.');
        });
    }   
    
    $(window).on("load", function() {
       $('a[data-toggle=tab]').each(function() {
          $el = $(this);
          $i = $el.find('i');
          $type = $el.find("span").html().replace("#", "");
          $i.addClass("tab-" + $type[0]);
       });
    });
</script>