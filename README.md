# PHP 学习记录

本仓库记录我从前端转向 PHP 后端的学习过程：知识笔记、可运行的练习代码，以及阶段 6 起正式开发的实战项目 **MiniShop 商城后端**。

学习计划原文见 [`doc/PHP学习计划.md`](doc/PHP学习计划.md)。

**最终目标：** 能够独立使用 PHP + Laravel 开发一个包含用户、商品、购物车、订单、缓存和异步任务的商城后端，并部署到自己的服务器上。

## 学习路线总览

| 阶段 | 主题 | 状态 |
| --- | --- | --- |
| 1 | PHP 语言基础 | 已完成 |
| 2 | PHP 工程化基础（Composer / 自动加载 / 规范） | 已完成 |
| 3 | PHP Web 开发基础（HTTP、超全局变量、原生 API） | 已完成 |
| 4 | 数据库开发（PDO + PostgreSQL） | 已完成 |
| 5 | 后端架构与设计（MVC、分层、DI，练习骨架） | 进行中 |
| 6 | Laravel 框架实战（**MiniShop 正式开发**） | 未开始 |
| 7 | 部署、运维与综合实战 | 未开始 |

## 当前进度

阶段 1 ~ 3 已完成，当前处于 **阶段 4：数据库开发**——已通过 SSH 隧道连上阿里云 PostgreSQL，进入建表与 CRUD 阶段。

### 阶段 1：语言基础（已完成）

- PHP 环境搭建与 CLI 运行
- 标签、输出、变量、数据类型、运算符与严格类型
- 数组、字符串及常用函数
- 条件判断、循环、函数与类型声明
- 异常处理
- 面向对象：类与对象、封装 / 继承 / 多态、`Interface`、`Abstract Class`、`Trait`
- Namespace 与 PSR-4 目录约定的配合（已在阶段 2 落地验证）

### 阶段 2：工程化基础（已完成）

- 安装 PHP 8.6.0，配置 `php.ini`，启用 `curl`、`mbstring`、`openssl`、`zip` 扩展
- 安装 Composer 2.11.2，完成公钥配置，`composer diagnose` 通过
- 配置 `PHPRC`、`PHP_INI_SCAN_DIR` 环境变量，命令行能正确加载 `php.ini`
- 初始化 `php-composer-demo`，编写 `composer.json` 并配置 PSR-4（`App\` → `src/`）
- 用 `composer require` 安装生产依赖 Guzzle
- 用 `composer require --dev` 安装开发依赖 PHPUnit
- 生成 `composer.lock` 锁定依赖版本，理解 `install`（按 lock 装）与 `update`（解析新版本）的差异
- 理解 `composer.json`、`composer.lock`、`vendor/` 三者的分工
- PSR-4 自动加载验证通过，`vendor/autoload.php` 可正常加载 `App\User`、`App\Product`
- 用 Guzzle 完成 GET、POST（JSON 请求体）、自定义 Header、超时控制和异常处理练习

当前依赖：

| 类型 | 包 | 版本 |
| --- | --- | --- |
| 生产依赖 | `guzzlehttp/guzzle` | 8.6.0 |
| 开发依赖 | `phpunit/phpunit` | 13.4 |

Guzzle 会带入 `guzzlehttp/promises`、`guzzlehttp/psr7`、`psr/http-*` 等传递依赖；PHPUnit 已安装但暂无测试用例，留到阶段 6 写自动化测试时使用。

阶段回顾：`composer.json` 只声明“要什么、版本范围”，`composer.lock` 记录“实际装了什么版本”，`vendor/` 才是代码落盘的位置。这套分工与前端 npm 的 `package.json` / lock 文件 / `node_modules` 一一对应，最大差异是 PHP 的类加载依赖 PSR-4 命名空间与目录映射，而不是打包器。

### 阶段 3：Web 开发基础（已完成）

练习集中在 `PHP Web 开发基础/php-server/public/`，用 PHP 内置服务器运行，一个文件对应一个知识点：

| 文件 | 练习内容 |
| --- | --- |
| `index.php` | 内置服务器入口、`date()`、`__FILE__` |
| `request.php` | `$_GET` / `$_POST`、`$_SERVER`（方法、URI、User-Agent、Accept-Language）、`php://input` + `json_decode` 接收 JSON |
| `test.php` | 输出 JSON：`Content-Type` + `json_encode` |
| `response.php` | 统一响应封装：`successResponse()` / `errorResponse()`，含 `http_response_code()` |
| `response-test.php` | 基于统一封装实现 200 与 404 分支 |
| `restful.php` | RESTful 约定笔记：URL 表示资源、方法表示操作、常用状态码 |
| `cookie.php` | `setcookie()` 的 `expires` / `path` / `httponly` / `samesite`，以及跨请求读取 |
| `session.php` / `session-read.php` / `session-destroy.php` | `session_start()`、`$_SESSION`、`session_id()`、`session_destroy()` |
| `upload.php` | `$_FILES`、`UPLOAD_ERR_OK` 校验、`move_uploaded_file()` |
| `download.php` | 文件下载：`Content-Type: application/octet-stream` + `Content-Disposition: attachment` + `readfile()` |
| `validate.php` | 输入校验：`trim()`、`filter_var()`（邮箱 / 整数）、错误收集与 400 响应 |
| `escape.php` | XSS 转义 `htmlspecialchars($str, ENT_QUOTES, 'UTF-8')`；密码哈希 `password_hash()` / `password_verify()` |

