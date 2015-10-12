# FfsNodeAlarm

FfsNodeAlarm check online state of Freifunk Stuttgart node's. Users can select there sodes and setup a online Check-Task.

If FfsNodeAlarm trigger a task with a offline Node the user will get a e-mail

##Setup: 
* install composer: https://getcomposer.org/download/
* php composer install
* setup .env
* Setup DB: php artisan migrade
* add a Cron Job:  '* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1'
