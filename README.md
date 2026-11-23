# PHP 学习记录

本仓库记录我从前端转向 PHP 后端的学习过程：知识笔记、可运行的练习代码，以及贯穿整个学习周期的实战项目 **MiniShop 商城后端**。

学习计划原文见 [`doc/PHP学习计划.md`](doc/PHP学习计划.md)。

**最终目标：** 能够独立使用 PHP + Laravel 开发一个包含用户、商品、购物车、订单、缓存和异步任务的商城后端，并部署到自己的服务器上。

## 学习路线总览

| 阶段 | 主题 | 状态 |
| --- | --- | --- |
| 1 | PHP 语言基础 | 基本完成 |
| 2 | PHP 工程化基础（Composer / 自动加载 / 规范） | 进行中 |
| 3 | PHP Web 开发基础（HTTP、超全局变量、原生 API） | 未开始 |
| 4 | 数据库开发（PDO + PostgreSQL） | 未开始 |
| 5 | 后端架构与设计（MVC、分层、DI） | 未开始 |
| 6 | Laravel 框架实战 | 未开始 |
| 7 | 部署、运维与综合实战 | 未开始 |

## 当前进度

当前处于 **阶段 2：PHP 工程化基础**。

### 阶段 1：语言基础（基本完成）

- PHP 环境搭建与 CLI 运行
- 标签、输出、变量、数据类型、运算符与严格类型
- 数组、字符串及常用函数
- 条件判断、循环、函数与类型声明
- 异常处理
- 面向对象：类与对象、封装 / 继承 / 多态、`Interface`、`Abstract Class`、`Trait`
- Namespace 已初步了解，结合 Composer / PSR-4 再深入

### 阶段 2：工程化基础（进行中）

已完成：

- 安装 PHP 8.6.0，配置 `php.ini`
- 启用 `curl`、`mbstring`、`openssl`、`zip` 扩展
- 安装 Composer 2.11.2，完成公钥配置，`composer diagnose` 通过
- 配置 `PHPRC`、`PHP_INI_SCAN_DIR` 环境变量
- 初始化 `php-composer-demo`，编写 `composer.json`
- 配置 PSR-4 自动加载（`App\` → `src/`），并通过 `vendor/autoload.php` 成功加载 `App\User`、`App\Product`

待完成：

- 使用 `composer require` 安装第三方库（计划使用 Guzzle）
- 深入理解 `composer.json` 与 `composer.lock`（版本约束、锁定机制）
- 区分 `require` / `require-dev`，以及 `install` 与 `update` 的行为差异
- 整理工程化阶段的目录结构，补全编码规范

## 实战项目：MiniShop 商城后端

不重复做零散 Demo，而是用同一个商城项目随学习阶段逐步迭代。

| 模块 | 计划实现的功能 |
| --- | --- |
| 用户模块 | 注册、登录、用户信息管理 |
| 权限模块 | 身份认证、角色与权限控制 |
| 商品模块 | 商品增删改查、库存管理 |
| 分类模块 | 商品分类、分类关联 |
| 搜索模块 | 商品搜索、筛选、分页 |
| 购物车 | 添加商品、删除商品、修改数量 |
| 订单模块 | 创建订单、订单明细、订单状态管理 |
| 支付模块 | 模拟支付、支付状态管理 |
| 缓存模块 | 使用 Redis 缓存商品等热点数据 |
| 异步模块 | 使用队列处理订单相关任务 |

### 技术栈

- **语言与框架：** PHP、Laravel
- **数据库：** PostgreSQL
- **缓存与队列：** Redis
- **部署：** Docker、Docker Compose
- **服务器：** Linux（阿里云 ECS）
- **Web 服务：** Nginx 或 Caddy

### 项目演进方式

1. 阶段 1：编写 PHP 基础代码，熟悉语言特性。
2. 阶段 2：初始化项目，使用 Composer 管理依赖与自动加载。
3. 阶段 3：用原生 PHP 实现基础 HTTP API。
4. 阶段 4：连接 PostgreSQL，实现商品、用户等数据操作。
5. 阶段 5：重构为 Router / Controller / Service / Repository 分层结构。
6. 阶段 6：使用 Laravel 实现完整商城业务。
7. 阶段 7：通过 Docker Compose 部署到阿里云，补齐缓存、异步任务、日志与运维能力。

## 目录结构

```text
php-learning/
├── .gitignore
├── README.md
├── doc/
│   └── PHP学习计划.md              # 完整学习路线与阶段目标
├── php语言基础/                     # 阶段 1 练习
│   ├── hello.php
│   ├── string.php
│   ├── array.php
│   └── object.php
└── PHP 工程化基础/                  # 阶段 2 练习
    └── php-composer-demo/
        ├── composer.json           # PSR-4: App\ → src/
        ├── composer.lock
        ├── index.php               # 通过 vendor/autoload.php 加载类
        └── src/
            ├── Product.php
            └── User.php
