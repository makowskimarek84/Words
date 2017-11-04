#!/bin/sh
APACHEUSER=`ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data' | grep -v root | head -1 | cut -d\  -f1`
setfacl -R -m u:"$APACHEUSER":rwX -m u:`whoami`:rwX var/cache var/logs var/sessions/ var/spool/
setfacl -dR -m u:"$APACHEUSER":rwX -m u:`whoami`:rwX var/cache var/logs var/sessions/ var/spool/
