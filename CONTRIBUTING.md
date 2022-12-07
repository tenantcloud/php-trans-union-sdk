# Commands

Install dependencies:
`docker run -it --rm -v $PWD:/app -w /app composer install --ignore-platform-reqs`

Run tests:
`docker run -it --rm -v $PWD:/app -w /app chialab/php:8.1 vendor/bin/pest`

Run php-cs-fixer on self:
`docker run -it --rm -v $PWD:/app -w /app composer cs-fix`

Run phpstan on self:
`docker run -it --rm -v $PWD:/app -w /app chialab/php:8.1 vendor/bin/phpstan`
