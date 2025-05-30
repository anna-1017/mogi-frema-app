

# coachtechフリマ

アイテムの出品と購入を行うためのフリマアプリ開発


## 環境構築

**Dockerビルド**
1. git clone git@github.com:anna-1017/mogi-frema-app.git
2. DockerDesktopアプリを立ち上げる
3. docker-compose up -d --build


**Laravel環境構築**
1. docker-compose exec php bash
2. composer install
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
4. .envに以下の環境変数を追加
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

5. アプリケーションキーの作成
```
php artisan key:generate
```
6. マイグレーションの実行
```
php artisan migrate
```
7. シーディングの実行
```
php artisan db:seed
```

## 使用技術（実行環境）
- PHP7.4.9
- Laravel8.83.8
- MySQL8.0.26

## ER図

![ER図](er_mogi_frema_app.diagram.drawio.png)

## URL
- 開発環境：http://localhost
- phpMyAdmin:：http://localhost:8080/

## ログイン情報

## 一般ユーザー1
- メールアドレス：test1@example.com
- パスワード：password1

### 一般ユーザー2
- メールアドレス：test2@example.com
- パスワード：password2


## テストの実行方法
以下のコマンドでFeatureテストを実行
```
php artisan test
```

