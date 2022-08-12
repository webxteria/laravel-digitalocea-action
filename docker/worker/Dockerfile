

FROM webxteria/php-fpm

RUN apk update && apk add supervisor mariadb-client

COPY crontab /etc/periodic/1min/laravel-cron

RUN chmod 0644 /etc/periodic/1min/laravel-cron

RUN crontab /etc/periodic/1min/laravel-cron

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

ENTRYPOINT ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
