FROM nginx:alpine

ARG UID

RUN apk add --no-cache coreutils sudo mc bash

ADD ./nginx.conf /etc/nginx/conf.d/default.conf
