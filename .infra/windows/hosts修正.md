# hosts修正

## 内容

windowsの場合、以下のファイルにホスト名を登録
code C:\Windows\System32\drivers\etc\hosts

127.0.0.1       example-home.jp
127.0.0.1       example-app.jp
127.0.0.1       example-php.jp
127.0.0.1       example-laravel.jp

## 理由

以下のURLで各webアプリへアクセスするため
<https://example-app.jp/>
<https://example-home.jp/>
<https://example-php.jp/>
<https://example-laravel.jp/>
