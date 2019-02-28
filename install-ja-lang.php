<?php

const Version = '5.7';

function getLangContent($str)
{
    $deletedTail = preg_replace('/<\/code><\/pre>[\s\S]+/', "\n", $str);
    $deletedHead = preg_replace('/[\s\S]+<pre><code>/', '', $deletedTail);
    $decoded = html_entity_decode($deletedHead, ENT_QUOTES);

    return $decoded;
}

// ja言語ファイルディレクトリ作成
if (false === is_dir(getcwd().'/resources/lang/ja')) {
    if (false === mkdir(getcwd().'/resources/lang/ja', 0777, true)) {
        file_put_contents('php://stderr', getcwd().'/resources/lang/jaディレクトリを作成できませんでした。'.PHP_EOL);

        exit(1);
    }
}

// 認証メッセージファイル作成
$authContents = getLangContent(file_get_contents('https://readouble.com/laravel/'.Version.'/ja/auth-php.html'));

if (false === file_put_contents(getcwd() . '/resources/lang/ja/auth.php', $authContents)) {
    file_put_contents('php://stderr', getcwd() . '/resources/lang/ja/auth.phpファイルを出力できませんでした。' . PHP_EOL);

    exit(1);
}

// ペジネーションメッセージファイル作成
$paginationContents = getLangContent(file_get_contents('https://readouble.com/laravel/'.Version.'/ja/pagination-php.html'));

if (false === file_put_contents(getcwd().'/resources/lang/ja/pagination.php', $paginationContents)) {
    file_put_contents('php://stderr', getcwd().'/resources/lang/ja/pagination.phpファイルを出力できませんでした。'.PHP_EOL);

    exit(1);
}

// パスワードリセットメッセージファイル作成
$passwordsContents = getLangContent(file_get_contents('https://readouble.com/laravel/'.Version.'/ja/passwords-php.html'));

if (false === file_put_contents(getcwd() . '/resources/lang/ja/passwords.php', $passwordsContents)) {
    file_put_contents('php://stderr', getcwd() . '/resources/lang/ja/passwords.phpファイルを出力できませんでした。' . PHP_EOL);

    exit(1);
}

// バリデーションメッセージファイル作成
$validationContents = getLangContent(file_get_contents('https://readouble.com/laravel/'.Version.'/ja/validation-php.html'));

if (false === file_put_contents(getcwd() . '/resources/lang/ja/validation.php', $validationContents)) {
    file_put_contents('php://stderr', getcwd() . '/resources/lang/ja/validation.phpファイルを出力できませんでした。' . PHP_EOL);

    exit(1);
}
