# Storelle

Storelle a proof of concept MVC Ecommerce App build with PHP, Javascript and AJAX

## Features

- Route middlewares for Auth/Session
- Authetication, every accounts start with 100$ (artificial) per account
- View Products and Images
- Read/Write Reviews
- Add/Remove product's to shopping cart and
- Cart Checkout and Set shipping cost for checkout

_This repo takes small and older pieces of RubyNight, is intended to be a test platform and should not be used in production._

## Usage

- Clone the repository

- Import the SQL file to your DB

- Change database configuration details in .\src\Core\database.php

- Local Development Server : php -T 0.0.0.0:3000 -t public

Demo Account

```
username: admin
password: admin
```
