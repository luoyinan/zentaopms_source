<?php

/**
 * The ai module zh-tw lang file of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禪道軟件（青島）集團有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Wenrui LI <liwenrui@easycorp.ltd>
 * @package     ai
 * @link        https://www.zentao.net
 */
$lang->aiapp->common           = 'AI';
$lang->aiapp->squareCategories = array('collection' => '我的收藏', 'discovery' => '發現', 'latest' => '最新');
$lang->aiapp->newVersionTip    = '小程序已于%s更新，以上為過往記錄';
$lang->aiapp->noMiniProgram    = '您訪問的小程序不存在';
$lang->aiapp->title            = '小程序';
$lang->aiapp->unpublishedTip   = '您使用的小程序沒有發佈';
$lang->aiapp->noModelError     = '暫無可用的語言模型，請聯繫管理員配置。';
$lang->aiapp->chatNoResponse   = '會話發生了錯誤';
$lang->aiapp->more             = '更多';
$lang->aiapp->collect          = '收藏';
$lang->aiapp->deleted          = '已刪除';
$lang->aiapp->clear            = '清空';
$lang->aiapp->modelCurrent     = '當前語言模型';
$lang->aiapp->categoryList     = array('work' => '工作', 'personal' => '個人', 'life' => '生活', 'creative' => '創意', 'others' => '其它');
$lang->aiapp->generate         = '生成';
$lang->aiapp->regenerate       = '重新生成';
$lang->aiapp->emptyNameWarning = '「%s」不能為空';
$lang->aiapp->chatTip          = '請在左側輸入欄位內容，生成結果試試吧。';
$lang->aiapp->noModel          = array('尚未配置語言模型，請聯繫管理員或跳轉至後台配置<a id="to-language-model">語言模型</a>。', '若已完成相關配置，請嘗試<a id="reload-current">重新加載</a>頁面。');
$lang->aiapp->clearContext     = '上下文內容已清除';
$lang->aiapp->newChatTip       = '請在左側輸入欄位內容，開啟新對話。';
$lang->aiapp->disabledTip      = '當前小程序已被禁用。';
$lang->aiapp->continueasking   = '繼續追問';

$lang->aiapp->miniProgramSquare  = '查看通用智能體廣場';
$lang->aiapp->collectMiniProgram = '收藏通用智能體';
$lang->aiapp->miniProgramChat    = '執行通用智能體';
$lang->aiapp->view               = '查看通用智能體詳情';
$lang->aiapp->browseConversation = '瀏覽智能會話';
$lang->aiapp->manageGeneralAgent = '管理通用智能體';
$lang->aiapp->models             = '瀏覽模型列表';
$lang->aiapp->toolkit            = '智能工具';
$lang->aiapp->viewAiToolkit      = '查看智能工具';

$lang->aiapp->id                 = 'ID';
$lang->aiapp->model              = '模型名稱';
$lang->aiapp->converse           = '開始會話';
$lang->aiapp->pageSummary        = '共%s項';

$lang->aiapp->tips = new stdClass();
$lang->aiapp->tips->noData = '暫無數據';

