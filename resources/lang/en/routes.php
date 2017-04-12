<?php

/*
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  - */

return [
	'contact' => 'contact',
    'package' => 'packages/{title}-package',
	'accommodation' => 'services/accommodation',
	'accommodation.single' => 'services/accommodation/{accID}-{title}',
	'hotel' => 'services/accommodation/hotel/{accID}-{title}',
	'vehicles' => 'services/vehicles',
	'vehicle' => 'services/vehicles/{vehID}-{title}',
	'host' => 'services/host',
	'nightlife' => 'services/nightlife',
	'gastronomy' => 'services/gastronomy',
	'place' => 'services/place/{placeID}-{title}',
	'security' => 'services/security',
	'sightseeing' => 'services/sightseeing',
	'wellness-&-spa' => 'services/wellness-&-spa',
	'tickets' => 'services/tickets',
	'business' => 'services/business',
	'personel' => 'services/personel',
	'diamond' => 'services/diamond',
	'places.reservation' => 'services/reservation/{placeID}-{title}',
	'events.reservation' => 'services/reservation/{placeID}-{title}/{evID}',
	'reservation' => 'services/reservation',
];