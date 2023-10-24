FROM php:8.1-cli-alpine

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

# Install required packages and Xdebug
ARG PHP_XDEBUG_ENABLED

RUN if [ "$PHP_XDEBUG_ENABLED" = 1 ] ; then  \
    apk add --no-cache $PHPIZE_DEPS \
    linux-headers \
    && pecl install xdebug \
    && apk del $PHPIZE_DEPS &&\
    echo $'zend_extension=xdebug.so\n\
    \rxdebug.mode=debug,coverage\n\
    \rxdebug.start_with_request=yes\n\
    \rxdebug.discover_client_host=false\n\
    \rxdebug.client_host=host.docker.internal\n\
    \rxdebug.client_port=9003\n\
    \rxdebug.log=/tmp/xdebug.log\n\
    \rxdebug.output_dir=/tmp/snapshots' > /usr/local/etc/php/conf.d/xdebug.ini; fi

# Set up working directory
WORKDIR /app

# Copy your PHP application files into the container
COPY . .

CMD ["tail", "-f", "/dev/null"]