# Support Ticket Application

A simple support ticket logging application to demostrate an small sclale online help desk. A user creates a  ticket, they recieve a notification with a link to view their tickets progress. The administrator gets notified of the newly added ticket. They are then able to update,delete, and assign the ticket to an agent. The agent gets a notification of the ticket assigned to them and they are able to comment and/or close/resolve the ticket.

Agents cannot see tickets that are not assigned to them. Ticket authors only (at this point) see the updates on their tickets via the link that was provided upon ticket creation and get an e-mail notification on ticket updates. Administrtors are able to see every ticket.

## Requirements

- [Laravel work environment](https://laravel.com/docs/5.x)
- [Dev Desktop / Docker Toolbox](https://www.docker.com/products/docker-desktop) _(Optional)_

## Setup

The setup guide assumes that you have the above requirements.

### Running the Docker setup

Clone repo: (or manually download the [setup](https://github.com/scshasha/support-tickets-app/tree/setup) branch and run the install script)

> git clone https://github.com/scshasha/support-tickets-app.git

> git pull origin setup --force

> . install.sh

The following containers should be running:

```
mariadb
php
nginx
adminer
mailhog
```
- Database GUI: [http://localhost:8080](http://localhost:8080)
- Web: [http://localhost](http://localhost)
- MailHog: [http://localhost:8025](http://localhost:8025)

NB: Ports may change depending on your `docker-compose.yml` file configuration. If using Docker Toolbox you be required to replace [localhost]() with [192.168.99.100]() which is the default IP or any other assigned IP. Run `docker-machine ip` for your IP.

### Running on other local environments

> git clone https://github.com/scshasha/support-tickets-app.git

> git pull origin master

> composer install

> php artisan serve

---

## Configurations

Files and Variables to update.

#### Updated Docker environment file (./.env)

```
DB_DATABASE=databasename
DB_USERNAME=userpassowrd
DB_PASSWORD=password
DB_ROOT_PASSWORD=password
```

#### Updated Laravel environment files (.env)./code/html/.env

```
DB_DATABASE=databasename
DB_USERNAME=userpassowrd
DB_PASSWORD=password
DB_ROOT_PASSWORD=password
DB_HOST=mariadb
```

DB migrations Run:

If you are using Docker the `install.sh` script will take care of migrations and db seeds.

On non-docker users run the following:
- migration cmd:
> php artisan migrate
- db seed cmd:
> php artisan db:seed


The db seed will create dummy data on `users`, `tickets`, and `categories`.

### Using the application
x6 users will be created after running the database seeds with the following credentials:
- U: admin@supporttickets.com P: password
- U: agent1@supporttickets.com P: password
- U: agent2@supporttickets.com P: password
- U: agent3@supporttickets.com P: password
- U: agent4@supporttickets.com P: password
- U: agent5@supporttickets.com P: password

The above can be updated on the `UsersTableSeeder` class (./database/seeds/).

## Running Laravel commands on Docker
- `docker-compose exec php sh` will open a shell session on/in your `php` container, enabling your to interact with your Laravel application via terminal.
- `docker-compose exec mariadb sh` will open a shell session on/in your `mariadb` container, enabling you to interact with your DB via terminal.
