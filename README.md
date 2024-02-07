# Case Study

## Kurulum

-   Projeyi indirin veya klonlayın.
-   Docker'ın yüklü olduğundan emin olun.
-   Aşağıdaki komut satırlarını sırasıyla çalıştırın.

## Komutlar

-   Env dosyası kopyalama

        cp .env.example .env


-   Projeyi ayaklandırma

        docker-compose --env-file ./.env up -d


-   Gerekli paketleri kurma 

        docker-compose exec app composer install


-   Laravel app key oluşturma 

        docker-compose exec app /var/www/html/artisan key:generate


-   Migrationları temizleme 

        docker-compose exec app php artisan migrate:reset


-   Migrationları kurma 

        docker-compose exec app php artisan migrate --seed


-   To-do listesini çekme

        php artisan todo:providers


-   İş planı oluşturma 

        php artisan todo:developers

## Kullanım

    http://localhost:3535/api/todo