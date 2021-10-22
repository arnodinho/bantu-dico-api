#L'image officielle est fournie avec un serveur Apache intégré
FROM php:7.4-apache
# Dockerfile
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get update -qy && \
    apt-get install -y \
    git \
    libicu-dev \
    iputils-ping \
    figlet \
    unzip \
    redis-server \
    zip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#Some are bundled with PHP like sockets or opcache. Some need to be installed manually like apcu, redis, or mongodb.
RUN apt-get update && \
    pecl channel-update pecl.php.net && \
    pecl install apcu igbinary mongodb && \
    # compile Redis with igbinary support
    pecl bundle redis-3.1.3 && cd redis && phpize && ./configure --enable-redis-igbinary && make && make install && \
    docker-php-ext-install bcmath sockets && \
    docker-php-ext-enable apcu igbinary mongodb opcache redis && \
    docker-php-source delete && \
    rm -r /tmp/* /var/cache/* /var/www/html/*

RUN echo '\
opcache.interned_strings_buffer=16\n\
opcache.load_comments=Off\n\
opcache.max_accelerated_files=16000\n\
opcache.save_comments=1\n\
' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

#apache conf
RUN a2enmod rewrite remoteip
ADD sango-dico.conf /etc/apache2/sites-available/000-default.conf
ADD apache.conf /etc/apache2/conf-available/z-bantu-dico.conf
RUN a2enconf z-bantu-dico
RUN echo 'alias ll="ls -al"' >> ~/.bashrc

# PHP Extensions  xdebug for php unit  coverage
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini
# PHP Extensions
RUN docker-php-ext-install -j$(nproc) opcache pdo_mysql
ADD php.ini /usr/local/etc/php/conf.d/app.ini

# add git config
#ADD gitconfig /root/.gitconfig

# add ssh
#ADD ssh /root/.ssh

#oh-my-git
RUN git clone https://github.com/arialdomartini/oh-my-git.git ~/.oh-my-git && echo source ~/.oh-my-git/prompt.sh >> ~/.bashrc

#figlet
RUN figlet "Successfull  build"
# set redis daemon
RUN redis-server --daemonize yes