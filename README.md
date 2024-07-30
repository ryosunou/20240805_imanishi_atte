# アプリケーション名　(Atte)  
 企業の勤怠管理システム
<img width="944" alt="image" src="https://github.com/user-attachments/assets/0d673d17-1af9-4241-8b10-5deb3ea9f886">

 ### 作成した目的<br>
 人事評価のため

## アプリケーションURL<br>
http://localhost/

ログインの際の注意<br>
パスワード管理：パスワードは他人と共有せず、安全に保管してください。推測されにくいパスワードを設定してください。 <br>セッション管理：パブリックの場所や共有PCでの使用後は必ずログアウトしてください。ログインセッションは一定時間後に自動的にタイムアウトします。

## 他のリポジトリ

## 機能一覧 <br>
項目	注意点
会員登録	Laravelの認証機能を利用
ログイン	
ログアウト	
勤務開始	日を跨いだ時点で翌日の出勤操作に切り替える
勤務終了	
休憩開始	1日で何度も休憩が可能
休憩終了	
日付別勤怠情報取得	
ページネーション	5件ずつ取得

## 使用技術（実行環境)<br>
PHP 8.3.4<br>Laravel8.83.27<br>MySQL8.0.37

## テーブル設計

## ER図
![スクリーンショット 2024-07-28 202301](https://github.com/user-attachments/assets/bf082e8f-cbcb-45ff-94c4-7a4020644450)

# 環境構築
#### <br>Dockerビルド

#### 1.git clone git@github.com:estra-inc/confirmation-test-contact-form.git<br>
#### DockerDesktopアプリを立ち上げる<br>
#### docker-compose up -d --build

#### Laravel環境の構築<br>

#### docker-compose exec php bash<br>composer install<br>

#### 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、.envファイルを作成します.env以下の環境変数を追加<br>DB_CONNECTION=mysql<br>DB_HOST=mysql<br>DB_PORT=3306<br>DB_DATABASE=laravel_db<br>DB_USERNAME=laravel_user<br>
DB_PASSWORD=laravel_pass<br>

### アプリケーションキーの作成<br>
php artisan key:generate<br>

### マイグレーションの実行<br>
php artisan migrate<br>

### シーディングを実行する<br>
php artisan db:seed





