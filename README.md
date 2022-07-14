# 絵本読み聞かせ記録・管理アプリ「よんで」

![home_top](https://user-images.githubusercontent.com/57904570/128121282-59478da6-d32b-449b-8389-c1f4c991eafa.png)

<br><br>

## ローカル環境でのアプリケーションの起動

以下のコマンドを実行してアプリケーションを起動します。

※ Git と Docker を使用します

```bash
git clone https://github.com/ryamate/yonde-web-app.git
cd yonde-web-app
make init
docker compose exec web npm install
docker compose exec web npm run dev
```

※ `make init` コマンドについては、Makefile を参照ください

ブラウザで、下記にアクセスします。

[http://localhost/](http://localhost/)

<br>

### アプリケーションの削除

```bash
make destroy
cd ..
rm -rf yonde-web-app/
```

<br><br>

## 1. アプリ概要

**絵本の読み聞かせの記録・管理を、家族と共有できる Web アプリケーション**です。

<br>

私の子どもが絵本大好きで、夫婦でたくさんの絵本を読み聞かせしてきました。

生活の一部になっている絵本の読み聞かせですが、以下のような困りごともありました。

<br>

**絵本を読み聞かせしてきたことは成長とともに子どもは忘れてしまう。**

**読み聞かせをするモチベーションが上がらない時がある。**

**絵本選びに困ることがある。**

<br>

これらの困りごとを解決したい、という思いでアプリを作成しました。

<br>

アプリ作成についての記事を [Qiita](https://t.co/pqX4XJz5Tk?amp=1) に投稿していますので、ご覧いただけますと幸いです（ Qiita 記事には、アプリ自体のご紹介のほか、アプリ作成に至るまでの学習内容などをまとめております）。

<br><br>

## 2. 使用技術

### フロントエンド

-   HTML
-   CSS、Sass
-   jQuery 3.5.1
-   Bootstrap 4.5.0
-   Vue.js 2.6.11

### バックエンド

-   PHP 7.4.13
-   Laravel 6.20.20
-   MySQL 8.0.23
-   composer
-   PHPUnit

### インフラ

-   Docker 20.10.6 / docker-compose 1.29.1 （開発環境）
-   AWS ( EC2, ALB, ACM, S3, RDS, CloudFormation, Route53, VPC, EIP, IAM )
-   nginx 1.18
-   CircleCI 2.1

### その他

-   Git 2.28.0 / GitHub
-   PHPMyAdmin
-   VSCode（Remote Development）

<br><br>

## 3. インフラ構成図 & 自動デプロイの流れ

![20210731_Infra](https://user-images.githubusercontent.com/57904570/128120512-4821e512-0118-46e8-8e6c-fccc00988238.png)

<br><br>

## 4. ER 図

![20210729_yonde_erd](https://user-images.githubusercontent.com/57904570/128120475-584212de-37a2-4401-8743-adb138d495bb.png)

<br><br>

## 5. アプリの特徴

### 絵本の Web 本棚

気になる絵本、これまで読んだ絵本を登録することができる機能を実装しています。
![bookshelf](https://user-images.githubusercontent.com/57904570/128121541-21e599bb-ed7d-461c-8b96-494ade0cc3ec.png)

他の家族の本棚も閲覧できるようにしており、新しい絵本との出会いを目的の一つとして利用できるようにしています。

<br>

### 読み聞かせの記録・管理

本棚の登録絵本についての読み聞かせを記録する機能を実装しています。

![read_records](https://user-images.githubusercontent.com/57904570/128121890-a32849f1-aa5a-4be2-ae63-83bc9d7c1b73.png)

いつ、どの子に読んだか、どんなリアクションだったか、などの具体的な記録が手軽に継続して行えるよう、文字入力は最小限になる工夫をしました。

![read_records_gif](https://user-images.githubusercontent.com/57904570/128122005-fb277897-f2cf-494a-b64a-d87c73cb358e.gif)

<br>

### 家族と共有

本棚・読み聞かせ記録を家族と共有することができるよう、家族ユーザーとしての招待機能を実装しています。

![invite_family](https://user-images.githubusercontent.com/57904570/128122122-badffaeb-decf-4905-a5de-98f6dc94cc97.png)

SendGrid を用いて、招待メールが自動送信されるよう機能を実装しました。

![invite_mail](https://user-images.githubusercontent.com/57904570/128122228-66c7adf2-9de3-42e7-9a8c-3cd51a8abc73.png)

<br>
<br>

## 6. アプリの機能一覧

### メイン機能

-   **家族ユーザー招待**（メールツール SendGrid）
-   **絵本登録**（CRUD 処理）
-   **絵本読み聞かせ記録**（CRUD 処理）
    -   子どもタグ、読み聞かせメモタグ（Vue.js, Vue Tugs Input）
-   **絵本検索**（Google Books API、ページネーション）
-   **本棚表示/タイムライン表示**（無限スクロール）
    -   本棚内の絵本検索（Vue.js, Vue Tugs Input）
    -   いいね（Vue.js）
    -   フォロー（Vue.js）
-   **お問い合わせフォーム**（メールツール SendGrid）
-   **トップページでのランキング表示**

<br>

### 認証機能

-   ユーザー登録・ログイン・ログアウト
-   Google アカウントを使ったユーザー登録・ログイン
-   ゲストログイン
-   メールアドレス認証
-   パスワード再設定
-   プロフィール編集
-   退会

<br><br>

#### （参考）絵本検索

Google Books API で書籍データを取得しています。なお、検索された絵本の登録数、読み聞かせ数、評価平均、レビュー数については、データベースから取得しています。

![search_books_gif](https://user-images.githubusercontent.com/57904570/128122508-ad88e8ca-a0c3-43f3-9a72-0a2994181ab0.gif)

表示にはページネーション機能を利用しています。

<br>

#### （参考）タイムライン表示

無限スクロールを取り入れています。

![time_line](https://user-images.githubusercontent.com/57904570/128122798-25b21687-4ab1-4f65-8849-8a6719e33e43.gif)

<br>

#### （参考）ゲストログイン

![guest_login](https://user-images.githubusercontent.com/57904570/128120894-8cb3de67-6f5e-4175-965e-0222509c0f32.png)

<br><br>

## 開発者

-   R.Yamate
-   Twitter アカウント：https://twitter.com/r_yamate
