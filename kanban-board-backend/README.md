## 📝Kanban board Backend

Kanban board Backend build with Laravel
Provide API for Frontend.

For demo purposed used static API Token specified in the `.env` file
with `ACCESS_TOKEN` key

## 🎯 API Reference

#### Get all columns

```http
  GET /api/column/get
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `access_token` | `string` | **Required**. Your API token |

#### Get cards

```http
  GET /api/list-cards
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `access_token` | `string` | **Required**. Your API token |
| `date`      | `string` | Filter by created date |
| `status`      | `integer` | Possible value 1 (deleted), 0 (not deleted)   |

#### Create Column

```http
  POST /api/column/create
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `title` | `string` | **Required**. Column title |

#### Delete Column

```http
  DELETE /api/column/delete/{column}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `column` | `integer` | **Required**. Column ID |

#### Create Card

```http
  POST /api/column/{column}/card/create
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `column` | `integer` | **Required**. Column ID |
| `title` | `string` | **Required**. Card title |
| `description` | `string` | **Required**. description |

#### Update Card

```http
  PUT /api/column/card/update/{card}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `card` | `integer` | **Required**. Card ID |
| `title` | `string` | **Required**. Card title |
| `description` | `string` | **Required**. description |

#### Update Card Index

```http
  POST /api/column/card/update/index
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `data` | `json` | **Required**. Json array of card index |

#### Delete Card

```http
  DELETE /api/column/card/delete/{card}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `card` | `integer` | **Required**. Card ID |

## 🚀 Run Locally

Clone the project

```bash
  git clone https://github.com/yogesh16/kanban-board-laravel-vue.git
```

Go to the project directory

```bash
  cd kanban-board-backend
```

Install dependencies

```bash
  composer install
```

Migrate database
```bash
  php artisan migrate
```

Set Environment Variables
```bash
  ACCESS_TOKEN=xxxxxx
```

Run local server
```bash
   php artisan serve
```

## ✨ Using Framework & Packages

- [Laravel](https://laravel.com/)
- [spatie / db-dumper](https://github.com/spatie/db-dumper/)