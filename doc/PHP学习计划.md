# PHP 学习计划

## 一、学习目标

从具备前端开发经验的开发者出发，系统学习 PHP 后端开发，最终能够独立使用 **PHP + Laravel** 构建、测试、部署和维护完整的后端项目。

学习采用循序渐进、实践驱动的方式：先掌握 PHP 语言与工程化基础，再学习 Web 开发、数据库、后端架构，最后进入 Laravel 和生产环境部署。

## 二、完整学习路线

### 阶段 1：PHP 语言基础

**进度：已完成**

学习内容：

- PHP 环境搭建与 CLI 运行
- PHP 标签、输出、变量与数据类型
- 运算符、类型转换与严格类型
- 数组、字符串及常用函数
- 条件判断与循环
- 函数、参数、返回值与类型声明
- 异常处理
- 面向对象：类、对象、属性、方法
- 封装、继承与多态
- Interface、Abstract Class、Trait
- Namespace（已初步了解，暂时跳过，后续结合 Composer / PSR-4 再深入）

阶段目标：能够独立编写 PHP 基础业务代码，理解 PHP 与 JavaScript / TypeScript 在语法和运行机制上的差异。

### 阶段 2：PHP 工程化基础

**进度：已完成**

学习内容：

- Composer 包管理器
- `composer.json` 配置
- `composer.lock` 锁定依赖版本
- `composer require`、`composer install`、`composer update`
- `require` 与 `require-dev`
- 第三方依赖安装与版本约束
- `vendor/` 目录
- `vendor/autoload.php` 自动加载入口
- PHP 自动加载机制
- PSR-4 自动加载规范
- Namespace 与目录结构的配合
- PHP 编码规范与项目组织

阶段目标：理解 PHP 项目如何管理第三方依赖、组织代码、自动加载类，并能独立初始化一个规范的 PHP 项目。

已完成：

- 安装 PHP 8.6.0，配置 `php.ini`
- 启用 `curl`、`mbstring`、`openssl`、`zip`
- 安装 Composer 2.11.2
- Composer 公钥配置完成
- `composer diagnose` 检查通过
- 验证 `PHPRC` 和 `PHP_INI_SCAN_DIR` 永久环境变量
- 使用 `composer require guzzlehttp/guzzle` 安装第三方库（Guzzle 8.6.0）
- 使用 `composer require --dev phpunit/phpunit` 安装开发依赖（PHPUnit 13.4）
- 理解 `composer.json` 与 `composer.lock` 的关系，依赖版本已锁定
- 区分 `require` / `require-dev`，掌握 `install` 与 `update` 的行为差异
- 完成 PSR-4 自动加载实践（`App\` → `src/`）
- 使用 Guzzle 完成 GET / POST / 自定义 Header / 超时 / 错误处理等 HTTP 请求练习
- 整理 `php-composer-demo` 工程化结构，工程化阶段收尾

阶段回顾：本阶段最大的收获是理解了“依赖声明在 `composer.json`、实际版本锁在 `composer.lock`、代码在 `vendor/`”，以及 PSR-4 让命名空间与目录结构一一对应，这与前端 npm 的 `package.json` / lock 文件 / `node_modules` 思路一致，但自动加载是语言层配合 Composer 完成的。

### 阶段 3：PHP Web 开发基础

**进度：已完成**

学习内容：

- HTTP 请求与响应
- GET、POST、PUT、DELETE 请求方法
- `$_GET`、`$_POST`、`$_SERVER` 等超全局变量
- JSON 数据接收、解析与输出
- HTTP Header 与 Status Code
- Cookie 与 Session
- RESTful API 设计
- 文件上传与下载
- 表单处理与输入验证
- 基础 Web 安全：XSS、CSRF、SQL 注入、密码哈希

阶段目标：不依赖 Web 框架，使用原生 PHP 编写一个简单的 API 服务，理解 PHP 如何处理 HTTP 请求并返回响应。

已完成（练习代码见 `PHP Web 开发基础/php-server/public/`）：

- 用 `php -S localhost:8000 -t public` 启动内置服务器，理解 `-S` 与 `-t` 参数
- 通过 `$_GET`、`$_POST`、`$_SERVER` 读取查询参数、表单数据与方法 / URI / User-Agent
- 用 `php://input` + `json_decode` 接收 JSON 请求体
- 用 `header()` 设置 `Content-Type`，用 `json_encode` 输出 JSON
- 封装统一响应：`successResponse()` / `errorResponse()`，配合 `http_response_code()` 返回 404 等状态码
- 整理 RESTful 约定：URL 表示资源、方法表示操作、200 / 201 / 204 / 400 / 401 / 403 / 404 / 500 的适用场景
- Cookie：`setcookie()` 的 `expires`、`path`、`httponly`、`samesite`，并验证跨请求读取
- Session：`session_start()`、`$_SESSION`、`session_id()`、`session_destroy()`，验证跨请求共享与销毁
- 文件上传：`$_FILES`、`UPLOAD_ERR_OK` 校验、`move_uploaded_file()`
- 文件下载：`Content-Type: application/octet-stream`、`Content-Disposition: attachment`、`readfile()`
- 表单校验：`trim()`、`filter_var()`（邮箱、整数）、错误收集与 400 响应
- XSS 转义：`htmlspecialchars($str, ENT_QUOTES, 'UTF-8')`
- 密码安全：`password_hash()` 生成哈希、`password_verify()` 校验，理解为什么不要存明文或自己写加密

