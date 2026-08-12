# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

---

## 项目概述

**ZenTaoPMS (禅道)** 开源项目管理软件，版本 22.4。基于 PHP 的自研 MVC 框架 ZenTaoPHP 构建。

**注意**: 尽管仓库路径包含 `java-workspace`，这是一个 **PHP 项目**，不是 Java 项目。

---

## 技术栈

| 层级 | 技术 |
|------|------|
| 后端语言 | PHP 7.x+ |
| 框架 | 自研 ZenTaoPHP (MVC) |
| 数据库 | MySQL 8.0+ (表前缀 `zt_`) |
| 前端 UI | ZIN (自研组件库) + ZUI (自研 JS 库) + jQuery |
| 前端 JS | Vanilla JS + ZUI 组件 |
| 模板引擎 | PHP 原生模板 (HTML + PHP 混编) |
| 扩展 | RoadRunner (ZAND) |

---

## 目录结构

```
zentaopms/
├── www/                          # Web 入口 & 静态资源
│   ├── index.php                 # 主入口
│   ├── api.php                   # API 入口
│   ├── install.php               # 安装入口
│   ├── upgrade.php               # 升级入口
│   ├── init.php                  # 单元测试入口
│   ├── static/                   # 静态资源 (CSS/JS/图片/字体)
│   ├── theme/                    # 主题 (blue/default/green/pink/purple/red/blackberry/classic)
│   ├── js/                       # 第三方 JS 库 (ZUI, jQuery, ECharts, Vue 等)
│   └── data/                     # 上传文件存储
│
├── framework/                    # ZenTaoPHP 框架核心
│   ├── router.class.php          # 路由器 (URL 解析、模块加载)
│   ├── control.class.php         # 控制器基类
│   ├── model.class.php           # 模型基类
│   ├── helper.class.php          # 辅助函数
│   ├── xuanxuan.class.php        # 喧喧(即时通讯)集成
│   ├── api/                      # API 路由框架
│   └── base/                     # 框架基类 (router/control/model/helper)
│
├── module/                       # 应用模块 (~106 个)
│   ├── bug/                      # 示例模块: Bug 管理
│   │   ├── control.php           # 控制器
│   │   ├── model.php             # 业务模型
│   │   ├── zen.php               # ZIN 数据方法
│   │   ├── tao.php               # 数据访问层
│   │   ├── view/                 # 视图模板 (HTML)
│   │   ├── lang/                 # 语言包 (zh-cn, zh-tw, en)
│   │   ├── config.php            # 模块配置
│   │   ├── css/                  # 模块样式
│   │   ├── js/                   # 模块脚本
│   │   └── ui/                   # ZIN UI 定义
│   ├── common/                   # 公共模块 (权限、配置、初始化)
│   ├── index/                    # 首页模块
│   ├── product/                  # 产品管理
│   ├── project/                  # 项目管理
│   ├── execution/                # 执行/迭代管理
│   ├── story/                    # 需求管理
│   ├── task/                     # 任务管理
│   ├── testcase/                 # 用例管理
│   ├── testtask/                 # 测试任务
│   ├── user/                     # 用户管理
│   ├── ...                       # 其他模块
│   └── extension/                # 扩展点 (ext 目录)
│
├── lib/                          # 第三方库
│   ├── dao/                      # 数据库访问对象 (DAO)
│   ├── phpmailer/                # 邮件发送
│   ├── phpexcel/                 # Excel 操作
│   ├── phpword/                  # Word 操作
│   ├── zin/                      # ZIN UI 框架
│   │   ├── core/                 # ZIN 核心
│   │   ├── wg/                   # ZIN 组件
│   │   ├── zentao/               # ZenTao 专用组件
│   │   └── zui/                  # ZUI 封装
│   ├── pclzip/                   # ZIP 压缩
│   ├── phpaes/                   # AES 加密
│   ├── captcha/                  # 验证码
│   ├── purifier/                 # HTML 净化 (XSS 防护)
│   ├── spout/                    # CSV/Excel 导出
│   └── ...                       # 其他库
│
├── config/                       # 配置
│   ├── config.php                # 系统默认配置
│   ├── my.php                    # 本地配置覆盖 (DB 连接等)
│   ├── ext/                      # 扩展配置
│   ├── filter.php                # 输入过滤规则
│   ├── privilege.php             # 权限配置
│   └── license/                  # 许可证文件
│
├── db/                           # 数据库
│   ├── zentao.sql                # 完整数据库结构
│   ├── install.sql               # 安装 SQL
│   ├── update*.sql               # 版本升级 SQL
│   └── standard/                 # 标准 SQL
│
├── extension/                    # 企业版扩展
│   ├── biz/                      # 企业版
│   ├── max/                      # 旗舰版
│   ├── ipd/                      # IPD 版
│   ├── lite/                     # 迅捷版
│   ├── custom/                   # 自定义
│   ├── devops/                   # DevOps
│   ├── or/                       # 运维
│   └── xuan/                     # 喧喧
│
├── api/                          # RESTful API v1
│   └── v1/entries/               # API 端点
│
├── bin/                          # 命令行工具
│   ├── ztcli                     # 命令行入口 (PHP CLI)
│   ├── init.sh / init.bat        # 初始化脚本
│   └── roadrunner/               # RoadRunner 配置
│
├── build/                        # 构建脚本
│   └── mergeflow.php             # 工作流合并
│
├── hook/                         # 安装/升级/卸载钩子
├── doc/                          # 文档
├── tmp/                          # 临时文件
├── sdk/                          # 客户端 SDK
├── roadrunner/                   # RoadRunner 配置
└── misc/                         # 杂项
```

