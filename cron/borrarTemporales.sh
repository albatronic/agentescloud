#!/bin/sh

touch /home/albatro/public_html/agentescloud/cron/log.txt

echo "Borrado de archivos temporales `date`" >> /home/albatro/public_html/agentescloud/cron/log.txt
echo "------------------------------------------------------------" >> /home/albatro/public_html/agentescloud/cron/log.txt

rm -Rf /home/albatro/public_html/agentescloud/docs/docs1/pdfs/*
rm -Rf /home/albatro/public_html/agentescloud/docs/docs1/uploads/*
echo "Temporales docs1" >> /home/albatro/public_html/agentescloud/cron/log.txt

echo " " >> /home/albatro/public_html/agentescloud/cron/log.txt