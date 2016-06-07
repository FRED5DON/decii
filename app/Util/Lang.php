<?php
/**
 * Created by Fred.
 * User: fred
 * Date: 16/5/28
 * Time: 下午9:50
 */

//语言指示map
return [
    'currentLang' => isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'zh',
    'nav-feature' => array(
        'en' => 'Feature',
        'zh' => '发现',
        'jp' => '発見',
    ),
    'nav-msg' => array(
        'en' => 'Message',
        'zh' => '消息',
        'jp' => 'ニュース',
    ),
    'nav-lab' => array(
        'en' => 'Lab',
        'zh' => '实验室',
        'jp' => '実験室',
    ), 'nav-write' => array(
        'en' => 'Poster',
        'zh' => '发布',
        'jp' => '発表',
    ),
    'nav-setting' => array(
        'en' => 'Settings',
        'zh' => '设置',
        'jp' => '設置',
    ),
    'nav-signup' => array(
        'en' => 'Sign Up',
        'zh' => '注册',
        'jp' => '登録',
    ),
    'nav-signin' => array(
        'en' => 'Sign In',
        'zh' => '登录',
        'jp' => 'サインイン',
    ),
    'nav-signout' => array(
        'en' => 'Sign Out',
        'zh' => '登出',
        'jp' => 'ログオフ',
    ),
    'nav-usrinfo' => array(
        'en' => 'Profile',
        'zh' => '个人资料',
        'jp' => '私の資料',
    ),
    'reply' => array(
        'en' => 'Reply',
        'zh' => '回复',
        'jp' => '回復',
    ),
    'lang' => array(
        'en' => 'English',
        'zh' => '中文',
        'jp' => '日本語',
    ),
    'back2top' => array(
        'en' => 'Back 2 Top',
        'zh' => '返回顶部',
        'jp' => '顶上に戻る',
    ),
    'cancel' => array(
        'en' => 'Cancel',
        'zh' => '取消',
        'jp' => '取り消し',
    ),
    'no' => array(
        'en' => 'No',
        'zh' => '不了',
        'jp' => 'いいえ',
    ), 'yes' => array(
        'en' => 'Yes',
        'zh' => '是的',
        'jp' => 'はい',
    ),
    'remember' => array(
        'en' => 'Remember Me',
        'zh' => '记住登录',
        'jp' => 'ログイン状態を覚え',
    ), 'email' => array(
        'en' => 'Email',
        'zh' => '邮箱',
        'jp' => 'メール',
    ),
    'username' => array(
        'en' => 'UserName',
        'zh' => '用户名',
        'jp' => 'ユーザー名',
    ),
    'password' => array(
        'en' => 'Password',
        'zh' => '密码',
        'jp' => 'パスワード',
    ), 'confirmPassword' => array(
        'en' => 'Confirm Password',
        'zh' => '确认密码',
        'jp' => 'パスワードを確認する',
    ),
    'agree' => array(
        'en' => 'Agree',
        'zh' => '同意',
        'jp' => '认め',
    ),
    'agreement' => array(
        'en' => 'User agreement',
        'zh' => '用户协议',
        'jp' => 'ユーザーの合意',
    ),
    'input' => array(
        'en' => 'Input',
        'zh' => '输入',
        'jp' => '入力',
    ),
    'vcode' => array(
        'en' => 'Verification code',
        'zh' => '验证码',
        'jp' => '検証コード',
    ), 'verify-error-user' => array(
        'en' => 'Username or password error',
        'zh' => '用户名或密码不正确',
        'jp' => 'ユーザー名やパスワードは正しい',
    ),
    'direct-login-info' => array(
        'en' => 'Existing account? Click here to ',
        'zh' => '已有账号？立即',
        'jp' => 'アカウントはありますか？すぐに',
    ),
    //note Publish
    'title' => array(
        'en' => 'Title',
        'zh' => '标题',
        'jp' => '標題',
    ),
    'remark' => array(
        'en' => 'Remark',
        'zh' => '摘要',
        'jp' => '要旨',
    ),
    'content' => array(
        'en' => 'Content',
        'zh' => '正文',
        'jp' => '本文',
    ),
    'keyword' => array(
        'en' => 'Keyword',
        'zh' => '关键字',
        'jp' => 'キーワード',
    ),
    'submit' => array(
        'en' => 'Submit',
        'zh' => '提交',
        'jp' => '提出する',
    ),
    'publish' => array(
        'en' => 'Publish',
        'zh' => '发布',
        'jp' => 'リリース',
    ),
    'save' => array(
        'en' => 'Save',
        'zh' => '保存',
        'jp' => 'アーカイブ',
    ),
    'complete' => array(
        'en' => 'Complete',
        'zh' => '完成',
        'jp' => '完成する',
    ),
    'setting' => array(
        'en' => 'Settings',
        'zh' => '设置',
        'jp' => '設置',
    ),
    'type' => array(
        'en' => 'Type',
        'zh' => '类型',
        'jp' => 'タイプ',
    ),
    'categories' => array(
        'en' => 'Categories',
        'zh' => '分类',
        'jp' => 'カテゴリー',
    ),
    'time' => array(
        'en' => 'Time',
        'zh' => '时间',
        'jp' => '時間',
    ),
    'date' => array(
        'en' => 'Date',
        'zh' => '日期',
        'jp' => 'ナツメヤシ',
    ),
    'word' => array(
        'en' => 'Word',
        'zh' => '字',
        'jp' => 'ワード',
    ),
    //sentences 提示语句
    'st_verifycode_error' => array(
        'en' => 'The verification code error',
        'zh' => '验证码错误',
        'jp' => '検証コードエラー',
    ),
    'st_username_error' => array(
        'en' => 'The username is incorrect',
        'zh' => '用户名不正确',
        'jp' => 'ユーザ名が正しくない',
    ),
    'st_pwd_error' => array(
        'en' => 'The password is incorrect',
        'zh' => '密码不正确',
        'jp' => 'パスワードは正しくありません',
    ),
    'st_nameorpwd_error' => array(
        'en' => 'Incorrect username or password',
        'zh' => '用户名或密码错误',
        'jp' => 'ユーザ名またはパスワードエラー',
    ),
    'st_username_conflict' => array(
        'en' => 'The username already exists',
        'zh' => '用户名已存在',
        'jp' => 'ユーザー名が存在している',
    ),
    'st_email_error' => array(
        'en' => 'Mailbox format is incorrect',
        'zh' => '邮箱格式有误',
        'jp' => 'メールボックスに誤りがあります',
    ),
    'st_signin_ok' => array(
        'en' => 'Login success',
        'zh' => '登录成功',
        'jp' => 'ログイン成功',
    ),
    'st_signin_error' => array(
        'en' => 'Login failure',
        'zh' => '登录失败',
        'jp' => 'ログイン失敗',
    ),
    'st_signup_ok' => array(
        'en' => 'Successfully Registered',
        'zh' => '注册成功',
        'jp' => '登録が成功する',
    ),
    //validate 验证
    'va_username_check' => array(
        'en' => 'Please check the username',
        'zh' => '请检查用户名',
        'jp' => 'ユーザ名をチェックしてください',
    ),
    'va_email_check' => array(
        'en' => 'Please check the e-mail',
        'zh' => '请检查电子邮箱',
        'jp' => '電子メールをチェックして下さい',
    ), 'va_pwd_check' => array(
        'en' => 'Please check the password',
        'zh' => '请检查密码',
        'jp' => 'パスワードをチェックして下さい',
    ),
    'va_confirmpwd' => array(
        'en' => 'Confirmation password do not match',
        'zh' => '确认密码不一致',
        'jp' => '確認用のパスワードが一致しない',
    ),
    'va_vcode' => array(
        'en' => 'Please input verification code',
        'zh' => '请输入验证码',
        'jp' => '入力検証コードを入力してください',
    ),


];