$lang->aiapp->langData                      = new stdClass();
$lang->aiapp->langData->name                = '禪道';
$lang->aiapp->langData->storyReview         = '需求評審';
$lang->aiapp->langData->storyReviewHint     = '對當前頁面需求進行評審';
$lang->aiapp->langData->storyReviewMessage  = "下面是要進行評審的需求：\n\n### 需求標題\n\n{title}\n\n### 需求描述\n\n{spec}\n\n### 需求驗收標準\n\n{verify}";
$lang->aiapp->langData->aiReview            = 'AI評審';
$lang->aiapp->langData->currentPage         = '當前頁面';
$lang->aiapp->langData->story               = '需求';
$lang->aiapp->langData->demand              = '需求池需求';
$lang->aiapp->langData->bug                 = 'BUG';
$lang->aiapp->langData->doc                 = '文檔';
$lang->aiapp->langData->design              = '設計';
$lang->aiapp->langData->feedback            = '反饋';
$lang->aiapp->langData->currentDocContent   = '當前文檔';
$lang->aiapp->langData->globalMemoryTitle   = '禪道';
$lang->aiapp->langData->zaiConfigNotValid   = '尚未進行ZAI配置，請聯繫管理員進行<a href="{zaiConfigUrl}">ZAI配置</a>。<br>若已完成相關配置，請嘗試重新加載頁面。';
$lang->aiapp->langData->unauthorizedError   = '授權失敗，無效的API密鑰，請聯繫管理員進行<a href="{zaiConfigUrl}">ZAI配置</a>。<br>若已完成相關配置，請嘗試重新加載頁面。';
$lang->aiapp->langData->processDataPrefix   = "要進行處理的數據如下：\n{data}";
$lang->aiapp->langData->processedDataResult = "處理後的數據如下：\n```json\n{data}\n```";
$lang->aiapp->langData->agentResultSummary  = '對方案中數據的變化進行解釋，儘量對變化的屬性分別進行說明。';
$lang->aiapp->langData->promptResultTitle   = '方案標題，如果沒有合適標題可以省略';
$lang->aiapp->langData->promptExtraLimit    = '通常工具 `{toolName}` 只需要調用一次，除非用戶特殊要求提供多個方案。';
$lang->aiapp->langData->promptResultReturn  = '已經在界面展示處理後的數據，無需對處理後的數據進行重複展示，也不需要進一步描述和解釋，禁止向用戶展示處理後的原始 JSON 數據，僅需要提醒我可以通過點擊“應用到{formName}表單”按鈕來使用這些數據即可。';
$lang->aiapp->langData->goTesting           = '去調試';
$lang->aiapp->langData->notSupportPreview   = '暫不支持預覽該內容';
$lang->aiapp->langData->dataListSizeInfo    = '共%s條數據';
$lang->aiapp->langData->promptTestDataIntro = '下面是要進行{name}的示例{type}：';
$lang->aiapp->langData->searchingKLibs      = '正在查找知識庫...';
$lang->aiapp->langData->recentChats         = '最近聊天';
$lang->aiapp->langData->aiTeammateTasks     = '數字員工任務';
$lang->aiapp->langData->searchTasks         = '搜索數字員工任務';

$lang->aiapp->toolkitTitle = '禪道智能工具箱';
$lang->aiapp->toolkitItems = array();
$lang->aiapp->toolkitItems['cli']    = array('title' => 'CLI技能');
$lang->aiapp->toolkitItems['mcp']    = array('title' => 'MCP服務');

$lang->aiapp->toolkitItems['cli']['image']    = 'static/images/zentao-cli.png';
$lang->aiapp->toolkitItems['cli']['subtitle'] = '讓Agents工具通過命令行來使用禪道';
$lang->aiapp->toolkitItems['cli']['intro']    = <<<'MARKDOWN'
禪道全新發佈了命令行工具，支持通過命令行的方式來訪問禪道數據和操作禪道。
命令行工具同時提供開箱即用的技能供Agents使用，安裝禪道命令行技能後，您可以讓AI Agent（如Cursor、Claude Code等）直接查詢項目進度、分析Bug風險，甚至自動生成需求文檔。技能會調用禪道命令行工具讀寫禪道數據，讓大模型變身您的研發管理助手。

#### 主要特性

* 基于禪道"RESTful API 2.0"
* 一行命令即可運行：`npx zentao-cli`
* 安全認證，支持多用戶切換
* 支持數據篩選、過濾、排序，自動將HTML轉為Markdown
* 對AI Agent友好，內置完善幫助信息，原生支持Markdown輸出
* 支持作為AI技能使用，`zentao add-skill`一鍵安裝到Agent
* 內置MCP服務，`npx zentao-cli mcp`即可啟動

#### 支持的Agents工具

禪道CLI可在所有支持技能或MCP的Agent工具中使用。下表按上手難度從易到難列出常見選擇：