```

## 环境与运行

当前环境：**PHP 8.6.0（CLI）**、**Composer 2.11.2**，扩展 `curl`、`mbstring`、`openssl`、`zip` 已启用。

运行阶段 1 的练习（在项目根目录）：

```powershell
php .\php语言基础\hello.php
php .\php语言基础\string.php
php .\php语言基础\array.php
php .\php语言基础\object.php
```

运行 Composer 示例：

```powershell
cd ".\PHP 工程化基础\php-composer-demo"
composer install
php .\index.php
```

语法检查：

```powershell
php -l .\php语言基础\object.php
```

`vendor/` 由 Composer 生成，已加入 `.gitignore`，不提交到仓库。

> 说明：PHP 通过 Scoop 安装，需确保 `D:\Scoop\shims` 在 `PATH` 中（新开终端后生效）；若 `php` 命令不可用，可直接使用 `D:\Scoop\shims\php.exe`。

## 学习方式与约定

- **循序渐进：** 每次聚焦一个知识点，理解并实践后再推进。
- **实践优先：** 用可运行的代码和小任务掌握知识，而不是只看概念。
- **解释命令：** 终端命令都说明用途、参数与执行结果。
- **联系前端经验：** 适当对比 JavaScript / TypeScript、Node.js 与 npm，重点讲清 PHP 的差异。
- **先理解再上框架：** 进入 Laravel 前先掌握 HTTP、数据库和基础后端架构。
- **持续迭代项目：** 每个阶段的知识都逐步落到 MiniShop 上。
- **及时复盘：** 根据实际代码与运行结果确认掌握程度，再决定是否推进。

## 下一步

1. 新开终端，验证 PHP 永久环境变量（`PHPRC`、`PHP_INI_SCAN_DIR`、`PATH`）是否生效。
2. 在 `php-composer-demo` 中执行 `composer require guzzlehttp/guzzle`。
3. 观察 `composer.json`、`composer.lock` 与 `vendor/` 的变化。
4. 用 Guzzle 发起 HTTP 请求，理解第三方包的使用方式。
5. 学习版本约束、`require-dev`、`install` 与 `update` 的区别。
6. 整理工程化项目结构，进入阶段 3：PHP Web 开发基础。

## 更新记录

- 2026-11-23：按 `doc/PHP学习计划.md` 重写 README，补充七阶段路线总览、MiniShop 实战项目规划、技术栈与阶段 2 详细进度，更新环境信息为 PHP 8.6.0 / Composer 2.11.2。
- 2026-11-20：开始学习 PHP 工程化基础，新增 Composer 和 PSR-4 自动加载示例，并忽略本地 `vendor/` 目录。
- 2026-11-19：添加 README，补充项目说明、学习进度和运行方式。
- 2026-11-19：完成 PHP 第一阶段学习，将练习代码整理到 `php语言基础` 目录，并新增对象相关练习。
- 2026-11-19：初始化仓库并推送首批 PHP 学习代码。

## 维护约定

后续每次向 GitHub 推送代码时，都要同步更新本 README，并在「当前进度」或「更新记录」中反映本次变更。
