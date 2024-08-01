# Contributing to PHP ActiveRecord #

We always appreciate contributions to PHP ActiveRecord, but we are not always able to respond as quickly as we would like.
Please do not take delays personal and feel free to remind us by commenting on issues.

### Testing ###

Run the tests with Docker:

```sh
docker compose up -d
docker compose exec tests composer run test
```

If you want to run a subset of all tests:

```
docker compose exec tests vendor/bin/phpunit --filter CacheTest
docker compose exec tests vendor/bin/phpunit --group slow
```

#### Testing against a different version of PHP ####

First rebuild the Docker image with the desired version of PHP:

```sh
docker compose build --build-arg PHP_VERSION=8.1
docker compose up -d

Then run the tests:

```sh
docker compose exec tests composer run test
```

You can check compatibility via static analysis by updating `composer.json` (see `scripts.check-compatibility`) and 
then running:

```sh
docker compose exec tests composer run check-compatibility
```

#### Skipped Tests ####

You might notice that some tests are marked as skipped. To obtain more information about skipped
tests, pass the `--verbose` flag to PHPUnit:

```sh
vendor/bin/phpunit --verbose
```

Typically, tests will have been skipped because the development environment does not provide access to all of the dependencies needed to test PHP ActiveRecord. You can either install these dependencies, or use docker to boot up containers that package up the dependencies.