已用内置服务器 + curl 实测：

- `request.php?name=Tom&age=20` 正确回显 GET 参数与 User-Agent；POST JSON 时 `jsonData` 解析成功
- `response-test.php?id=1` → **200**，`?id=99` → **404**，且响应体是统一错误结构
- `validate.php` 空表单 → **400** 并返回字段级错误；合法表单 → **200**
- Cookie 首次请求读到 `null`（同一响应里设置、当次请求读不到），带 Cookie 的第二次请求读到 `Tom`
- Session 三件套跑通「写入 → 跨请求读取 → 销毁」，销毁后读不到数据且 `session_id` 已变更
- `upload.php` 上传 png 返回 `error: 0`，文件成功落到 `uploads/`
- `download.php` 返回 **200**，带 `Content-Type: application/octet-stream` 与 `Content-Disposition: attachment; filename="爱心.png"`，下载字节数与源图一致（5339 bytes）
- `escape.php` 中 `password_verify('123456', $hash)` 返回真，`echo` 输出 `1`

阶段回顾：`$_SERVER`、`$_GET`、`$_POST`、`$_FILES`、`$_COOKIE`、`$_SESSION` 就是 PHP 把 HTTP 请求拆好后摆上桌的几个入口，写原生 API 本质上就是「读超全局变量 → 校验 → 组装 JSON → 设状态码」。另外 `json_encode` 默认把中文转成 `\uXXXX`，`response.php` 加了 `JSON_UNESCAPED_UNICODE` 才直接输出中文，而 `validate.php` 没加，所以返回的是转义形式——两者都合法，只是可读性不同。

本阶段刻意留到后续补的点：CSRF Token（阶段 6 做认证时）、PUT/PATCH/DELETE 请求体解析（阶段 5~6）。SQL 注入与预处理已在阶段 4 用 PDO 补齐。

> 注意：`download.php` 读的是 `uploads/爱心.png`，而 `uploads/` 下的文件不入库。新克隆仓库后需先通过 `upload.php` 传一张同名图片，或改掉 `download.php` 里的文件名。

### 阶段 4：数据库开发（已完成）

已完成：

- 确认 PHP 已启用 `pdo_pgsql` / `pgsql` 扩展
- 用 **SSH 隧道**把阿里云上的 PostgreSQL 映射到本地 `127.0.0.1:5433`，数据库端口不对公网开放
- 用 PDO 建立连接：先用 `infra_admin` / `postgres` 库做连通性验证，随后改用业务库 `php_learning` + 业务用户 `php_learning_user`，并设置两项关键属性：
  - `PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION`（出错抛异常，而不是静默返回 `false`）
  - `PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC`（默认取关联数组）
