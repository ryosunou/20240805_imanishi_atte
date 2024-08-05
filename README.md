# アプリケーション名　(Atte)  
 企業の勤怠管理システム
<img width="944" alt="image" src="https://github.com/user-attachments/assets/0d673d17-1af9-4241-8b10-5deb3ea9f886">

 ### 作成した目的<br>
 人事評価のため

## アプリケーションURL<br>
http://localhost/

ログインの際の注意<br>
パスワード管理：パスワードは他人と共有せず、安全に保管してください。推測されにくいパスワードを設定してください。 <br>セッション管理：パブリックの場所や共有PCでの使用後は必ずログアウトしてください。ログインセッションは一定時間後に自動的にタイムアウトします。


## 機能一覧 <br>
項目 注意点<br>
会員登録	  Laravelの認証機能を利用<br>
ログイン	
ログアウト<br>	
勤務開始	   日を跨いだ時点で翌日の出勤操作に切り替える<br>
勤務終了<br>
休憩開始   	1日で何度も休憩が可能<br>
休憩終了<br>	
日付別勤怠情報取得<br>	
ページネーション	5件ずつ取得

## 使用技術（実行環境)<br>
PHP 8.3.4<br>Laravel8.83.27<br>MySQL8.0.37

## テーブル設計

![スクリーンショット 2024-08-01 080726](https://github.com/user-attachments/assets/58688510-ded0-477f-bdae-b15d317b8e55)


![スクリーンショット 2024-08-01 080757](https://github.com/user-attachments/assets/7fb3cca5-f8c9-4d79-ac93-e0610c52854a)

![スクリーンショット 2024-08-02 064344](https://github.com/user-attachments/assets/a5a20ac9-712f-4fb8-875f-8c60767ac25a)



## ER図
![スクリーンショット 2024-07-28 202301](https://github.com/user-attachments/assets/bf082e8f-cbcb-45ff-94c4-7a4020644450)

# 環境構築
## <br>Dockerビルド

#### 1.git clone　git@github.com:ryosunou/20240805_imanishi_atte.git<br>
#### 2.DockerDesktopアプリを立ち上げる<br>
#### 3.docker-compose up -d --build



## Laravel環境の構築<br>

#### 1.docker-compose exec php bash<br>
#### 2.composer install
     

#### 3.「.env.example」ファイルを 「.env」ファイルに命名を変更。または、.envファイルを作成します<br>
#### 4. .env以下の環境変数を追加<br>

##### DB_CONNECTION=mysql<br>
##### DB_HOST=mysql<br>
##### DB_PORT=3306<br>
##### DB_DATABASE=laravel_db<br>
##### DB_USERNAME=laravel_user<br>
##### DB_PASSWORD=laravel_pass<br>

### 5.アプリケーションキーの作成<br>
php artisan key:generate<br>

### 6.マイグレーションの実行<br>
php artisan migrate<br>

### 7.シーディングを実行する<br>
php artisan db:seed

URL<br>
・開発環境：http://localhost/<br>
・phpMyAdmin:：http://localhost:8080/









