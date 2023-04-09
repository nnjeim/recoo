#!/bin/bash
if [ -z "$1" ]
  then
    echo "No argument supplied"
    exit
fi

docker-compose stop $1
docker-compose up --no-deps --build $1 -d
