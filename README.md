# 后台代码

## demo 待完成

### 0、注册

请求地址：http://120.77.212.41/MYHTML/shundai/register.php
==========================================================

请求格式：
```json
{
	"Type":0,
	"Content":{
		"username":"不透明",
		"password":"123467"
	}
}
```
返回格式：
```json
{
    "ErrorCode": 0,
    "ErrorMessage": "NONE",
    "content": {
        "status": 200,
        "info": "success",
        "data": "注册成功啦!!"
    }
}
```


请求地址：http://120.77.212.41/MYHTML/shundai/getInformation.php
==========================================================


### 1、登陆

请求格式：
```json
{
        "Type":0,
    "Content": {
        "Account":"老大",
        "Password":"123456"
    }
}
```
返回格式：
```json
{
    "ErrorCode": 0,
    "ErrorMessage": "NONE",
    "content": {
        "status": 200,
        "info": "success",
        "data": {
            "id": 2,
            "username": "老大",
            "password": "123456",
            "avatar": null,
            "phonenumber": "18883649890",
            "sex": 1,
            "token": null
        }
    }
}
```
### 2、请求快递列表

请求格式：
```json
{
	"Type":1,
    "Content": {
        "Account":"老大"  //账户名，请求名为 老大 的快递列表
    }
}
```
返回格式：
```json
{
    "ErrorCode": 0,
    "ErrorMessage": "NONE",
    "content": {
        "status": 200,
        "info": "success",
        "data": [
            {
                "deliverid": 5,
                "nickname": "老大",
                "avatar": null,
                "delivertype": "韵达快递",
                "receivetime": "9:00-12:00",
                "sendlocation": "重邮五栋"
            },
            {
                "deliverid": 10,
                "nickname": "老大",
                "avatar": null,
                "delivertype": "韵达快递",
                "receivetime": "9:00-12:00",
                "sendlocation": "重邮五栋"
            }
        ]
    }
}

```

### 3、请求快递详细信息

请求格式：
```json
{
	"Type":2, 
    "Content": {
        "deliverid":2 
    }
}
```


返回格式：
```json
{
    "ErrorCode": 0,
    "ErrorMessage": "NONE",
    "content": {
        "status": 200,
        "info": "success",
        "data": [
            {
                "deliverid": 2,
                "deliverstatus": 0,
                "avatar": null,
                "delivertype": "顺丰快递",
                "receivetime": "8:00-9:00",
                "sendlocation": "重邮15栋",
                "note": null,
                "repay": "30元",
                "nickname": "张中豪",
                "phonenumber": "18883649890",
                "sex": 1,
                "token": null
            }
        ]
    }
}
```


### 4、请求二手列表

请求格式：
```json
{
	"Type":3,
    "Content": {
    	"page":1,  //你要请求的页数
    	"count":5  //请求的条数
    }
}
```

返回格式：
```json
{
    "ErrorCode": 0,
    "ErrorMessage": "NONE",
    "content": {
        "status": 200,
        "info": "success",
        "data": [
            {
                "goodsid": 1,
                "title": "我是一本书",
                "image": null,
                "price": "88元"
            },
            {
                "goodsid": 3,
                "title": "没有标题",
                "image": null,
                "price": "66元"
            },
            {
                "goodsid": 4,
                "title": "有标题了",
                "image": null,
                "price": "76元"
            },
            {
                "goodsid": 5,
                "title": "还是没有标题",
                "image": null,
                "price": "81元"
            },
            {
                "goodsid": 6,
                "title": "震惊",
                "image": null,
                "price": "86元"
            }
        ]
    }
}
```


### 5、请求二手详细信息


请求格式：
```json
{
	"Type":4,
    "Content": {
    	"goodsid":1
    }
}
```
返回格式：
```json
{
    "ErrorCode": 0,
    "ErrorMessage": "NONE",
    "content": {
        "status": 200,
        "info": "success",
        "data": [
            {
                "goodsid": 1,
                "title": "我是一本书",
                "avatar": null,
                "nickname": "张中豪",
                "image": null,
                "token": null,
                "publishtime": "2015年11月15日",
                "publishid": 1,
                "page": 200,
                "words": "10000字",
                "printtime": "2018年5月1日",
                "format": 1,
                "paper": "胶版纸",
                "printtimes": 1,
                "package": "平装",
                "isbn": "488564132168",
                "price": "88元",
                "recommended": null
            }
        ]
    }
}
```

请求地址：  http://139.199.23.185/shundai/modifyAvatar.php
============================================================

### 6、修改用户头像

请求格式:
上传png图片
图片名称为 你要修改头像用户的 "id "+ ".png "

![qingqiu](screenshot/modifyAvatar.jpg)
如上图所示为修改id为2的用户的头像为2.png

返回格式：
{
    "ErrorCode": 0,
    "ErrorMessage": "NONE",
    "content": {
        "status": 200,
        "info": "success",
        "data": {
            "avatarUrl": "http://139.199.23.185/shundai/picture/avatar/2.png"
        }
    }
}
