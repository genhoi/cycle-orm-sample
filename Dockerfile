FROM php:8.2.5

ENV LANG en_US.utf8

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions \
    && install-php-extensions @composer pdo_pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY --from=ghcr.io/roadrunner-server/roadrunner:2023.1.0 /usr/bin/rr /usr/local/bin/rr
