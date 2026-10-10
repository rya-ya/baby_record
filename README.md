# Baby Record

## アプリ概要

赤ちゃんのミルク・おむつ・睡眠の記録を日付ごとに管理できる育児記録アプリです。

## 主な機能

- ユーザー登録・ログイン・ログアウト
- 赤ちゃん情報の登録・編集・削除
- ミルク・おむつ・睡眠の記録管理
- 日付ごとの育児記録の表示

## 使用技術

- **バックエンド：** PHP 8.2 / Laravel 12
- **フロントエンド：** Blade / Tailwind CSS / JavaScript
- **データベース：** MySQL 8.0
- **開発環境：** Docker / Docker Compose
- **インフラ：** AWS EC2 / Caddy / DuckDNS
- **バージョン管理：** Git / GitHub

## セキュリティ対策

- LaravelのPolicyによる認可処理
- ログイン必須ページへのアクセス制御
- バリデーションによる入力値の検証
- 本番環境でのHTTPS通信

## ローカル環境の起動方法

### 1. リポジトリのクローン

```bash
git clone <GitHubリポジトリのURL>
cd baby_rec
```

### 2. 環境設定

以下のファイルを作成・設定します。

- `src/.env`
- `docker/db/db-variables.env`

データベースの接続情報を両ファイルで一致させます。

### 3. コンテナの起動

```bash
docker compose up -d --build
```

### 4. アプリケーションの初期設定

```bash
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app npm install
docker compose exec app npm run build
docker compose exec app php artisan migrate --seed
```

### 5. アクセス

http://localhost

## 本番環境

AWS EC2上にDocker Composeでアプリケーションを構築し、CaddyでHTTPS通信を行っています。

DuckDNSでドメインとEC2のIPアドレスを紐付け、CaddyでHTTPS証明書を自動管理しています。

- **公開URL：** https://baby-record.duckdns.org
- **本番用設定：** `docker-compose.prod.yml`
- **ドメイン・HTTPS：** DuckDNS / Caddy

本番環境の設定ファイルや認証情報はGit管理対象外とし、環境ごとに分けて管理しています。