- 密码不写进代码：脚本从 `DB_PASSWORD` 环境变量读取，缺失时直接退出并提示
- 连接成功后查询 `current_database()`、`current_user`、`version()` 验证连的是哪个库、以谁的身份、服务端版本
- 连接失败时用 `PDOException` 捕获并输出原因
- 抽出 `database.php` 统一提供 `$pdo`，各练习 `require_once` 复用，不再重复写连接
- 结果获取：`fetch()` 单行、`fetchAll()` 多行、`fetchColumn()` 取单值（`COUNT(*)`）、`while` 逐行遍历
- 建练习表：`products`、`orders`、`order_items`、`transaction_demo`（练习用，非商城正式建模）
- 商品 CRUD：`products/create.php`、`update.php`、`delete.php`、`query.php`、`list.php`
- 用 `RETURNING` 让 `INSERT` / `UPDATE` / `DELETE` 直接返回受影响的行，省掉一次回查
- 排序防注入：列名与方向都用白名单 `in_array($v, $allowed, true)` 校验，不在白名单直接退出
- 动态条件查询：关键词 `LIKE` + 价格区间按需拼 WHERE，条件与参数分开收集，全部走参数绑定
- 分页：`COUNT(*)` 算总数与总页数，`LIMIT / OFFSET` 分页，`bindValue(..., PDO::PARAM_INT)` 明确整数
- 事务：`beginTransaction()` / `commit()` / `rollBack()`，配合 `inTransaction()` 判断，`transaction-test.php` 演示异常回滚
- 下单事务：`order.php` 在同一事务内扣库存（`WHERE stock >= :n` + `RETURNING`）、写 `orders`、写 `order_items`，任一步失败整体回滚
- **HTTP 商品 API**：`public/products.php` 把上面这套 PDO 查询包成原生接口
  - `GET /products.php?keyword=键盘&page=1&pageSize=10` → 搜索 + 分页，返回 `data` 与 `pagination`（`total` / `page` / `pageSize` / `totalPages`）
  - `POST /products.php`（JSON body：`name` / `price` / `stock`）→ 参数校验后插入，成功返回 **201** 与创建后的记录
  - 参数不合法统一返回 **400** + `{success:false, message}`，全部 `JSON_UNESCAPED_UNICODE` 输出中文

这是「数据库层」和「HTTP 层」第一次接上：阶段 3 学的是怎么读请求、怎么写响应，阶段 4 学的是怎么安全地存取数据，`products.php` 就是把两段拼起来——接口本身很简单，但它是阶段 5 分层的起点（现在 SQL、校验、响应全挤在一个文件里）。

本阶段未覆盖（留到阶段 6 做查询优化时补）：索引与 `EXPLAIN` 执行计划分析、显式外键约束的验证、`JOIN` 查询练习（当前只有 `orders` / `order_items` 的表结构与事务内写入，没有联合查询）；完整商城建模留到阶段 6 用 Laravel Migration 做。

> 安全约定：仓库里不出现任何数据库凭据。密码只通过环境变量传入；隧道连接信息（本地端口、库名、用户名）可以入库，密码不行。

### 阶段 5：后端架构与设计（进行中）

目标：把阶段 4 那个「SQL、校验、响应挤在一个文件里」的 `products.php` 拆开，理解每一层该管什么。

计划覆盖：

- Router：把 `/products`、`/products/{id}` 映射到具体处理函数，告别一个文件一个接口
- Controller：只负责取参数、调服务、定状态码
- Service：业务规则（库存校验、金额计算）集中在这里
- Repository：所有 SQL 收敛到一层，换数据库只改这里
- 依赖注入：把 `$pdo` / Repository 传进去，而不是在类里自己 `new` / `require`
- 统一异常处理 + 统一响应结构，配 `try/catch` 兜住未预期错误
- 配置与环境变量、简单日志

## 实战项目：MiniShop 商城后端

**MiniShop 在阶段 6（Laravel）才正式开发。** 阶段 1~5 只做聚焦单个知识点的小练习，不提前背商城业务——原生 PHP 手写全栈商城成本高、可维护性差，路由、ORM、迁移、认证、队列这些能力放在 Laravel 里学更贴近真实项目；阶段 5 先用一个练习骨架把分层职责弄清，再进框架。

各阶段的练习载体：

| 阶段 | 练习载体 | 目的 |
| --- | --- | --- |
| 1 | `php语言基础/` | 语法、数组、函数、OOP、异常 |
| 2 | `PHP 工程化基础/php-composer-demo/` | Composer、PSR-4、第三方依赖 |
| 3 | `PHP Web 开发基础/php-server/` | HTTP、超全局变量、Cookie/Session、上传下载、校验、安全基础 |
| 4 | `PHP数据库开发/` + 练习表（如 `products`） | PDO、CRUD、预处理、事务、动态查询与分页、把查询整合成 HTTP API |
| 5 | 待建的 `mini-framework` 练习项目 | Router、Controller、Service、Repository、DI、异常与日志 |