留到后续阶段补：CSRF Token（阶段 6 认证）、PUT/PATCH/DELETE 请求体解析（阶段 5~6）。SQL 注入与预处理已在阶段 4 用 PDO 补齐。

### 阶段 4：数据库开发

**进度：已完成**

学习内容：

- PDO 的作用与使用方式
- PHP 连接 PostgreSQL
- 数据库 CRUD 操作
- SQL 预处理与参数绑定
- 事务与事务边界
- 主键、外键与约束
- 一对多、多对多关系
- 索引与查询优化基础
- 分页、排序、筛选与复杂查询

阶段目标：能够使用 PHP 安全、可靠地访问 PostgreSQL，并完成常见业务数据操作。

已完成：

- 确认 PHP 已加载 `pdo_pgsql` / `pgsql` 扩展
- 通过 SSH 隧道把阿里云上的 PostgreSQL 映射到本地 `127.0.0.1:5433`，数据库不对公网开放端口
- 用 PDO 连接（`pgsql:host=...;port=...;dbname=...`），设置 `ERRMODE_EXCEPTION` 与 `FETCH_ASSOC`
- 凭据管理：密码从 `DB_PASSWORD` 环境变量读取，缺失则直接退出，代码里不留密码
- 连接后查询 `current_database()`、`current_user`、`version()` 确认目标库、身份与版本
- 用 `PDOException` 捕获连接失败并输出原因
- 业务库与业务用户：`php_learning` + `php_learning_user`，不再用管理账号做练习
- `database.php` 抽出共享连接，各练习 `require_once` 复用
- 结果获取：`fetch()` / `fetchAll()` / `fetchColumn()`，以及 `while` 逐行遍历
- 练习表：`products`、`orders`、`order_items`、`transaction_demo`
- CRUD：`prepare()` + 参数绑定（`products/create.php`、`update.php`、`delete.php`、`query.php`、`list.php`），并用 `RETURNING` 直接拿到被操作的行
- SQL 注入原理与防护：对比拼接 SQL 与参数绑定，理解预处理把「数据」和「语句」分开
- 排序防注入：列名与方向白名单校验后再拼进 `ORDER BY`
- 动态条件查询 + 分页：按需拼 WHERE、`COUNT(*)` 算总页数、`LIMIT/OFFSET` 分页并显式绑定 `PARAM_INT`
- 事务：`beginTransaction` / `commit` / `rollBack` + `inTransaction()`，`transaction-test.php` 演示异常回滚
- 多表关系与跨表事务：`orders` + `order_items` 结构，`order.php` 一个事务内完成扣库存（带 `stock >= :n` 条件与 `RETURNING`）、写订单、写订单明细
- **PDO 整合成 HTTP API**：`public/products.php`
  - `GET /products.php?keyword=&page=&pageSize=` → 动态搜索 + 分页，返回 `data` 与 `pagination`
  - `POST /products.php`（JSON body）→ 校验后插入，成功 201 返回新记录，参数非法 400
  - 统一 `Content-Type: application/json` + `JSON_UNESCAPED_UNICODE`

