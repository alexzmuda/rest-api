# Sample REST API

### Problem
Your customer wants to execute a job that takes more than 2 minutes to execute.
The job is about format conversion: your customer will send you a file and he will get back
the converted version of the file.

### Execution 
Write an API to let your customer ask to execute a long running job.
The job does not need to execute a real conversion, a sleep will be enough.

#### Instructions
* use the PHP programming language
* write code according to PSR-1 and PSR-12 coding standard
* write comments to facilitate reading for reviewers
* write tests
* no need to have an executable project
* use GIT and write well formed commit messages


### Solution
New conversion item will be added to conversion table in database.
Conversion item will be added with flag processing = 0.
Cron job will launch and pick conversion items with processing flag = 0 and do following procedure:
* pick conversion item with processing flag = 0
* getmypid() of current process 
* store getmypid() value into record
* change status of processing = 1

This is required to avoid concurrency and collision i.e. if 2 jobs want to process same conversion item.

Additionally, there should be a solution to validate if cron job did not stucked, 
and if it has stuck - reset processing flag to 0

There will be two endpoints:
1. run conversion
2. check conversion status

---
##### Things to do in next steps (not covered here)
* add limit of concurency workers - 3.
* multiple workers, scaling.  


### test
```
# run composer
composer install

# env
cp .env.example .env 

# adjust env parameteres

# set up database (using db.sql file in ./database)

# run seeder
cd database
php seeder.php

# run server
php -S 127.0.0.1:8000 -t public

# fetch all conversions
curl -X GET http://127.0.0.1:8000/conversion

# fetch conversion
curl -X GET http://127.0.0.1:8000/conversion/1

# create conversion
curl -X POST -d '{"name":"testfile"}' http://127.0.0.1:8000/conversion

# update status to await
curl -X PUT -d '{"status": 0}' http://127.0.0.1:8000/conversion/1

# update status to processing
curl -X PUT -d '{"status": 1}' http://127.0.0.1:8000/conversion/1

# update status to processed
curl -X PUT -d '{"status": 2}' http://127.0.0.1:8000/conversion/1

# delete conversion
curl -X DELETE http://127.0.0.1:8000/conversion/2


```
