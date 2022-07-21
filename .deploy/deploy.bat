set SESSION=".test/deltine@ftp-deltine.heteml.net"

set APP_LOCAL="%~dp0/../project/frontend/app/public"
set APP_REMOTE="/home/users/0/deltine/web/example2022.xyz/app"

winscp.exe /script=upload.txt /parameter %SESSION% %APP_LOCAL% %APP_REMOTE% /console

set HOME_LOCAL="%~dp0/../project/frontend/home/public"
set HOME_REMOTE="/home/users/0/deltine/web/example2022.xyz/home"

winscp.exe /script=upload.txt /parameter %SESSION% %HOME_LOCAL% %HOME_REMOTE% /console

set PHP_LOCAL="%~dp0/../project/backend/php"
set PHP_REMOTE="/home/users/0/deltine/php"

winscp.exe /script=upload.txt /parameter %SESSION% %PHP_LOCAL% %PHP_REMOTE% /console