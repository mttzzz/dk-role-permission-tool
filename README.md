## MYSQL 
Доступна снаружи по адресу localhost:3307
Доступна внутри по адресу mysql:3306
login root
password root

## REDIS 
Доступна снаружи по адресу localhost:6379
Доступна внтури по адресу cache:6379    
password 12345

## REDIS
Доступна снаружи контейнера по адресу localhost:6379
password 12345

## Запуск
```docker-compose up -d```
После этого проект будет доступен на http://localhost:8000

## Остановка
```docker-compose down```

## Открыть консоль внутри контейнера
```docker exec -it app bash```

## Посмотреть статус контейнеров
```docker exec ps```