练习表只用来验证 SQL 与 PDO 能力，字段精简；正式表结构在阶段 6 用 Laravel Migration 重新设计。

### MiniShop 功能规划

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

### MiniShop 开发路线（阶段 6~7）

1. 初始化 Laravel 项目，配置 PostgreSQL 与 `.env`，跑通第一条 Migration。
2. 用户模块：注册、登录、认证与角色权限。
3. 商品与分类：Migration + Eloquent 模型 + CRUD + 关联关系。
4. 搜索：筛选、排序、分页，配合索引优化。
5. 购物车与订单：创建订单、订单明细、状态流转，用事务保证一致性。
6. 支付：模拟支付流程与支付状态管理。
7. 缓存与异步：Redis 缓存热点商品，队列处理订单任务。
8. 自动化测试：为订单、支付等核心流程补测试。
9. 阶段 7：Docker Compose 部署到阿里云，配 Nginx / Caddy + PHP-FPM，补日志、监控与备份。

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
├── PHP 工程化基础/                  # 阶段 2 练习
│   └── php-composer-demo/
│       ├── composer.json           # PSR-4: App\ → src/；Guzzle 生产依赖 + PHPUnit 开发依赖
│       ├── composer.lock           # 锁定实际安装版本
│       ├── index.php               # Guzzle 请求练习（GET/POST/Header/超时/异常，片段默认注释）
│       ├── src/
│       │   ├── Product.php
│       │   └── User.php
│       └── vendor/                 # Composer 生成，已被 .gitignore 忽略
├── PHP Web 开发基础/                # 阶段 3 练习
│   └── php-server/
│       └── public/                 # 内置服务器根目录（-t 指向这里）
│           ├── index.php           # 入口 / 内置服务器
│           ├── request.php         # 超全局变量 + JSON 请求体
│           ├── test.php            # 最简 JSON 输出
│           ├── response.php        # 统一响应封装（成功 / 错误 + 状态码）
│           ├── response-test.php   # 200 与 404 分支
│           ├── restful.php         # RESTful 与状态码约定笔记
│           ├── cookie.php          # Cookie 读写与安全属性
│           ├── session.php         # 写入 Session
│           ├── session-read.php    # 跨请求读取 Session
│           ├── session-destroy.php # 销毁 Session
│           ├── upload.php          # 文件上传
│           ├── download.php        # 文件下载（attachment + readfile）
│           ├── validate.php        # 表单校验与 400 响应
│           ├── escape.php          # XSS 转义 + 密码哈希
│           └── uploads/            # 上传落盘目录（文件不提交，仅保留目录）
└── PHP数据库开发/                   # 阶段 4 练习
    ├── database.php                # 共享 PDO 连接（密码读环境变量）
    ├── connection-test.php         # 连接阿里云 PostgreSQL 并查库名 / 用户 / 版本
    ├── transaction-test.php        # 事务异常回滚演示
    ├── order.php                   # 下单事务：扣库存 + 写订单 + 写明细
    ├── products/                   # 商品 CRUD 与查询练习
    │   ├── create.php
    │   ├── update.php
    │   ├── delete.php
    │   ├── query.php
    │   ├── list.php                # 排序白名单
    │   └── search.php              # 动态条件 + 分页 + 总数
    └── public/
        └── products.php            # HTTP 商品 API（GET 搜索分页 / POST 创建）
```

## 环境与运行

当前环境：**PHP 8.6.0（CLI）**、**Composer 2.11.2**，扩展 `curl`、`mbstring`、`openssl`、`zip` 已启用，数据库扩展 `pdo_pgsql`、`pgsql` 已启用。

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
composer install          # 按 composer.lock 还原依赖
php .\index.php
```

`index.php` 中是 Guzzle 的分段练习（基础引入、GET、POST、自定义 Header、超时、错误处理），各片段默认注释，想验证哪一段就取消注释再运行，例如 POST 示例：

```php
$client = new \GuzzleHttp\Client();
$response = $client->post('https://httpbin.org/post', [
    'json' => ['name' => '张三', 'age' => 15],
]);
echo $response->getStatusCode(), PHP_EOL;
echo $response->getBody(), PHP_EOL;
```

运行阶段 3 的练习（内置服务器，根目录指向 `public`）：

