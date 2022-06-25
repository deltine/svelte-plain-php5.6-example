# コマンド

## 起動

docker-compose build --no-cache
docker-compose up -d
docker-compose down
docker system prune --volumes

## サービス内に移動

docker compose exec app bash
docker compose exec app find / -name sendmail

## サービス内のコマンド

find / -name mhsendmail
/usr/local/bin/mhsendmail

https://qiita.com/yoh-nak/items/0abf72afc849e3fdb682
pear channel-update pear.php.net
pear list
pear -V
pear install
pear upgrade
pear list-all

