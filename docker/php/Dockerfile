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
    zip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#apache conf
RUN a2enmod rewrite remoteip
ADD sango-dico.conf /etc/apache2/sites-available/000-default.conf
ADD apache.conf /etc/apache2/conf-available/z-bantu-dico.conf
RUN a2enconf z-bantu-dico
RUN echo 'alias ll="ls -al"' >> ~/.bashrc

# PHP Extensions
RUN docker-php-ext-install -j$(nproc) opcache pdo_mysql
ADD php.ini /usr/local/etc/php/conf.d/app.ini

# add git config
ADD gitconfig /root/.gitconfig

# add ssh
ADD ssh /root/.ssh

#oh-my-git
RUN git clone https://github.com/arialdomartini/oh-my-git.git ~/.oh-my-git && echo source ~/.oh-my-git/prompt.sh >> ~/.bashrc

#figlet
RUN figlet "Succesfull  build"