FROM ubuntu:latest

LABEL maintainer="Nikita Ignatushko <nikuta331200@gmail.com>"
LABEL description="This Dockerfile installs envirment for CyberFramework"

# update & install packages
RUN sed -i 's/archive/by.archive/' /etc/apt/sources.list

# enable systemd.
RUN apt-get update ; \
    apt-get install -y systemd systemd-sysv ;

RUN DEBIAN_FRONTEND=noninteractive apt -y install \
    apache2 postgresql postgresql-contrib php php-pgsql

# service enable
RUN systemctl enable apache2
RUN systemctl enable postgresql.service

# setup apache root dir
RUN sed -i 's/DocumentRoot\ \/var\/www\/html/DocumentRoot\ \/var\/www\/CyberFramework/g' /etc/apache2/sites-available/000-default.conf

# display php errors
RUN sed -i 's/display_errors\ =\ Off/display_errors\ =\ On/g' /etc/php/8.1/apache2/php.ini

CMD ["/lib/systemd/systemd"]