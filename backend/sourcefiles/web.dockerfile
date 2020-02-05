FROM nginx:1.10-alpine

ADD nginx/vhost.conf /etc/nginx/conf.d/default.conf

COPY ./src/public /var/www/public