本阶段未覆盖（留到阶段 6 做查询优化时补）：

- 索引：给 `name` / `price` / `created_at` 建索引，用 `EXPLAIN` 对比前后执行计划
- 显式外键约束的验证：插入不存在的 `product_id` 验证是否被拦住
- `JOIN` 查询练习：目前只有订单两张表的结构与写入，还没有联合查询
- 前缀模糊 `LIKE '%关键词%'` 为什么用不上 B-tree 索引

### 阶段 5：后端架构与设计

**进度：当前阶段**

学习内容：

- MVC 架构
- Router 路由
- Controller 控制器
- Service 业务层
- Repository 数据访问层
- 依赖注入（DI）
- 统一异常处理
- 配置管理与环境变量
- 日志系统
- 分层架构与职责划分
- API 响应结构设计

阶段目标：不依赖大型框架，从零搭建结构清晰、职责明确、可扩展的 PHP 后端骨架（练习项目，不承载商城业务），为阶段 6 使用 Laravel 打底。

### 阶段 6：Laravel 框架实战

学习内容：

- Laravel 项目结构与运行机制
- 路由与控制器
- Middleware 中间件
- Request / Response
- Form Validation
- Eloquent ORM
- Migration 数据库迁移
- 用户注册、登录与认证
- 角色与权限控制
- RESTful API 开发
- Redis 缓存
- Queue 队列与异步任务
- 自动化测试

阶段目标：**正式启动 MiniShop 项目开发**，用 Laravel 完成用户、商品、分类、购物车、订单、支付、缓存与异步任务的真实业务，并理解框架如何解决路由、依赖注入、数据库访问、认证、缓存和异步任务等问题。

### 阶段 7：部署、运维与综合实战

学习内容：

- Linux 常用命令与服务管理
- Nginx / Caddy
- PHP-FPM 与 Web 请求处理链路
- Docker 与 Docker Compose
- PostgreSQL、Redis 服务部署
- 环境变量与生产环境配置
- 日志查看与故障排查
- 文件权限与进程管理
- 性能优化
- 异步任务部署与监控
- 备份与恢复
- 基础系统设计

阶段目标：将完整项目部署到自己的阿里云服务器，能够完成基本的上线、运行维护、问题排查与性能优化。

## 三、实战项目：MiniShop 商城后端（阶段 6 正式启动）

**调整后的定位：阶段 1~5 只做聚焦单个知识点的小练习，不背商城业务；进入阶段 6（Laravel）后才正式开发 MiniShop，阶段 7 部署上线。**

### 这样安排的原因

- 阶段 1~5 的目标是理解语言、HTTP、数据库、分层架构，用最小可运行代码验证即可，过早套上完整业务会分散注意力；
- 原生 PHP 从零手写一个商城成本高、可维护性差，Laravel 自带路由、ORM、迁移、认证、队列，才是真实项目的合理载体；
- 阶段 5 的分层练习用一个「小型练习项目」验证 Router / Controller / Service / Repository 的职责划分——先懂结构，再用框架。

### 阶段 1~5 的练习载体

| 阶段 | 练习载体 | 目的 |
| --- | --- | --- |
| 1 | `php语言基础/` | 语法、数组、函数、OOP、异常 |
| 2 | `PHP 工程化基础/php-composer-demo/` | Composer、PSR-4、第三方依赖 |
| 3 | `PHP Web 开发基础/php-server/` | HTTP、超全局变量、Cookie/Session、上传下载、校验、安全基础 |
| 4 | `PHP数据库开发/` + 练习表（如 `products`） | PDO、CRUD、预处理、事务、动态查询与分页、把查询整合成 HTTP API |
| 5 | 待建的 `mini-framework` 练习项目 | Router、Controller、Service、Repository、DI、异常与日志 |

练习表只用于验证 SQL 与 PDO 能力，字段精简，不做完整商城建模；正式的表结构在阶段 6 用 Laravel Migration 重新设计。

### MiniShop 功能规划

