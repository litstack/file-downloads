# Litstack FileDownloads

Install:
```shell
composer require litstack/file-downloads
```

Publish the migration and migrate:
```shell
php artisan vendor:publish --tag=lit-file-downloads
php artisan migrate
```


Add the navigation item to your navigation:
```php
$nav->entry('File Downloads', [
    'link' => route('lit.file-downloads'),
    'icon' => '<i class="fas fa-download"></i>',
]),
```

