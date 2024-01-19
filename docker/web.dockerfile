FROM nginx:1.21

COPY docker/vhost.conf /etc/nginx/conf.d/default.conf

RUN ln -sf /dev/stdout /var/log/nginx/access.log \
	&& ln -sf /dev/stderr /var/log/nginx/error.log

# get composer and required tools (apt-get)
#RUN curl -OL https://getcomposer.org/download/1.5.2/composer.phar \
#    && mv composer.phar /usr/local/bin/composer \
#    && chmod +x /usr/local/bin/composer \
#    && apt-get update \
#    && apt-get install -y git \
#    && apt-get install -y zlib1g-dev

# Install Composer
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
