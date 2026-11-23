# PHP 学习计划

## 一、学习目标

从具备前端开发经验的开发者出发，系统学习 PHP 后端开发，最终能够独立使用 **PHP + Laravel** 构建、测试、部署和维护完整的后端项目。

学习采用循序渐进、实践驱动的方式：先掌握 PHP 语言与工程化基础，再学习 Web 开发、数据库、后端架构，最后进入 Laravel 和生产环境部署。

## 二、完整学习路线

### 阶段 1：PHP 语言基础

**进度：基本完成**

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

**进度：当前阶段**

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

当前已完成：

- 安装 PHP 8.6.0
- 配置 `php.ini`
- 启用 `curl`、`mbstring`、`openssl`、`zip`
- 安装 Composer 2.11.2
- Composer 公钥配置完成
- `composer diagnose` 检查通过
- 验证 `PHPRC` 和 `PHP_INI_SCAN_DIR` 永久环境变量

待完成：

- 使用 `composer require` 安装第三方库（计划使用 Guzzle）
- 深入理解 `composer.json` 与 `composer.lock`
- 完成 PSR-4 自动加载实践
- 整理并完成工程化阶段

### 阶段 3：PHP Web 开发基础

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

### 阶段 4：数据库开发

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

### 阶段 5：后端架构与设计

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

阶段目标：不依赖大型框架，从零搭建结构清晰、职责明确、可扩展的 PHP 后端项目。

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

阶段目标：能够使用 Laravel 独立开发真实业务 API，理解框架如何解决路由、依赖注入、数据库访问、认证、缓存和异步任务等问题。

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

## 三、贯穿学习过程的实战项目：MiniShop 商城后端

整个学习过程使用同一个商城项目逐步迭代，而不是每个阶段都做互不相关的 Demo。

### 功能规划

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

### 项目演进方式

1. 阶段 1：编写 PHP 基础代码，熟悉语言特性。
2. 阶段 2：初始化项目，使用 Composer 管理依赖和自动加载。
3. 阶段 3：使用原生 PHP 实现基础 HTTP API。
4. 阶段 4：连接 PostgreSQL，实现商品、用户等数据操作。
5. 阶段 5：逐步重构为 Router、Controller、Service、Repository 等分层结构。
6. 阶段 6：使用 Laravel 实现完整商城业务。
7. 阶段 7：通过 Docker Compose 部署到阿里云服务器，补充缓存、异步任务、日志和运维能力。

## 四、学习方式与约定

- **循序渐进：** 每次聚焦一个知识点，完成理解和实践后再进入下一步。
- **实践优先：** 尽量通过可运行的代码和小任务掌握知识，而不是只看概念。
- **解释命令：** 对终端命令说明用途、参数和执行结果。
- **联系前端经验：** 适当对比 JavaScript / TypeScript、Node.js 和 npm，重点解释 PHP 的不同之处。
- **先理解再使用框架：** 在进入 Laravel 前，先理解 HTTP、数据库和基本后端架构。
- **持续迭代项目：** 将每个阶段学到的知识逐步应用到 MiniShop。
- **及时复盘：** 根据实际代码和运行结果检查掌握情况，再决定是否推进。

## 五、当前进度与下一步

当前处于 **阶段 2：PHP 工程化基础**。

下一步建议按以下顺序继续：

1. 重新打开 PowerShell，验证 PHP 永久环境变量是否生效。
2. 在 `php-composer-demo` 项目中执行 `composer require guzzlehttp/guzzle`。
3. 观察 `composer.json`、`composer.lock` 和 `vendor/` 的变化。
4. 使用 Guzzle 发起 HTTP 请求，理解第三方包的使用方式。
5. 学习依赖版本约束、`require-dev`、`install` 与 `update` 的区别。
6. 完成 PSR-4 自动加载实践，并整理工程化项目结构。
7. 进入阶段 3：PHP Web 开发基础。

---

**最终目标：** 能够独立使用 PHP + Laravel 开发一个包含用户、商品、购物车、订单、缓存和异步任务的商城后端，并将其部署到自己的服务器上。
