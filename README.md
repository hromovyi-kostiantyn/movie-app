
# Movie-App

Тестовое задание на знание Laravel

После установки что бы запустить проект нужно 

запустить миграцию,seed (опционально) и запустить локальный сервер



## API Reference
Сдесь собраны несколько роутов,для просмотра всех роутов
нужно выполнить команду **php artisan route:list**

#### Get all movies

```http
  GET /api/movies
```
#### Get movie

```http
  GET /api/movies/{movie}
```
#### Store movie

```http
  POST /api/movies
```
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `title`   | `string` | **Required**. title of movie |
| `image`   | `file`   | **Optional** Poster of movie 
|  `genres`| `array` | **Required** Array of movie objects

#### Get all genres

```http
  GET /api/genres
```
#### Get genre

```http
  GET /api/genres/{genre}
```




## Demo
Example of /api/genres
```json
{
    "data": [
        {
            "id": 2,
            "name": "omnis"
        },
        {
            "id": 3,
            "name": "veniam"
        },
        {
            "id": 4,
            "name": "placeat"
        }
    ]
}
```

Example of /api/movies
```json
{
    "data": [
        {
            "id": 2,
            "title": "Id cumque magnam eveniet dolorum rem enim.",
            "is_published": 0,
            "image": "https://via.placeholder.com/640x480.png/000066?text=dignissimos",
            "genres": [
                {
                    "id": 3,
                    "name": "veniam"
                },
                {
                    "id": 6,
                    "name": "qui"
                },
                {
                    "id": 8,
                    "name": "voluptatem"
                },
                {
                    "id": 10,
                    "name": "nihil"
                }
            ]
        },
        {
            "id": 3,
            "title": "Dolorum culpa beatae in in non non eos.",
            "is_published": 0,
            "image": "https://via.placeholder.com/640x480.png/006666?text=sint",
            "genres": [
                {
                    "id": 3,
                    "name": "veniam"
                },
                {
                    "id": 6,
                    "name": "qui"
                },
                {
                    "id": 9,
                    "name": "unde"
                },
                {
                    "id": 10,
                    "name": "nihil"
                }
            ]
        },
        {
            "id": 4,
            "title": "Quia velit magni qui cupiditate quo.",
            "is_published": 0,
            "image": "https://via.placeholder.com/640x480.png/004444?text=omnis",
            "genres": [
                {
                    "id": 6,
                    "name": "qui"
                },
                {
                    "id": 10,
                    "name": "nihil"
                }
            ]
        },
        {
            "id": 5,
            "title": "Et aliquid et accusamus itaque veniam facere illum.",
            "is_published": 0,
            "image": "https://via.placeholder.com/640x480.png/0077cc?text=minima",
            "genres": [
                {
                    "id": 6,
                    "name": "qui"
                },
                {
                    "id": 9,
                    "name": "unde"
                },
                {
                    "id": 10,
                    "name": "nihil"
                }
            ]
        },
        {
            "id": 6,
            "title": "Enim unde provident quibusdam et sit molestias.",
            "is_published": 0,
            "image": "https://via.placeholder.com/640x480.png/0022bb?text=odit",
            "genres": [
                {
                    "id": 3,
                    "name": "veniam"
                },
                {
                    "id": 4,
                    "name": "placeat"
                },
                {
                    "id": 5,
                    "name": "voluptas"
                },
                {
                    "id": 8,
                    "name": "voluptatem"
                },
                {
                    "id": 10,
                    "name": "nihil"
                }
            ]
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/movies?page=1",
        "last": null,
        "prev": null,
        "next": "http://127.0.0.1:8000/api/movies?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "path": "http://127.0.0.1:8000/api/movies",
        "per_page": 5,
        "to": 5
    }
}
```

Example of POST /api/movies to store new movies

```json
{
    "data": {
        "id": 61,
        "title": "New movie",
        "is_published": 0,
        "image": "http://127.0.0.1:8000/images/TaXWh5blnYThQWgpx7Mo536YyXWItRf5tzae7HJ7.jpg",
        "genres": [
            {
                "id": 11,
                "name": "Drama"
            },
            {
                "id": 12,
                "name": "Comedy"
            },
            {
                "id": 13,
                "name": "Horror"
            }
        ]
    }
}
```