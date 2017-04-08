# FfsNodeAlarm

FfsNodeAlarm check online state of Freifunk Stuttgart node's. Users can select there nodes and setup a online Check-Task.

If FfsNodeAlarm triggers a task with a node which is offline, the user will get an e-mail.

## Setup: 
* install composer: https://getcomposer.org/download/
* php composer install
* setup .env
* Setup DB: php artisan migrate
* add a Cron Job:  '* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1'
