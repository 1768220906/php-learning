# PHP 学习记录

这个仓库用于记录 PHP 学习过程中的知识点、练习代码和学习进度。当前已经完成 PHP 第一阶段的学习，并开始学习 PHP 工程化基础。

## 当前学习进度

- [x] PHP 第一阶段：基础语法与常用数据结构
- [ ] PHP 第二阶段：工程化基础

## 已学习内容

- PHP 基础数据类型与数据转换
- `if`、`for`、`foreach` 等流程控制
- 函数、数组和数组常用操作
- 字符串常用操作
- 类、对象、接口、抽象类和 `Trait`
- 异常处理基础
- Composer 初始化与依赖管理
- PSR-4 自动加载
- 命名空间与项目目录组织

## 目录结构

```text
php-learning/
├── .gitignore
├── README.md
├── php语言基础/
│   ├── hello.php
│   ├── string.php
│   ├── array.php
│   └── object.php
└── PHP 工程化基础/
    └── php-composer-demo/
        ├── composer.json
        ├── composer.lock
        ├── index.php
        └── src/
            ├── Product.php
            └── User.php
```

## 运行练习

需要先安装 PHP，然后在项目根目录运行：

```powershell
php .\php语言基础\hello.php
php .\php语言基础\string.php
php .\php语言基础\array.php
php .\php语言基础\object.php
```

运行 Composer 示例前，先安装依赖：

```powershell
cd ".\PHP 工程化基础\php-composer-demo"
composer install
php .\index.php
```

`vendor/` 目录由 Composer 生成，已加入 `.gitignore`，不需要提交到仓库。

当前代码已在 PHP 8.5.9 下通过语法检查。

## 更新记录

- 2026-11-20：开始学习 PHP 工程化基础，新增 Composer 和 PSR-4 自动加载示例，并忽略本地 `vendor/` 目录。
- 2026-11-19：添加 README，补充项目说明、学习进度和运行方式。
- 2026-11-19：完成 PHP 第一阶段学习，将练习代码整理到 `php语言基础` 目录，并新增对象相关练习。
- 2026-11-19：初始化仓库并推送首批 PHP 学习代码。

## 维护约定

后续每次向 GitHub 推送代码时，都要同步更新本 README，并在“当前学习进度”或“更新记录”中反映本次变更。
