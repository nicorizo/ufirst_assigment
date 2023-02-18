# UFIRST

UFirst Test by Nicolás Rizo. Please read the full readme first.


## Tech Stack
#### Docker (PHP 8.1, NGINX)
#### Symfony
#### React + Stimulus JS


## Setup

Create docker containers.

```bash
$ make build
$ make run
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


