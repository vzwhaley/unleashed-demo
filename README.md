# Unleashed Symfony URL Shortener Application

## Introduction

Built on Symfony v5.1.8, the Unleashed Symfony URL Shortener Application provides a user with the capability to create and store shortened URLs for websites of their choosing. A total of visits/redirects are also stored for each URL.

## Getting Started

### Prerequisites

#### Git

[Git](https://git-scm.com/downloads) will be used to clone the code repository.

#### Docker

[Docker](https://www.docker.com/) is used for the MySQL database.

#### Composer

[Composer](https://getcomposer.org/download/) is used to manage PHP dependencies.

### Initial Setup

1. Clone the Github repository in your projects directory:

```bash
$ git clone git@github.com:vzwhaley/unleashed-demo.git
```

2. Install dependencies:

```bash
$ composer install
```

3. Start the Symfony development server, which will also install dependencies via Composer by running:

```bash
$ symfony server:start
```

4. Start the Docker container with MySQL:

```bash
$ docker-composer up -d
```

5. Run Doctrine Migrations to set up the database schema and url table:

```bash
$ symfony console doctrine:migrations:migrate
````

## Development

@TODO

### Troubleshooting

@TODO

## Deployment

@TODO
