#!/bin/sh

 PHPUNIT_ARGS="$@" docker-compose up --build --abort-on-container-exit
