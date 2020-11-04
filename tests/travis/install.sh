#!/usr/bin/env bash
trap 'exit' ERR

cd "$(dirname "$0")"/../../

echo yes | pecl install amqp

if [ "$SYMFONY_VERSION" != "" ]; then composer require "symfony/symfony:${SYMFONY_VERSION}" --no-update; fi;
