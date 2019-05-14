## Build the website docker image

## builder image
FROM docker.klink.asia/main/docker-php:7.1 AS build-env

ARG APP_URL=https://klink.asia
ARG KLINK_URL=http://public.klink.asia
ARG KLINK_TOKEN=TOKEN

COPY --chown=php:php . /var/www/html

RUN echo "KLINK_URL=$KLINK_URL" >> .env && \
    echo "KLINK_TOKEN=$KLINK_TOKEN" >> .env && \
    composer install --prefer-dist && \
    yarn && \
    yarn production 

## production image
FROM nginx:1.14-alpine AS production-env

ENV LOCATION '/usr/share/nginx/html'

WORKDIR $LOCATION

COPY --chown=nginx docker/nginx.conf /etc/nginx/nginx.conf
COPY --chown=nginx docker/conf.d/default.conf /etc/nginx/conf.d/default.conf
COPY --chown=nginx robots.txt "${LOCATION}/robots.txt"
COPY --chown=nginx googlecbc70fd550862ef0.html "${LOCATION}/googlecbc70fd550862ef0.html"
COPY --chown=nginx --from=0 /var/www/html/build_production/ "$LOCATION"


EXPOSE 80

