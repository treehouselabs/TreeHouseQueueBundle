#!/usr/bin/env bash
trap 'exit' ERR

cd "$(dirname "$0")"/../../

composer self-update

if [ "$SYMFONY_VERSION" != "" ]; then composer require "symfony/symfony:${SYMFONY_VERSION}" --no-update; fi;
