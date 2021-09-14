# Norris

Cos norris says so

![phpcs](https://github.com/DominicWatts/Norris/workflows/phpcs/badge.svg)

![PHPCompatibility](https://github.com/DominicWatts/Norris/workflows/PHPCompatibility/badge.svg)

![PHPStan](https://github.com/DominicWatts/Norris/workflows/PHPStan/badge.svg)

![php-cs-fixer](https://github.com/DominicWatts/Norris/workflows/php-cs-fixer/badge.svg)

# Install instructions

    composer require dominicwatts/norris

    php bin/magento setup:upgrade

    php bin/magento setup:di:compile

# Usage instructions

## Listing

For listing page Go to `/dominicwatts_norris/joke/lister` or use header link

## Console command

Usage:

    dominicwatts:norris:store

For example

    php bin/magento dominicwatts:norris:store

## Cron

Allow Magento cron job to run

Schedule `*/5 * * * *`

## Admin

    Marketing > Jokes > Manage Jokes