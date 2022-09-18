
# refilex Task



## Run Locally

Clone the project

```bash
  git clone https://github.com/xmansyx/refilex
```

Go to the project directory

```bash
  cd refilex
```

Install dependencies

```bash
  composer install
```

i am using Sail as Docker Interface so you need to run
```bash
  php artisan sail:install
```

Start the server by laravel sail

```bash
  ./vendor/ben/sail up -d
```

Migrate and seed the database

```bash
  sail artisan migrate
```

i am using laravel Seed to read the content from json files and insert them to database
```bash
  sail artisan db:seed
```



## API Reference

#### Get all users with theri respective transactions

```http
  GET /api/users
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `search` | `string` | **optional**. name of any user |
| `status_code` | `string` | **optional**. type of status code (authorized, decline, refunded) |
| `currency` | `string` | **optional**. the currency of the transaction (EGP, USD, EUR) |
| `date_from` | `string` | **optional**. the minimum date of a transaction|
| `date_to` | `string` | **optional**. the maximum date of a transaction |
| `amount_from` | `string` | **optional**. the minimum amount of a transaction |
| `amount_to` | `string` | **optional**. the maximum amount of a transaction |

#### Get item

```http
  GET /api/users/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of user to fetch |

