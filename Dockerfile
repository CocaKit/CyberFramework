FROM ubuntu:latest

LABEL maintainer="Nikita Ignatushko <nikuta331200@gmail.com>"
LABEL description="This Dockerfile installs envirment for CyberFramework"

# update & install packages
RUN sed -i 's/archive/by.archive/' /etc/apt/sources.list

# Enable systemd.
RUN apt-get update ; \
    apt-get install -y systemd systemd-sysv ;

RUN DEBIAN_FRONTEND=noninteractive apt -y install \
    apache2 postgresql postgresql-contrib php php-pgsql

# service enable
RUN systemctl enable apache2
RUN systemctl enable postgresql.service

CMD ["/lib/systemd/systemd"]