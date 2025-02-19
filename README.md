# Cars API V1

[![Build Status](https://img.shields.io/badge/build-passing-brightgreen)](https://github.com/yourusername/your-repo)
[![License](https://img.shields.io/badge/license-MIT-blue)](LICENSE)

## Описание

Cars API V1 — это RESTful API для управления автомобилями, их комплектациями, опциями и ценами. API включает стандартные CRUD-операции для всех сущностей и публичный метод для получения списка автомобилей с актуальными комплектациями и ценами. В проекте используются:

- **Laravel 11+** для бэкенда
- **PostgreSQL** в качестве СУБД
- **Redis** для кеширования публичного метода `/api/cars/available`
- **Swagger (L5-Swagger)** для документации API

## Функциональные возможности

- CRUD-операции для:
  - **Автомобиль (Car)**
  - **Опция (Option)**
  - **Комплектация (Configuration)**
  - **Цена (Price)**
- Публичный API-метод:  
  **GET /api/cars/available**  
  Возвращает список автомобилей с актуальными комплектациями, их опциями и действующими ценами на текущий момент.  
  Пример ответа:
  ```json
  [
      {
          "id": 1,
          "name": "Toyota Camry",
          "configurations": [
              {
                  "id": 10,
                  "name": "Comfort",
                  "options": ["Climate Control", "Leather Seats"],
                  "current_price": 35000
              },
              {
                  "id": 11,
                  "name": "Premium",
                  "options": ["Climate Control", "Leather Seats", "Sunroof"],
                  "current_price": 40000
              }
          ]
      }
  ]

# Cars API V1 — Установка и настройка


## Требования

- PHP 8.1+
- Composer
- PostgreSQL
- Redis

## Шаг 1. Клонирование репозитория и установка зависимостей

1. Клонируйте репозиторий:
   git clone https://github.com/Elnuritos/test-car.git


2. Установите Composer-зависимости:
   composer install

## Шаг 2. Настройка переменных окружения

1. Скопируйте файл `.env.example` в `.env`:
   cp .env.example .env

2. Сгенерируйте ключ приложения:
   php artisan key:generate

3. Отредактируйте файл `.env`, указав настройки для базы данных и Redis:

   # Database configuration
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=your_database_name
   DB_USERNAME=your_db_username
   DB_PASSWORD=your_db_password

   # Redis configuration
   CACHE_DRIVER=redis
   REDIS_HOST=127.0.0.1
   REDIS_PORT=6379

## Шаг 3. Миграции и сидирование базы данных

1. Если база данных ещё не создана, создайте её (например, через командную строку):
   createdb your_database_name
   или CREATE DATABASE your_database_name;

2. Запустите миграции и заполните базу тестовыми данными:
   php artisan migrate:fresh --seed

## Шаг 4. Генерация документации API (Swagger)



1. Опубликуйте конфигурацию пакета:
   php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"



2. Сгенерируйте документацию:
   php artisan l5-swagger:generate

3. Документация будет доступна по адресу:
   http://localhost:8000/api/documentation



## Шаг 5. Запуск локального сервера

Запустите сервер командой:
   php artisan serve

API будет доступно по адресу, например:
   http://localhost:8000/api/v1/cars


## Шаг 8. Запуск теста(пок успел 1)

Проверьте корректность работы проекта:
   php artisan test

--------------------------------------------------


