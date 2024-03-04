<p align="center">Coolkapada</p>

## About 

Coolkapada is a ecommerce web application built using laravel and livewire:

## Steps to Reproduce

- Clone this repo.
- Composer install
- Cp env.example .env
- Touch database/database.sqlite Or Mysql
- Php artisan key:generate
- Php artisan migrate:fresh --seed
- Add Google Recaptch V2 Keys
   RECAPTCHA_V2_SITE_KEY=
   RECAPTCHA_V2_SECRET_KEY=

- Add stripe keys
STRIPE_PUBLIC_KEY=
STRIPE_SECRET_KEY=

## Admin Credentials (localhost:8000/admin/login)
- Email : kamal@gmail.com
- Pass  : 11111111

#Screenshots
![](https://raw.githubusercontent.com/soltee/coolkapada/master/public/screenshots/Desktop.png)
![](https://raw.githubusercontent.com/soltee/coolkapada/master/public/screenshots/shop.png)
![](https://raw.githubusercontent.com/soltee/coolkapada/master/public/screenshots/single-product.png)
![](https://raw.githubusercontent.com/soltee/coolkapada/master/public/img/bag.png)
![](https://raw.githubusercontent.com/soltee/coolkapada/master/public/img/bag-modal.png)
![](https://raw.githubusercontent.com/soltee/coolkapada/master/public/img/checkout.png)
![](https://raw.githubusercontent.com/soltee/coolkapada/master/public/img/thank.png)

![](https://raw.githubusercontent.com/soltee/coolkapada/master/public/img/admin-dashboard.png)