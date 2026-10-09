# Baby Record

## アプリ概要

Baby Recordは、赤ちゃんの育児記録を管理するWebアプリケーションです。

ミルク・おむつ・睡眠の記録を日付ごとに管理でき、赤ちゃんの日々の様子を簡単に振り返ることができます。

## 制作背景・目的

育児中は、ミルクをあげた時間やおむつを交換した時間、睡眠時間など、日々さまざまな情報を記録する必要があります。

そこで、これらの情報をまとめて管理し、必要なときに簡単に確認できるアプリケーションを制作しました。

また、Laravelを使用したWebアプリケーションの開発を通じて、CRUD処理、認証・認可、データベース設計、Dockerを利用した開発環境構築などの技術を習得することも目的としています。

## 主な機能

### ユーザー機能
- ユーザー登録
- ログイン・ログアウト

### 赤ちゃん管理機能
- 赤ちゃんの新規登録
- 赤ちゃん情報の編集・削除
- 赤ちゃんごとの記録管理

### 育児記録機能
- ミルクの登録・編集・削除
- おむつの登録・編集・削除
- 睡眠の登録・編集・削除
- 日付ごとの記録表示

## 使用技術

### バックエンド
- PHP
- Laravel

### フロントエンド
- HTML
- Tailwind CSS
- JavaScript
- Blade

### データベース
- MySQL

### 開発環境
- Docker
- Docker Compose
- Git
- GitHub

## データベース構成

主なテーブルは以下のとおりです。

- users：ユーザー情報
- homes：家族情報
- babies：赤ちゃん情報
- days：日付ごとの記録
- milks：ミルク記録
- diapers：おむつ記録
- sleeps：睡眠記録

ユーザー、家族、赤ちゃん、日付ごとの記録を関連付けて管理しています。

## セキュリティ面での工夫

- ログインが必要なページへのアクセス制御
- LaravelのPolicyを利用した認可処理
- URLで指定された赤ちゃんと育児記録の関連性チェック
- バリデーションによる入力値の検証

## 起動方法

### 1. 前提条件

以下の環境がインストールされていることを前提とします。

- Docker
- Docker Compose
- Git

### 2. リポジトリのクローン

```bash
git clone <GitHubリポジトリのURL>
cd baby_rec
```

### 3. データベースの環境変数設定

プロジェクトのルートディレクトリにて、`docker/db/db-variables.env` を作成します。

```dotenv
MYSQL_ROOT_PASSWORD=任意のローカル開発用パスワード
MYSQL_DATABASE=baby_record
MYSQL_USER=baby_user
MYSQL_PASSWORD=任意のローカル開発用パスワード
```

### 4. Laravelの環境設定

`.env.example` をコピーして、`.env` を作成します。

```bash
cp src/.env.example src/.env
```

`src/.env` のデータベース接続設定を以下のように変更します。

```dotenv
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=baby_record
DB_USERNAME=baby_user
DB_PASSWORD=手順3で設定したMYSQL_PASSWORDと同じ値
```

### 5. Dockerコンテナのビルド・起動

```bash
docker compose up -d --build
```

### 6. PHPライブラリのインストール

```bash
docker compose exec app composer install
```

### 7. Laravelのアプリケーションキー生成

```bash
docker compose exec app php artisan key:generate
```

設定キャッシュをクリアします。

```bash
docker compose exec app php artisan config:clear
```

### 8. JavaScriptライブラリのインストール・ビルド

依存パッケージをインストールします。

```bash
docker compose exec app npm install
```

ViteでCSS・JavaScriptをビルドします。

```bash
docker compose exec app npm run build
```

### 9. データベースの構築

マイグレーションとシーダーを実行します。

```bash
docker compose exec app php artisan migrate --seed
```

### 10. アプリケーションへのアクセス

ブラウザで以下のURLにアクセスします。

http://localhost

### 補足

- `.env`、`docker/db/db-variables.env`、データベースのデータはGit管理対象外です。
- データベースを新規構築する場合、以前のユーザー情報や育児記録は引き継がれません。
- パスワードなどの機密情報はGitHubに登録しないでください。

## 今後の改善予定

- 操作性や画面デザインの改善
- 必要に応じた機能追加
