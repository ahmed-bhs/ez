FROM node:boron

ADD entrypoint.bash /opt/entrypoint.bash
RUN chmod a+x /opt/entrypoint.bash
ENTRYPOINT [ "/opt/entrypoint.bash" ]

USER 1000:1000
CMD yarn run dev

WORKDIR /var/www/html/project/ezplatform
