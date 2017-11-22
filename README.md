annuaire
========
This project is under construction.

A Symfony project created on September 27, 2017, 6:09 pm.

First of all do a composer install command.
```
composer install
```

Then create your database schema or use  command line 
```
php bin/console doctrine:database:create
```

and then create all tables

```
php bin/console doctrine:schema:update --force
```

now you should use the application

```
php bin/console s:r
```

Change style.css and adapt the template part.

You can use console to add default category (for restaurant directory, lawyer...) use --help
```
php bin/console app:create:category restaurant
```

create user as fosUserBundle documentation http://symfony.com/doc/2.0/bundles/FOSUserBundle/command_line_tools.html and promote it as ROLE_ADMIN

install ckeditor WYIWYG 
```
php bin/console ckeditor:install
```
