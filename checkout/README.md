перегон: `php artisan db:seed`
подсказки: `php artisan ide-helper:generate`

локально подключится к БД:
* `mysql -u ifix -h {imageName} -p`
* `mysql -u ifix -h users_db -p`

```
mysql -u ifix -h users_db -p
use users;
show tables;

========================================================================================================================

mysql -u ifix -h checkout_db -p
use checkout;
show tables;

```

---

первый запуск:
```
php artisan config:clear
php artisan migrate
php artisan ide-helper:generate

```
