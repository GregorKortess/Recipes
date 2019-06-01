<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://cdn.dizkon.ru/images/contests/2015/01/02/54a6a180501fe.700x534.80.jpg" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

 <h2 align="center"> Сайт для создания и просмотров рецептов </h2>
 
 Функционал - 
 Регистрация;
 Личный кабинет;
 Создание и просмотр рецептов;
 Система рейтинга;
 Лайки на Redis;
 Комментарии к постам;
 <h4> Фото проекта: </h4>
 Создание рецепта.
 <img src="https://i.gyazo.com/b8a3e9a0b638e39afbf14475a4ffa113.png" alt="">
 "<hr>"
 Просмотр ленты рецептов
<img src="https://i.gyazo.com/0222b387190362faf87aa39dddddb508.jpg" alt="">
 "<hr>"
 Профиль с постами пользователя
<img src="https://i.gyazo.com/4a8068bfebf54048a84282cddeadfc35.png" alt="">
 "<hr>"
 Пустой профиль пользователя
<img src="https://i.gyazo.com/85e49674ee96eec52b98548bc7ce2167.png" alt="">
 "<hr>"
 Просмотр рецепта(1)
<img src="https://i.gyazo.com/595c634443b88ee558631184be9b51cc.png" alt="">
 "<hr>"
 Просмотр рецепта(2)
<img src="https://i.gyazo.com/960bc878eff83f3760fc10b74734cf87.png" alt="">
 "<hr>"

 

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    components           contains frontend copmponents classes and interfaces 
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
