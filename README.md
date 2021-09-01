# 嘟嘟识字卡-后端
【嘟嘟早教卡】是专门为 3-6 岁婴幼儿童学习普通话、英语研发的早教启蒙认知识字的小程序，这里是后端源码，由 Laravel、Tailwind CSS 及 AlpineJS 构建而成。

小程序地址：[https://github.com/hipig/ddcard-weapp](https://github.com/hipig/ddcard-weapp)

## 关于项目

该项目包括了管理后台以及小程序接口

暂时没有预览地址,后台地址为：域名/admin
### 截图
![截图](https://user-images.githubusercontent.com/24596908/131635955-abd0896e-e441-42f6-85fd-bc7f28e890ce.png)

### 环境说明

| 语言    | 版本                 |
| ------- | -------------------- |
| `PHP`   | `^7.4` |
| `MySQL` | `5.7`                |
| `Node` | `12.18`                |

### 安装
```
# 安装扩展包
composer install

# 复制环境变量配置
cp .env.example .env

# 生成 APP_KEY
php artisan key:generate

# 修改本地环境变量配置
vim .env
-------------------------
# APP
APP_NAME="Your App Name"
APP_ENV=production
APP_DEBUG=false
APP_URL="Your App Url"

# 数据库
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

# 队列
QUEUE_CONNECTION=

# 小程序
WECHAT_MINI_PROGRAM_APPID=
WECHAT_MINI_PROGRAM_SECRET=

# 微信支付
WECHAT_PAYMENT_APPID=
WECHAT_PAYMENT_MCH_ID=
WECHAT_PAYMENT_KEY=

#讯飞语音合成
XFYUN_TTS_APP_ID=
XFYUN_TTS_API_SECRET=
XFYUN_TTS_API_KEY=

#思必驰语音合成
AISPEECH_TTS_PRODUCT_ID=
AISPEECH_TTS_API_KEY=
-------------------------

# 生成 JWT_SECRET
php artisan jwt:secret

# 数据库迁移
php artisan migrate
# 填充管理员账户（默认：admin/password）
php artisan db:seed --class=AdminUserSeeder

# 前端打包
npm install
npm run prod

#队列运行
php artisan queue:work
```
