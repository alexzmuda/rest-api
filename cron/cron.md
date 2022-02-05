### Set up cron
Edit your cronjob file by running `crontab -e` command

#### Add following command:
```
run converter every 4 minutes
*/4 * * * * php /path-to-converter-script
```
