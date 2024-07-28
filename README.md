# 20240805_imanishi_atte

アプリケーション名　Atte  
企業の勤怠管理システム
<img width="944" alt="image" src="https://github.com/user-attachments/assets/0d673d17-1af9-4241-8b10-5deb3ea9f886">

作成した目的<br>人事評価のため

アプリケーションURL
http://localhost/

ログインの際の注意
パスワード管理：パスワードは他人と共有せず、安全に保管してください。推測されにくいパスワードを設定してください。
セッション管理：パブリックの場所や共有PCでの使用後は必ずログアウトしてください。ログインセッションは一定時間後に自動的にタイムアウトします。

他のリポジトリ

機能一覧 会員登録
ログイン、ログアウト	Laravelの認証機能を利用
勤務開始	、勤務終了	　日を跨いだ時点で翌日の出勤操作に切り替える
休憩開始	、休憩終了　 1日で何度も休憩が可能	
日付別勤怠情報取得	
ページネーション	    5件ずつ取得

使用技術（実行環境）
PHP 8.3.4
Laravel8.83.27
MySQL8.0.37

テーブル設計

ER図
![スクリーンショット 2024-07-28 202301](https://github.com/user-attachments/assets/bf082e8f-cbcb-45ff-94c4-7a4020644450)

環境構築
Dockerビルド

git clone git@github.com:estra-inc/confirmation-test-contact-form.git
DockerDesktopアプリを立ち上げる
docker-compose up -d --build

mysql:
    platform: linux/x86_64(この文追加)
    image: mysql:8.0.26
    environment:
Laravel環境の構築

docker-compose exec php bash
composer install
「.env.example」ファイルを 「.env」ファイルに命名を変更。または、.envファイルを作成します
.env以下の環境変数を追加
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
アプリケーションキーの作成
php artisan key:generate
マイグレーションの実行
php artisan migrate
シーディングを実行する
php artisan db:seed