| 新手推薦 | 開發者推薦 | 進階/付費推薦 |
|:----------:|:----------:|:------------:|
| [Cursor](https://www.cursor.com/) | [Cline](https://cline.bot/) | [Trae](https://www.trae.ai/) |
| [VS Code Copilot](https://code.visualstudio.com/docs/copilot/overview) | [OpenClaw](https://www.openclaw.ai/) | [Codex](https://openai.com/codex/) |
| [Cherry Studio](https://www.cherry-ai.com/) | [OpenCode](https://www.opencode.ai/) | [Antigravity](https://antigravity.google/) |
| | [Claude Code](https://docs.anthropic.com/en/docs/claude-code.md) | [Codex CLI](https://developers.openai.com/codex/cli/reference) |

#### 快速開始

##### 第一步：安裝技能

**1. 讓Agent自動安裝**：現代Agent工具大都支持自動發現並安裝技能，把下面這段話發給Agent即可：

```
安裝https://cn.clawhub-mirror.com/catouse/zentao-cli技能，並安裝技能所需的zentao-cli命令行工具。
```

**2. 手動安裝**：開發者也可以直接在終端裡執行命令安裝：

```
# 全局安裝zentao-cli工具
$ npm install -g zentao-cli
# 其他安裝與運行方式
# bun install -g zentao-cli  # ← 使用bun安裝
# npx zentao-cli             # ← 通過npx免安裝運行
# pnpm dlx zentao-cli        # ← 通過pnpm免安裝運行

# 安裝完成後，一鍵把技能裝到Agent中
$ zentao add-skill
請選擇要安裝的AI Agent:
  1) Claude Code
  2) Cursor
  3) Cherry Studio
  4) Codex
  5) OpenCode
  6) VS Code
  7) Antigravity
  8) Gemini
  9) 全部安裝
請輸入編號 (1-9):9
```

##### 第二步：賬號登錄與鑒權

裝好後需要先登錄一次。出於賬號安全考慮，強烈建議不要把賬號密碼發給AI Agent，請改用以下本地配置方式：

1. 環境變數（推薦）：把禪道URL、用戶名和密碼寫到環境變數裡，工具會自動登錄並續期Token。

```sh
export ZENTAO_URL=https://zentao.example.com
export ZENTAO_ACCOUNT=admin
export ZENTAO_PASSWORD=123456
```

2. 命令行登錄：也可以用命令行手動登錄：

```sh
zentao login -s https://zentao.example.com -u admin -p 123456
```

##### 第三步：對話與實戰

配置好後，您就能在對應的Agent工具裡像和同事聊天一樣使用禪道了。下面是幾個實戰示例：

* 需求與規劃：“我想創建一個產品，用來在綫收集用戶信息，請幫我整理思路，並生成第一版需求和計劃，有問題儘管問我。”
* 進度追蹤：“上周新增了哪些需求？哪些比較難？我想針對難點提前制定方案。”
* 缺陷分析：“BUG 329 是什麼問題？可能的原因是什麼？有解決方案嗎？”
* 風險分析：“迭代10的執行情況如何？有哪些風險？”

#### 升級與維護

ZenTao CLI或技能有新版本時，可以這樣升級：

```sh
# 升級CLI本身
zentao upgrade
# 再用add-skill命令升級技能
zentao add-skill
```

也可以直接讓Agent幫您升級：

```
請幫我升級zentao-cli，並通過zentao add-skill命令重新安裝最新的技能。
```

#### 常見問題 (FAQ)

##### Q：這個CLI技能和之前發佈的ZenTao-API技能有什麼不同？該用哪個？

A：強烈推薦CLI技能。它把複雜的API細節封裝好了，支持更多功能（如數據過濾、Markdown轉換），還更省Token，大模型不用操心API調用，可以專註解決真實問題；而ZenTao API技能要大模型自己處理API，容易出錯。

##### Q：我不懂Agent、技能這些概念，怎麼上手？

A：在AI接管地球之前，先彆著急。受限于Agent能力，目前還不能完全替代禪道GUI。建議先從簡單查詢開始，或者試試內置的ZenTao Tour技能，它會用有趣的方式帶您體驗。

##### Q：可以在禪道AI裡使用嗎？

A：暫時還不支持在禪道內直接用CLI，但我們正在加緊開發ZAI Agents平台，之後會在禪道里直接支持安裝技能。

##### Q：為什麼有些操作（比如操作模組、讀寫文檔）實現不了？

A：CLI目前依賴禪道API 2.0，部分介面還在完善中，敬請期待後續更新。

#### 相關內容

* 禪道官方技能庫：https://github.com/easysoft/zentao-skills
* 禪道CLI開源倉庫：https://github.com/easysoft/zentao-cli
MARKDOWN;

$lang->aiapp->toolkitItems['mcp']['image']    = 'static/images/zentao-mcp.png';
$lang->aiapp->toolkitItems['mcp']['subtitle'] = '讓Agents工具通過MCP協議來使用禪道';
$lang->aiapp->toolkitItems['mcp']['intro']    = <<<'MARKDOWN'
禪道MCP是基于MCP模型上下文協議實現的橋接代理服務。可將禪道API2.0等遵循OpenAPI規範的REST介面，自動轉為MCP標準工具，供Claude、Cursor、CodeBuddy等AI助手統一調用，實現跟禪道數據的相互調用（可以從禪道中獲取數據，也可以更新禪道中的數據）。

#### 核心特性

* **自動轉換能力**：從OpenAPI/Swagger文檔自動生成MCP工具，無需人工編寫適配邏輯，適配所有遵循該規範的REST API。
* **傳輸協議支持**：同時兼容Streamable HTTP和SSE（Server-Sent Events），兼顧兼容（HTTP）和實時性（SSE），適配不同AI客戶端的通信需求。
* **鏈路追蹤**：內置OpenTelemetry鏈路追蹤和指標收集，能監控服務調用鏈路、收集運行指標，方便問題排查和服務優化。
* **多服務代理**：單個禪道MCP實例可同時代理多個不同的API服務，不僅支持禪道API，還能適配其他遵循OpenAPI規範的系統API，擴展性強。
* **跨平台部署**：支持Linux、macOS、Windows主流系統，部署靈活。

#### 快速開始

##### （一）配置MCP服務（四選一即可）

###### 1. Windows用戶配置方式

**第一步：下載安裝包**

* [AMD 64位包](https://pkg.zentao.net/zentao-mcp/1.0.1/zentao-mcp-windows-amd64.zip)
* [ARM 64位包](https://pkg.zentao.net/zentao-mcp/1.0.1/zentao-mcp-windows-arm64.zip)

**第二步：解壓包**

以AMD-64位為例，將下載的包解壓到目錄 `D:\zentao-mcp`。

**第三步：修改MCP配置**

```sh
# 複製配置模板：
copy D:\zentao-mcp\config.example.yaml D:\zentao-mcp\config.yaml

# 修改配置檔案：
D:\zentao-mcp\config.yaml
schema_url: "D:/zentao-mcp/docs/zentao-openapi.json" # 更新為實際檔案路徑
base_url: "https://禪道域名/api.php/v2"               # 修改您的禪道訪問域名
```

**第四步：啟動MCP服務**

```sh
# 在cmd命令行執行啟動命令：
D:\zentao-mcp\bin\zentao-mcp-windows-amd64.exe -config D:\zentao-mcp\config.yaml
```

###### 2. Linux用戶配置方式

**第一步：下載包**

```sh
# AMD-64位：
curl -k -L -O https://pkg.zentao.net/zentao-mcp/1.0.1/zentao-mcp-linux-amd64.tar.gz
# ARM-64位：
curl -k -L -O https://pkg.zentao.net/zentao-mcp/1.0.1/zentao-mcp-linux-arm64.tar.gz
```

**第二步：解壓包**

以AMD-64位為例：

```sh
# 建目錄：
mkdir -p /opt/zentao-mcp
# 解壓包：
tar -zxvf zentao-mcp-linux-amd64.tar.gz -C /opt/zentao-mcp
```

**第三步：修改MCP配置**

```sh
# 複製配置模板：
cp /opt/zentao-mcp/config.example.yaml /opt/zentao-mcp/config.yaml

# 修改配置檔案：
/opt/zentao-mcp/config.yaml
schema_url: "/opt/zentao-mcp/docs/zentao-openapi.json" # 更新為實際檔案路徑
base_url: "https://禪道域名/api.php/v2"                 # 修改您的禪道訪問域名
```

**第四步：啟動MCP服務**

```sh
/opt/zentao-mcp/bin/zentao-mcp-linux-amd64 -config /opt/zentao-mcp/config.yaml
```

###### 3. Mac用戶配置方式

**第一步：下載包**

```sh
# AMD-64位：
curl -k -L -O https://pkg.zentao.net/zentao-mcp/1.0.1/zentao-mcp-darwin-amd64.tar.gz
# ARM-64位：
curl -k -L -O https://pkg.zentao.net/zentao-mcp/1.0.1/zentao-mcp-darwin-arm64.tar.gz
```

**第二步：解壓包**

以AMD-64位為例：

```sh
# 建目錄：
mkdir /opt/zentao-mcp
# 解壓包：
tar -zxvf zentao-mcp-darwin-amd64.tar.gz -C /opt/zentao-mcp
```

**第三步：修改MCP配置**

```sh
# 複製配置模板：
cp /opt/zentao-mcp/config.example.yaml /opt/zentao-mcp/config.yaml

# 修改配置檔案：
/opt/zentao-mcp/config.yaml
schema_url: "/opt/zentao-mcp/docs/zentao-openapi.json" # 更新為實際檔案路徑
base_url: "https://禪道域名/api.php/v2"                 # 修改您的禪道訪問域名
```

**第四步：啟動MCP服務**

```sh
/opt/zentao-mcp/bin/zentao-mcp-darwin-amd64 -config /opt/zentao-mcp/config.yaml
```

###### 4. 原始碼啟動（面向開發者）

**第一步：克隆代碼**

```sh
git clone https://github.com/easysoft/zentao-mcp.git
```

**第二步：啟動項目**

```sh
# 進入項目：
cd zentao-mcp
# 下載依賴：
go mod tidy
# 啟動命令：
go build -o zentao-mcp ./cmd/app
```

##### （二）配置MCP客戶端（AI助手）

**第一步：調用禪道API V2介面獲取Token**

```sh
curl -X POST "http://您的禪道域名/api.php/v2/user/login" \
   -H "Content-Type: application/json" \
   -d '{"account":"用戶名","password":"密碼"}'
```

該請求返回的 JSON 對象中 `token` 屬性即為 Token。

**第二步：在AI助手中配置MCP**

```json
{
  "mcpServers": {
    "zentao": {
      "disabled": false,
      "type": "mcp",
      "url": "http://127.0.0.1:9090/zentao/mcp",
      "timeout": 60000,
      "headers": {
        "token": "禪道API V2 Token",
        "Authorization": ""
      }
    },
    "gitfox": {
      "disabled": false,
      "type": "sse",
      "url": "http://127.0.0.1:9090/gitfox/sse",
      "timeout": 60000,
      "headers": {
        "Authorization": "GitFox Token"
      }
    }
  }
}
```

#### 場景示例

* **創建產品**：在禪道中創建一個名為“運維監控平台”的產品。
* **創建需求**：在禪道xxx產品中的產品創建一個xxxx需求。
* **創建代碼庫**：在GitFox創建名為example-repo的代碼庫。
* **生成代碼並推送至倉庫**：在GitFox代碼庫生成一份腳手架代碼並推送。

#### 相關連結

* 禪道API手冊：https://www.zentao.net/book/api/2309.html
* GitFox介紹：https://www.gitfox.net/
* 項目源碼：https://github.com/easysoft/zentao-mcp
MARKDOWN;
