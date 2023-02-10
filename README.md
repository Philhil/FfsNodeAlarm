# FfsNodeAlarm

FfsNodeAlarm check online state of Freifunk Stuttgart node's. Users can select their nodes and setup an online check-task.

If FfsNodeAlarm triggers a task with a node which is offline, the user will get an e-mail.

## Setup: 
* install composer: https://getcomposer.org/download/
* `php composer install`
* `setup .env`
* Setup DB: `php artisan migrate`
* add a cron job:  `* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1`