---

## 架构核心概念

### MVC 模式

- **control.php** — 控制器，处理请求、调用模型、渲染视图。继承自 `control` 基类
- **model.php** — 业务模型，包含核心业务逻辑。继承自 `model` 基类
- **view/** — 视图模板 (`.html.php` 文件)，PHP 原生模板
- **zen.php** — ZIN 数据方法，提供前端组件所需的数据 (ZIN 架构模式)
- **tao.php** — 数据访问层，封装 DAO 操作

### 请求生命周期

```
www/index.php → router.class.php → 解析 URL (模块/方法/参数)
  → 加载目标模块 control.php → 构造函数调用父类构造
  → 执行目标方法 → 渲染视图 → 输出
```

### URL 路由

- 默认模式: `PATH_INFO`，URL 格式: `http://host/module-method-param1-param2.html`
- 可通过 `config/my.php` 配置 `requestType` 为 `GET` 模式:
  `http://host/?m=module&f=method&params=...`

### 模块结构规范

每个模块遵循统一结构:
```
module/{模块名}/
├── control.php     # 控制器
├── model.php       # 模型
├── zen.php         # ZIN 数据层
├── tao.php         # DAO 数据层
├── config.php      # 模块配置
├── view/           # 视图
├── lang/           # 多语言 (zh-cn.php, zh-tw.php, en.php)
├── css/            # 样式
├── js/             # 脚本
├── ext/            # 扩展点
└── ui/             # ZIN UI 定义
```

### 扩展机制

- 企业版/旗舰版功能通过 `extension/` 目录扩展
- 模块扩展文件放在 `module/{模块名}/ext/` 下
- 通过 `config/ext/` 扩展配置
- 扩展点自动加载，无需手动引入

---

## 开发命令

### 启动开发环境

```bash
# 使用 PHP 内置服务器
php -S 0.0.0.0:8080 -t www/

# 或使用 RoadRunner (需安装)
./roadrunner/rr serve -c roadrunner/.rr.yaml
```

### 命令行调用

```bash
# 通过 CLI 执行模块方法
php bin/ztcli "http://localhost/module-method-params"
```

### 数据库初始化

```bash
# 导入数据库结构
mysql -u root -p zentao < db/zentao.sql

# 初始化数据
mysql -u root -p zentao < db/init.sql
```

### 单元测试

```bash
# 使用测试入口 (需要配置)
php www/init.php module-method
```

### 权限检查

```bash
# 确保 www/data/ 和 tmp/ 目录可写
chmod -R 755 www/data/ tmp/
```

---

## 数据库

- **主库**: MySQL 8.0+，表前缀 `zt_`
- 连接配置: `config/my.php` (`$config->db->*`)
- SQL 文件: `db/zentao.sql` (完整结构), `db/update*.sql` (增量升级)
- 数据库迁移: 通过升级脚本 (`db/update*.sql`) 按版本号顺序执行
- 升级入口: `www/upgrade.php`

---

## 前端开发

- **ZIN 组件**: 使用 `lib/zin/` 框架，后端渲染组件，通过 `zen.php` 提供数据
- **ZUI**: 自研 UI 组件库 (`www/js/zui/`)，jQuery 插件风格
- **主题**: 在 `www/theme/` 目录下，每个主题包含 `style.css`
- **多语言**: 语言包位于 `module/*/lang/`，支持 zh-cn, zh-tw, en
- **JS 库**: `www/js/` 包含 ZUI3, jQuery, ECharts, Vue 等前端库

---

## 扩展开发

```bash
# 扩展目录结构
extension/{edition}/
├── {module}/ext/     # 扩展模块
├── lang/             # 扩展语言包
└── config/           # 扩展配置
```

支持的扩展版本: `biz` (企业版), `max` (旗舰版), `ipd` (IPD版), `lite` (迅捷版)

---

## 关键文件速查

| 用途 | 路径 |
|------|------|
| 应用入口 | `www/index.php` |
| API 入口 | `www/api.php` |
| 安装程序 | `www/install.php` |
| 升级程序 | `www/upgrade.php` |
| CLI 入口 | `bin/ztcli` |
| 框架路由 | `framework/router.class.php` |
| 框架控制器 | `framework/control.class.php` |
| 框架模型 | `framework/model.class.php` |
| 框架辅助 | `framework/helper.class.php` |
| 系统配置 | `config/config.php` |
| 本地配置 | `config/my.php` |
| 数据库 schema | `db/zentao.sql` |
| 权限配置 | `config/privilege.php` |
| 输入过滤 | `config/filter.php` |
| 动作映射 | `config/actionsmap.php` |
| 前端主 JS | `www/js/all.js` |
| 前端主 CSS | `www/theme/default/style.css` |