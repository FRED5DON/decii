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
        'ja' => '発見',
    ),
    'nav-msg' => array(
        'en' => 'Message',
        'zh' => '消息',
        'ja' => 'ニュース',
    ),
    'nav-lab' => array(
        'en' => 'Lab',
        'zh' => '实验室',
        'ja' => '実験室',
    ), 'nav-write' => array(
        'en' => 'Poster',
        'zh' => '发布',
        'ja' => '発表',
    ),
    'nav-setting' => array(
        'en' => 'Settings',
        'zh' => '设置',
        'ja' => '設置',
    ),
    'nav-signup' => array(
        'en' => 'Sign Up',
        'zh' => '注册',
        'ja' => '登録',
    ),
    'nav-signin' => array(
        'en' => 'Sign In',
        'zh' => '登录',
        'ja' => 'サインイン',
    ),
    'nav-signout' => array(
        'en' => 'Sign Out',
        'zh' => '登出',
        'ja' => 'ログオフ',
    ),
    'nav-usrinfo' => array(
        'en' => 'Profile',
        'zh' => '个人资料',
        'ja' => '私の資料',
    ),
    'reply' => array(
        'en' => 'Reply',
        'zh' => '回复',
        'ja' => '回復',
    ),
    'lang' => array(
        'en' => 'English',
        'zh' => '中文',
        'ja' => '日本語',
    ),
    'back2top' => array(
        'en' => 'Back 2 Top',
        'zh' => '返回顶部',
        'ja' => '顶上に戻る',
    ),
    'cancel' => array(
        'en' => 'Cancel',
        'zh' => '取消',
        'ja' => '取り消し',
    ),
    'no' => array(
        'en' => 'No',
        'zh' => '不了',
        'ja' => 'いいえ',
    ), 'yes' => array(
        'en' => 'Yes',
        'zh' => '是的',
        'ja' => 'はい',
    ),
    'remember' => array(
        'en' => 'Remember Me',
        'zh' => '记住登录',
        'ja' => 'ログイン状態を覚え',
    ), 'email' => array(
        'en' => 'Email',
        'zh' => '邮箱',
        'ja' => 'メール',
    ),
    'username' => array(
        'en' => 'UserName',
        'zh' => '用户名',
        'ja' => 'ユーザー名',
    ),
    'password' => array(
        'en' => 'Password',
        'zh' => '密码',
        'ja' => 'パスワード',
    ), 'confirmPassword' => array(
        'en' => 'Confirm Password',
        'zh' => '确认密码',
        'ja' => 'パスワードを確認する',
    ),
    'agree' => array(
        'en' => 'Agree',
        'zh' => '同意',
        'ja' => '认め',
    ),
    'agreement' => array(
        'en' => 'User agreement',
        'zh' => '用户协议',
        'ja' => 'ユーザーの合意',
    ),
    'input' => array(
        'en' => 'Input',
        'zh' => '输入',
        'ja' => '入力',
    ),
    'vcode' => array(
        'en' => 'Verification code',
        'zh' => '验证码',
        'ja' => '検証コード',
    ), 'verify-error-user' => array(
        'en' => 'Username or password error',
        'zh' => '用户名或密码不正确',
        'ja' => 'ユーザー名やパスワードは正しい',
    ),
    'direct-login-info' => array(
        'en' => 'Existing account? Click here to ',
        'zh' => '已有账号？立即',
        'ja' => 'アカウントはありますか？すぐに',
    ),'direct-signup-info' => array(
        'en' => 'No account? Click here to ',
        'zh' => '还没有账号？立即',
        'ja' => 'まだアカウントがありません？すぐに',
    ),
    //note Publish
    'title' => array(
        'en' => 'Title',
        'zh' => '标题',
        'ja' => '標題',
    ),
    'remark' => array(
        'en' => 'Remark',
        'zh' => '摘要',
        'ja' => '要旨',
    ),
    'content' => array(
        'en' => 'Content',
        'zh' => '正文',
        'ja' => '本文',
    ),
    'keyword' => array(
        'en' => 'Keyword',
        'zh' => '关键字',
        'ja' => 'キーワード',
    ),
    'submit' => array(
        'en' => 'Submit',
        'zh' => '提交',
        'ja' => '提出する',
    ),
    'publish' => array(
        'en' => 'Publish',
        'zh' => '发布',
        'ja' => 'リリース',
    ),
    'save' => array(
        'en' => 'Save',
        'zh' => '保存',
        'ja' => 'アーカイブ',
    ),
    'complete' => array(
        'en' => 'Complete',
        'zh' => '完成',
        'ja' => '完成する',
    ),
    'setting' => array(
        'en' => 'Settings',
        'zh' => '设置',
        'ja' => '設置',
    ),
    'type' => array(
        'en' => 'Type',
        'zh' => '类型',
        'ja' => 'タイプ',
    ),
    'categories' => array(
        'en' => 'Categories',
        'zh' => '分类',
        'ja' => 'カテゴリー',
    ),
    'time' => array(
        'en' => 'Time',
        'zh' => '时间',
        'ja' => '時間',
    ),
    'date' => array(
        'en' => 'Date',
        'zh' => '日期',
        'ja' => 'ナツメヤシ',
    ),
    'word' => array(
        'en' => 'Word',
        'zh' => '字',
        'ja' => 'ワード',
    ),
    //sentences 提示语句
    'st_verifycode_error' => array(
        'en' => 'The verification code error',
        'zh' => '验证码错误',
        'ja' => '検証コードエラー',
    ),
    'st_username_error' => array(
        'en' => 'The username is incorrect',
        'zh' => '用户名不正确',
        'ja' => 'ユーザ名が正しくない',
    ),
    'st_pwd_error' => array(
        'en' => 'The password is incorrect',
        'zh' => '密码不正确',
        'ja' => 'パスワードは正しくありません',
    ),
    'st_nameorpwd_error' => array(
        'en' => 'Incorrect username or password',
        'zh' => '用户名或密码错误',
        'ja' => 'ユーザ名またはパスワードエラー',
    ),
    'st_username_conflict' => array(
        'en' => 'The username already exists',
        'zh' => '用户名已存在',
        'ja' => 'ユーザー名が存在している',
    ),
    'st_email_error' => array(
        'en' => 'Mailbox format is incorrect',
        'zh' => '邮箱格式有误',
        'ja' => 'メールボックスに誤りがあります',
    ),
    'st_signin_ok' => array(
        'en' => 'Login success',
        'zh' => '登录成功',
        'ja' => 'ログイン成功',
    ),
    'st_signin_error' => array(
        'en' => 'Login failure',
        'zh' => '登录失败',
        'ja' => 'ログイン失敗',
    ),
    'st_signup_ok' => array(
        'en' => 'Successfully Registered',
        'zh' => '注册成功',
        'ja' => '登録が成功する',
    ),
    //validate 验证
    'va_username_check' => array(
        'en' => 'Please check the username',
        'zh' => '请检查用户名',
        'ja' => 'ユーザ名をチェックしてください',
    ),
    'va_email_check' => array(
        'en' => 'Please check the e-mail',
        'zh' => '请检查电子邮箱',
        'ja' => '電子メールをチェックして下さい',
    ), 'va_pwd_check' => array(
        'en' => 'Please check the password',
        'zh' => '请检查密码',
        'ja' => 'パスワードをチェックして下さい',
    ),
    'va_confirmpwd' => array(
        'en' => 'Confirmation password do not match',
        'zh' => '确认密码不一致',
        'ja' => '確認用のパスワードが一致しない',
    ),
    'va_vcode' => array(
        'en' => 'Please input verification code',
        'zh' => '请输入验证码',
        'ja' => '入力検証コードを入力してください',
    ),


];