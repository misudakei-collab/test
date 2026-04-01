＃アプリケーション名

FashionablyLate お問い合わせ管理システム（仮）

＃＃環境構築


-Docker: docker-compose up -d;

-git clone git@github.com:misudakei-collab/test.git

-Migration & Seeding: php artisan migrate --seed


＃＃使用技術（実行環境）

Language:	PHP 8.5.3;	

Framework:	Laravel 13.1.1;	

Database:	SQLite;	

Infrastructure: Docker / Laravel Sail

Frontend:	HTML5 / CSS3　（BLADE)	


＃＃ER図

users:	        管理者情報（ログイン認証用）

categories:	お問い合わせ種別（「商品について」「その他」など）

contacts:	お問い合わせ主データ


<img width="252" height="474" alt="ER図" src="https://github.com/user-attachments/assets/19ad0505-95be-4b4b-a35b-6c5b2e3e8e22" />



ユースケース


一般ユーザー: お問い合わせの入力・確認・送信

管理者: ログイン・一覧検索・詳細閲覧（モーダル表示）・削除・CSV出力

<img width="904" height="427" alt="ユースケース図" src="https://github.com/user-attachments/assets/10da6967-cbab-4dbe-be01-82409ed98d05" />


＃URL


お問い合わせフォーム: http://localhost/

ログインページ: http://localhost/login

ユーザー登録ページ: http://localhost/register
