# Basic Docker Commands
docker build -t eltantillo/edu-kndo .
docker push eltantillo/edu-kndo
docker exec -i edu-kndo mysql -u root mysql < /var/www/html/edu-kndo/protected/data/data.sql
docker exec -it edu-kndo bash
docker system prune
docker volume prune

# DB and files Backup
export FOLDER=$(date +%Y-%m-%d)
mkdir ~/backup/edu-kndo/$FOLDER
docker exec edu-kndo mysqldump -u root --databases edu-kndo --add-drop-database > ~/backup/edu-kndo/$FOLDER/backup.sql
docker exec edu-kndo tar -czvf files.tar.gz /var/www/html/files /var/www/html/avatars
docker cp edu-kndo:files.tar.gz ~/backup/edu-kndo/$FOLDER
docker exec edu-kndo rm files.tar.gz

# Rebuild Docker instance
docker stop edu-kndo
docker rm edu-kndo
docker run --name edu-kndo -d -p "8082:80" eltantillo/edu-kndo
docker exec edu-kndo sed -i '3d' /var/www/html/controllers/config.php

# Restore DB and files
export FOLDER=2020-03-19
docker exec -i edu-kndo mysql -u root mysql < ~/backup/edu-kndo/$FOLDER/backup.sql
docker cp ~/backup/edu-kndo/$FOLDER/files.tar.gz edu-kndo:files.tar.gz
docker exec edu-kndo tar -xzvf files.tar.gz
docker exec edu-kndo rm files.tar.gz
docker exec -i edu-kndo ./var/www/html/protected/yiic migrate

server{
        server_name edu-kndo.com www.edu-kndo.com
        listen 80;
        location / {
                proxy_pass "http://127.0.0.1:8082";
        }
}


crontab -e
# GDDManager Backup
0 0 * * * mkdir /home/eltantillo/backup/gddmanager/`/bin/date +\%Y-\%m-\%d`
0 0 * * * docker exec gddmanager mysqldump -u root --databases gddmanager --add-drop-database > /home/eltantillo/backup/gddmanager/`/bin/date +\%Y-\%m-\%d`/backup.sql
0 0 * * * docker exec gddmanager tar -czvf files.tar.gz /var/www/html/files
0 0 * * * docker cp gddmanager:files.tar.gz /home/eltantillo/backup/gddmanager/`/bin/date +\%Y-\%m-\%d`
0 0 * * * docker exec gddmanager rm files.tar.gz
# Edu-kndo Backup
0 0 * * * mkdir ~/backup/edu-kndo/`/bin/date +\%Y-\%m-\%d`
0 0 * * * docker exec edu-kndo mysqldump -u root --databases edu-kndo --add-drop-database > ~/backup/edu-kndo/`/bin/date +\%Y-\%m-\%d`/backup.sql
0 0 * * * docker exec edu-kndo tar -czvf files.tar.gz /var/www/html/files /var/www/html/avatars
0 0 * * * docker cp edu-kndo:files.tar.gz ~/backup/edu-kndo/`/bin/date +\%Y-\%m-\%d`
0 0 * * * docker exec edu-kndo rm files.tar.gz