# 1.アプリケーション名

FashionablyLate お問い合わせ管理システム（仮）

# 2.環境構築


# リポジトリのクローン
git clone git@github.com:misudakei-collab/test.git
cd test

# Dockerコンテナの起動
./vendor/bin/sail up -d

# 依存パッケージのインストール
./vendor/bin/sail composer install

# 環境設定ファイルの準備
cp .env.example .env
./vendor/bin/sail artisan key:generate

# マイグレーション & シーディング（DB構築）
./vendor/bin/sail artisan migrate --seed


# 3.使用技術（実行環境）

Language:	PHP 8.5.3;	

Framework:	Laravel 13.1.1;	

Database:	SQLite;	

Infrastructure: Docker / Laravel Sail

Frontend:	HTML5 / CSS3　（BLADE)	


# 4.ER図

users: 管理者情報（ログイン認証用）

categories: お問い合わせ種別（「商品について」「その他」など）

contacts: お問い合わせ主データ（氏名、メール、内容など）


<img width="252" height="474" alt="ER図" src="https://github.com/user-attachments/assets/19ad0505-95be-4b4b-a35b-6c5b2e3e8e22" />



# 5.ユースケース


# 一般ユーザー
お問い合わせフォーム入力;

入力内容の確認画面;

送信完了メッセージ（サンクスページ）;

# 管理者
ログイン・ログアウト機能;

お問い合わせ一覧表示・詳細閲覧（モーダル）;

検索機能（名前、性別、お問い合わせ種別、キーワード）;

データ削除機能;

CSV出力機能;

<img width="904" height="427" alt="ユースケース図" src="https://github.com/user-attachments/assets/10da6967-cbab-4dbe-be01-82409ed98d05" />


# 6.URL


お問い合わせフォーム: http://localhost/

ログインページ: http://localhost/login

ユーザー登録ページ: http://localhost/register
