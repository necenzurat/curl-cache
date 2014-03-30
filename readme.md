Curl Cache
=

A uber simple curl with caching for every type of urls. 
````
There are only two hard things in Computer Science: cache invalidation and naming things.

-- Phil Karlton
````

Usage
=====

````
require "my_awesome_direcotry_structure/cache.php";
$data = cache_url('http://requestb.in/nub0zsnu', "appID=123&appKEY=321", TRUE);
````


Settings
=====

cache.php, line 12 and line 13

$cachetime = 43200; // 6hours, in seconds
$where = "cache"; // the caching directory


License
=====

````
     DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE 
                    Version 2, December 2004 

 Copyright (C) 2014 necenzurat <necenzurat+from-license@gmail.com> 

 Everyone is permitted to copy and distribute verbatim or modified 
 copies of this license document, and changing it is allowed as long 
 as the name is changed. 

            DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE 
   TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION 

  0. You just DO WHAT THE FUCK YOU WANT TO.
````



