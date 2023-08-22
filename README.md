# Online Shop

App with
[PHP](https://php.net/), [MySQL](https://mysql.com/)

Kit has 2 docker containers: **php** and **mysql**  

<p align="center"><a href="https://php.net" target="_blank"><img src="https://e7.pngegg.com/pngimages/609/813/png-clipart-web-development-html-php-cascading-style-sheets-javascript-world-wide-web-blue-text.png" alt="Logo"></a></p>


## Installation

Clone the project<br>
```https://github.com/abdullayevbahrom/online-shop.git```

Go to the project directory<br>
```cd online-shop```

Run docker containers <br>
```docker-compose up -d```

Install dependencies <br>
```docker-compose exec php composer install```

**Done!** You can open <a href="http://localhost:9020" target="_blank">http://localhost:9020</a> via browser. 


## Docker
For enter to php container run 
```docker-compose exec php bash```

For enter to mysql container run 
```docker-compose exec mysql bash```


Database allows connections only from localhost. 
Because of this when you use the project on production and want to connect to database from your computer
you should connect via ssh bridge.

