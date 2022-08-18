# Channel Starter Project

Starter Project untuk membuat service channel, sudah ada boilerplate code yang dibutuhkan sehingga hanya fokus pada implementasi OPEN API masing - masing channel saja


## Project Structure
```
├── logs -> Folder Logs
│   ├── error
│   ├── info
├── public -> Folder Public
│   └── index.php
├── src -> Code Start Here
│   ├── app -> Main Code
│   │   ├── helper -> Helper Class and Module
│   │   │   └── strategy
│   │   │       ├── base
│   │   │       ├── factory
│   │   │       └── impl
│   │   ├── routes ->All API Endpoint in here
│   │   │   ├── api -> API Endpoint
│   │   │   └── scheduler -> Scheduler Endpoint
│   │   └── service -> Bussiness Logic Here
│   ├── dependencies.php -> DI Module
│   ├── library -> Non-Composer Library
│   ├── middleware.php -> Security Middleware
│   ├── routes.php -> Routes Example
│   └── settings.php -> Application Settings
├── templates -> View Templates
│   └── index.phtml
├── tests -> Unit Test
└── vendor -> Composer Library
├── composer.json
├── composer.lock
├── docker-compose.yml
├── README.md

```

## How To Install


`composer create-project haistari-channel/starter-project your-project-name --repository="{\"url\": \"https://github.com/haistari/core-starter-project.git\", \"type\": \"vcs\"}" --stability=dev`


![alt create-project](https://github.com/haistari/channel-starter-project/blob/master/create-project.png)


## API Path Pattern

Pattern -> /**channel**/**product**/**version**/**module**/**action**

`/channel/shopee/v1/order/pull-all`

Mengenai [REST API best practice](https://florimond.dev/en/posts/2018/08/restful-api-design-13-best-practices-to-make-your-users-happy/)

## Running Application
`composer start`

## Running Test
`composer test`

## Application Specs
- Slim 3 PHP
