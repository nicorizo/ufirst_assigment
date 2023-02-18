# UFIRST

UFirst Test by Nicolás Rizo. Please read the full readme first.

Considerations:
- I will send the full project zip. So you can run ASAP
- I will give you repo URL 


## Tech Stack
#### Docker (PHP 8.1, NGINX)
#### Symfony
#### React + Stimulus JS


## Setup

#### From repo

```bash
$ git clone https://github.com/nicorizo/ufirst_assigment
$ cd ufirst_assigment
$ make build
$ make run
$ docker exec -it --user root docker-ufirst_assigment-be mkdir var
$ docker exec -it --user root docker-ufirst_assigment-be chmod -R 777 var
$ docker exec -it --user root docker-ufirst_assigment-be chown -R appuser:appuser vendor
$ make composer-install
$ make ssh-be
$ yarn install
$ yarn encore production
```

#### From Zip

```bash
$ make build
$ make run
#issues with folders? run outside docker
#$ docker exec -it --user root docker-ufirst_assigment-be mkdir var
#$ docker exec -it --user root docker-ufirst_assigment-be chmod -R 777 var
#$ docker exec -it --user root docker-ufirst_assigment-be chown -R appuser:appuser vendor
```

## Command

Use the command to generate json file.

```bash
$ make ssh-be
$ bin/console app:create-json-data-file
```

## Graphics (browser)
## Here I think I made a mistake. I've created endpoints to retrieve each graph's data

#### So, In order to see the graphics, with server side data you should go to http://127.0.0.1:8009/ in your browser
#### There is no need to run the command before. The app will create the file if not exist.

### But the test says "your solution may run on a web server but ..... and static html/js"
#### So, In order to see the graphics, with NO server side data 
#### you should go to http://127.0.0.1:8009/static.html (yes throw the server ) 
#### or just double-click the file static.html located in public/
#### You must run the command before if the file is not created.
#### This is a non server side APP version

## Tests

```bash
$ make ssh-be
$ php bin/phpunit
```

### I think there is an error in the sentence of the test:
#####  " There were 47748 total requests, 46014 GET, 1622 POST, 107 HEAD, 6 invalid "
##### So 47748 - 46014 - 1622 - 107 - 6 = -1
##### For me there are 106 HEAD request