| 模块     | 计划实现的功能                   |
| -------- | -------------------------------- |
| 用户模块 | 注册、登录、用户信息管理         |
| 权限模块 | 身份认证、角色与权限控制         |
| 商品模块 | 商品增删改查、库存管理           |
| 分类模块 | 商品分类、分类关联               |
| 搜索模块 | 商品搜索、筛选、分页             |
| 购物车   | 添加商品、删除商品、修改数量     |
| 订单模块 | 创建订单、订单明细、订单状态管理 |
| 支付模块 | 模拟支付、支付状态管理           |
| 缓存模块 | 使用 Redis 缓存商品等热点数据    |
| 异步模块 | 使用队列处理订单相关任务         |

### 技术栈

- **语言与框架：** PHP、Laravel
- **数据库：** PostgreSQL
- **缓存与队列：** Redis
- **部署：** Docker、Docker Compose
- **服务器：** Linux、阿里云 ECS
- **Web 服务：** Nginx 或 Caddy

### MiniShop 开发路线（阶段 6~7）

1. 初始化 Laravel 项目，配置 PostgreSQL 与 `.env`，跑通第一条 Migration。
2. 用户模块：注册、登录、Token / Session 认证，角色与权限控制。
3. 商品与分类：Migration + Eloquent 模型 + CRUD + 关联关系。
4. 搜索：筛选、排序、分页，理解查询构造器与索引的配合。
5. 购物车与订单：创建订单、订单明细、状态流转，用数据库事务保证一致性。
6. 支付：模拟支付流程与支付状态管理。
7. 缓存与异步：Redis 缓存热点商品，队列处理订单相关任务。
8. 自动化测试：为订单、支付等核心流程补测试。
9. 阶段 7：Docker Compose 部署到阿里云，配 Nginx / Caddy + PHP-FPM，补日志、监控与备份。

## 四、学习方式与约定

- **循序渐进：** 每次聚焦一个知识点，完成理解和实践后再进入下一步。
- **实践优先：** 尽量通过可运行的代码和小任务掌握知识，而不是只看概念。
- **解释命令：** 对终端命令说明用途、参数和执行结果。
- **联系前端经验：** 适当对比 JavaScript / TypeScript、Node.js 和 npm，重点解释 PHP 的不同之处。
- **先理解再使用框架：** 在进入 Laravel 前，先理解 HTTP、数据库和基本后端架构。
- **持续迭代练习：** 阶段 1~5 把知识落到各自的练习项目上；阶段 6 起才集中投入 MiniShop。
- **及时复盘：** 根据实际代码和运行结果检查掌握情况，再决定是否推进。

## 五、当前进度与下一步

阶段 1 ~ 4 已完成。阶段 4 覆盖了 PDO 连接、结果获取、预处理与参数绑定、CRUD、SQL 注入防护、事务与回滚、多表写入、动态查询、分页，最后把 PDO 查询整合成原生 HTTP 商品 API（`public/products.php`）。索引、外键约束验证与 `JOIN` 练习留到阶段 6 做查询优化时补。

当前进入 **阶段 5：后端架构与设计**。下一步建议按以下顺序继续：

1. 初始化 `mini-framework` 练习项目，用 Composer + PSR-4 注册自己的命名空间。
2. 写一个最小 Router：把 `/products`、`/products/{id}` 映射到处理函数，支持 GET / POST。
3. 拆 Controller：只负责解析请求参数、调用 Service、返回响应。
4. 拆 Service：库存校验、金额计算等业务规则集中于此，不依赖 HTTP。
5. 拆 Repository：把 `products.php` 里的 SQL 全部搬进去，Controller 不再直接碰 `$pdo`。
6. 加依赖注入：用构造函数注入 Repository，替代类内部 `require` / `new`。
7. 统一异常处理 + 统一响应结构，收口「连接失败返回 500 空响应」「缺配置时 `exit` 仍返回 200」这类问题。
8. 补配置管理（`.env` 式读取）与简单日志。
9. 阶段 5 只练结构（Router / Controller / Service / Repository / DI / 异常 / 日志），不写商城业务。
10. 阶段 6 起用 Laravel 正式开发 MiniShop，表结构用 Migration 重新设计，不复用练习表。

---

**最终目标：** 能够独立使用 PHP + Laravel 开发一个包含用户、商品、购物车、订单、缓存和异步任务的商城后端，并将其部署到自己的服务器上。