```powershell
cd ".\PHP Web 开发基础\php-server"
php -S localhost:8000 -t public
```

然后浏览器访问，或用 curl 验证：

```powershell
curl.exe "http://localhost:8000/request.php?name=Tom&age=20"
curl.exe "http://localhost:8000/response-test.php?id=99"    # 期望 404
curl.exe -X POST http://localhost:8000/validate.php -d "name=张三&email=a@b.com&age=28"
```

Cookie 与 Session 需要「带 Cookie 连续请求」才能看出效果，用 curl 的 cookie jar：

```powershell
curl.exe -c cookie.txt -b cookie.txt http://localhost:8000/cookie.php   # 第二次才会读到 Tom
curl.exe -c s.txt -b s.txt http://localhost:8000/session.php
curl.exe -c s.txt -b s.txt http://localhost:8000/session-read.php
```

`session.php`、`session-read.php`、`session-destroy.php` 必须按顺序访问才能体现跨请求共享。

运行阶段 4 的数据库连接测试（前提：SSH 隧道已建立，本地 `5433` 映射到阿里云 PostgreSQL）：

```powershell
$env:DB_PASSWORD = "你的数据库密码"   # 只在当前终端会话有效
cd ".\PHP数据库开发"
php .\connection-test.php
```

成功会输出 `PostgreSQL 连接成功！` 以及 `current_database`、`current_user`、`version()` 三个字段；若忘记设置 `DB_PASSWORD`，脚本会直接提示并退出，不会拿空密码去连。

运行商品 CRUD 练习（每个文件独立跑，`print_r` 打印结果）：

```powershell
cd ".\PHP数据库开发"
php .\products\create.php     # INSERT ... RETURNING id
php .\products\query.php      # 单条查询，id 不存在时提示"商品不存在"
php .\products\list.php       # 排序白名单
php .\products\search.php     # 动态条件 + 分页 + 总数
```

运行阶段 4 的商品 API（内置服务器以 `public/` 为根目录）：

```powershell
$env:DB_PASSWORD = "你的数据库密码"
cd ".\PHP数据库开发\public"
php -S 127.0.0.1:8000 -t .
```

```powershell
# 列表 + 搜索 + 分页
curl.exe "http://127.0.0.1:8000/products.php?keyword=键盘&page=1&pageSize=10"
# 创建商品（JSON body）
curl.exe -X POST http://127.0.0.1:8000/products.php `
  -H "Content-Type: application/json" `
  -d "{\"name\":\"鼠标\",\"price\":99.5,\"stock\":20}"
# 分页参数非法，期望 400
curl.exe "http://127.0.0.1:8000/products.php?page=0"
```

> 注意：`database.php` 在缺少 `DB_PASSWORD` 时是直接 `exit` 输出一段纯文本，状态码仍是 200；连接失败时异常未被捕获，会返回 500 且没有 JSON 响应体。这两处正是阶段 5 要解决的问题（统一异常处理 + 统一响应结构）。

语法检查与测试：

```powershell
php -l .\php语言基础\object.php
php -l ".\PHP 工程化基础\php-composer-demo\index.php"
php -l ".\PHP数据库开发\connection-test.php"
.\PHP 工程化基础\php-composer-demo\vendor\bin\phpunit --version
```

`vendor/` 由 Composer 生成，已加入 `.gitignore`，不提交到仓库。

