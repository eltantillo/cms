FROM mattrayner/lamp as builder
COPY ./ /var/www/html/
CMD ["/run.sh"]