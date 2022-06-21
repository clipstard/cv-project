FROM php:8.1.7-fpm
MAINTAINER EasyWay Team <eoknic@gmail.com>

ENV DEBIAN_FRONTEND noninteractive

# ------------------------------
#Xdebug env variables
# ------------------------------
ARG XDEBUG_REMOTE_HOST
ARG XDEBUG_REMOTE_PORT
ARG XDEBUG_IDE_KEY
ENV XDEBUG_REMOTE_HOST ${XDEBUG_REMOTE_HOST}
ENV XDEBUG_REMOTE_PORT ${XDEBUG_REMOTE_PORT}
ENV XDEBUG_IDE_KEY ${XDEBUG_IDE_KEY}

# ------------------------------
# Install xDebug, if enabled
# ------------------------------
ARG INSTALL_XDEBUG
RUN if [ ${INSTALL_XDEBUG} = true ]; then \
    # Install the xdebug extension
    pecl install xdebug && \
    docker-php-ext-enable xdebug \
    ;fi
# Copy xdebug configration for remote debugging
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# ------------------------------
# install usefull binaries
# ------------------------------
#RUN apt-get -yqq update && \
#    apt-get install -yqq --no-install-recommends git openssh-client libonig-dev \
#                                                 unzip libpcre3 libfcgi0ldbl \
#                                                 libpcre3-dev libssl-dev \
#                                                 jq vim zip libzip-dev \
#                                                 wget curl gnupg sudo libfreetype6-dev \
#                                                 libfcgi-bin libxrender1 libfontconfig1 \
#                                                 libicu-dev libx11-dev libxtst6 wget

RUN apt-get -yqq update && \
    apt-get install -yqq --no-install-recommends libicu-dev git zip vim nano curl wget jq sudo gnupg libzip-dev libfcgi0ldbl unzip
# ------------------------------
# install PHP extensions
# ------------------------------
RUN docker-php-ext-install exif intl opcache pdo_mysql mysqli && \
    # docker-php-ext-install soap && \
#    docker-php-ext-configure gd --enable-gd && docker-php-ext-install -j$(nproc) gd && \
    docker-php-ext-configure zip && docker-php-ext-install zip
    # imagick
    # redis

ENV current_os=linux

# ------------------------------
# user
# ------------------------------
ARG UID
ARG GID
RUN groupadd -g ${GID} app
RUN useradd -d /home/app -s /bin/bash -u ${UID} -g ${GID} app
RUN mkdir /home/app
RUN chown -R app:app /home/app

# ------------------------------
# health monitoring
# ------------------------------
# Include the start script
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# ------------------------------
# cleaning
# ------------------------------
RUN apt-get clean -yqq && rm -rf /tmp/* /var/lib/apt/cache/* && \
    rm -rf /root/*

# ------------------------------
# Install npm
# ------------------------------
RUN apt-get install -y gnupg2
# Removing /var/lib/apt/lists worked
RUN rm -rf /var/lib/apt/lists/ && curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install nodejs -y
RUN npm install -g npm@latest

# ------------------------------
# Install composer
# ------------------------------
WORKDIR /tmp

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm -rf /tmp/*


USER app

# ------------------------------
# Specific user commands
# ------------------------------
# RUN composer global require hirak/prestissimo

USER root

# expose for xdebug port
EXPOSE ${XDEBUG_REMOTE_PORT}

# Include the config files
COPY symfony.ini /usr/local/etc/php/conf.d/
COPY symfony.pool.conf /usr/local/etc/php-fpm.d/
COPY alias.sh /etc/profile.d/

CMD ["start.sh"]
