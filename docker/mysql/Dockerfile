FROM mysql
ADD script/init.sql /docker-entrypoint-initdb.d/init.sql

RUN chmod -R  +x /docker-entrypoint-initdb.d
RUN chown -R mysql:mysql /docker-entrypoint-initdb.d/