> 说明：PHP 通过 Scoop 安装，需确保 `D:\Scoop\shims` 在 `PATH` 中（新开终端后生效）；若 `php` 命令不可用，可直接使用 `D:\Scoop\shims\php.exe`。
>
> `php.ini` 位于 `D:\Scoop\apps\php\current\cli\`，由 `PHPRC` 指向该目录后才会被加载。若 `php -m` 里看不到 `curl`、`mbstring`、`openssl`、`zip`，先检查 `php --ini` 是否显示 `Loaded Configuration File: (none)` —— 这意味着当前终端没继承环境变量，重开终端即可。

## 学习方式与约定

- **循序渐进：** 每次聚焦一个知识点，理解并实践后再推进。
- **实践优先：** 用可运行的代码和小任务掌握知识，而不是只看概念。
- **解释命令：** 终端命令都说明用途、参数与执行结果。
- **联系前端经验：** 适当对比 JavaScript / TypeScript、Node.js 与 npm，重点讲清 PHP 的差异。
- **先理解再上框架：** 进入 Laravel 前先掌握 HTTP、数据库和基础后端架构。
- **持续迭代练习：** 阶段 1~5 把知识落到各自的练习项目上，阶段 6 起集中投入 MiniShop。
- **及时复盘：** 根据实际代码与运行结果确认掌握程度，再决定是否推进。

## 下一步

阶段 4 已完成（PDO 连接、结果获取、预处理、CRUD、注入防护、事务、多表写入、动态查询、分页、HTTP 商品 API），进入 **阶段 5：后端架构与设计**：

1. 初始化 `mini-framework` 练习项目，用 Composer + PSR-4 自动加载自己的命名空间。
2. 写一个最小 Router：把 `/products`、`/products/{id}` 映射到处理函数，支持 GET / POST。
3. 拆 Controller：只负责解析请求参数、调用服务、返回响应。
4. 拆 Service：库存校验、金额计算等业务规则集中到这里，与 HTTP 无关。
5. 拆 Repository：把 `products.php` 里的 SQL 全部搬进去，Controller 不再直接碰 `$pdo`。
6. 加依赖注入：容器或构造函数注入的方式把 Repository 交给 Service，而不是在类内部 `require`。
7. 统一异常处理 + 统一响应结构，把这些年踩过的「500 空响应」「exit 还返回 200」都收口。
8. 补配置管理（`.env` 式读取）与简单日志，为阶段 6 的 Laravel 打底。

阶段 4 留给阶段 6 补的：索引与 `EXPLAIN`、外键约束验证、`JOIN` 查询练习。

## 更新记录

- 2026-11-24：**阶段 4 完成**。新增 `PHP数据库开发/public/products.php`，把 PDO 查询整合成原生 HTTP 商品 API（GET 搜索 + 分页、POST 创建返回 201、参数非法 400）；README 与学习计划同步标记阶段 4 完成、阶段 5 进入进行中，补上 API 运行方式与 curl 示例，并记录两处待改进（无密码时 `exit` 仍返回 200、连接异常未捕获导致 500 空响应）。
- 2026-11-24：调整学习计划——MiniShop 移到阶段 6（Laravel）才正式开发，阶段 1~5 改为纯练习载体（阶段 4 用练习表代替商城建模、阶段 5 用 `mini-framework` 骨架）；同时按实际进度补全阶段 4（共享 `database.php`、`products` / `orders` / `order_items` 练习表、CRUD、排序白名单、动态查询与分页、事务与跨表下单）。
- 2026-11-23：进入阶段 4。新增 `PHP数据库开发/connection-test.php`，通过 SSH 隧道把阿里云 PostgreSQL 映射到本地 `5433`，用 PDO 连接并查询库名、当前用户与服务端版本；密码从 `DB_PASSWORD` 环境变量读取，仓库不落任何凭据。
- 2026-11-23：阶段 3 完成。新增 `PHP Web 开发基础/php-server/public/`，覆盖内置服务器、请求 / 响应、统一 JSON 封装、RESTful 约定、Cookie、Session、文件上传与下载、表单校验、XSS 转义与密码哈希；内置服务器 + curl 全部实测通过，README 补充运行方式与阶段 3 说明。
- 2026-11-23：阶段 2 完成。安装 Guzzle 8.6.0 与 PHPUnit 13.4，`composer.lock` 生成并锁定版本，完成 PSR-4 自动加载与 Guzzle 请求练习；同步更新 README 与学习计划中的阶段状态。
- 2026-11-23：按 `doc/PHP学习计划.md` 重写 README，补充七阶段路线总览、MiniShop 实战项目规划、技术栈与阶段 2 详细进度，更新环境信息为 PHP 8.6.0 / Composer 2.11.2。
- 2026-11-20：开始学习 PHP 工程化基础，新增 Composer 和 PSR-4 自动加载示例，并忽略本地 `vendor/` 目录。
- 2026-11-19：添加 README，补充项目说明、学习进度和运行方式。
- 2026-11-19：完成 PHP 第一阶段学习，将练习代码整理到 `php语言基础` 目录，并新增对象相关练习。
- 2026-11-19：初始化仓库并推送首批 PHP 学习代码。

## 维护约定

后续每次向 GitHub 推送代码时，都要同步更新本 README，并在「当前进度」或「更新记录」中反映本次变更。
