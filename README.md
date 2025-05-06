# ManiyaTech Core module for Magento 2

## How to install ManiyaTech_Core module

### Composer Installation

Run the following command in Magento 2 root directory to install ManiyaTech_Core module via composer.

#### Install

```
composer require maniyatech/module-core
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy -f
```

#### Update

```
composer update maniyatech/module-core
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy -f
```

Run below command if your store in the production mode:

```
php bin/magento setup:di:compile
```

### Manual Installation

If you prefer to install this module manually, kindly follow the steps described below - 

- Download the latest version [here](https://github.com/maniyatech/module-core/archive/refs/heads/main.zip) 
- Create a folder path like this `app/code/ManiyaTech/Core` and extract the `main.zip` file into it.
- Navigate to Magento root directory and execute the below commands.

```
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy -f
```
