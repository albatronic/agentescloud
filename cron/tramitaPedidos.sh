#!/bin/sh

touch /home/albatro/public_html/Hermes/cron/log.txt

echo "Borrado de archivos temporales `date`" >> /home/albatro/public_html/Hermes/cron/log.txt
echo "------------------------------------------------------------" >> /home/albatro/public_html/Hermes/cron/log.txt

rm -Rf /home/albatro/public_html/Hermes/docs/docs1/pdfs/*
rm -Rf /home/albatro/public_html/Hermes/docs/docs1/tmp/*
rm -Rf /home/albatro/public_html/Hermes/docs/docs1/export/*
echo "Temporales docs1" >> /home/albatro/public_html/Hermes/cron/log.txt

echo " " >> /home/albatro/public_html/Hermes/cron/log.txt