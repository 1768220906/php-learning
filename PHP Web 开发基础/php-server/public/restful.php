<?php

/* 
基本：
URL 表示资源，而不是操作。 使用 /api/products，而不是 /api/getProducts。
HTTP 方法表示操作。 GET、POST、PUT、PATCH、DELETE 各自承担不同语义。
资源通常使用名词复数。 例如 /users、/orders、/products。

eg：
GET	/api/products	获取商品列表
GET	/api/products/1001	获取 ID 为 1001 的商品
POST	/api/products	创建商品
PUT	/api/products/1001	整体修改商品
PATCH	/api/products/1001	部分修改商品
DELETE	/api/products/1001	删除商品

状态码：
成功：200
获取成功	200
创建成功	201
删除成功，无响应内容	204

客户端错误：400
请求参数错误	400
未登录	401
没有权限	403
资源不存在	404

服务端错误：500
*/