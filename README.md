# Slim3 REST Starter Project


## Project Structure
```
├── logs -> Folder Logs
│   ├── error
│   ├── info
├── public -> Folder Public
│   └── index.php
├── src -> Code Start Here
│   ├── app -> Main Code
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


`composer create-project ravimukti/slim3rest-starter your-project-name --stability=dev`


## API Path Pattern

Pattern -> /**channel**/**product**/**version**/**module**/**action**

`/channel/shopee/v1/order/pull-all`

More about [REST API best practice](https://florimond.dev/en/posts/2018/08/restful-api-design-13-best-practices-to-make-your-users-happy/)

## Running Application
`composer start`

## Running Test
`composer test`

## Application Specs
- Slim 3 PHP
