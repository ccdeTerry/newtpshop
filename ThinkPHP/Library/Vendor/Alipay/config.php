<?php
$config = array (
		//应用ID,您的APPID。
		'app_id' => "2016080700191460",
		//商户私钥
		'merchant_private_key' => "MIIEpAIBAAKCAQEAwbVDyDLmzY3ekwlyY+Hk1BXoFJkLpumCYr4ODBftzv3DD0UAqGYFE/n898UGsZYxDV3XUyQ8L0UayjY7VVaJAepG2fshcOUn5XmGL7SM5/QsLVOGoJ5t7QmNAaAU/n77D5MkSP0RvFD8czZMmombMRKhdkbxRqOBUNbvfQGSt5NX6kISwhwiUkxzCsPSZzNkVrH62j5sxmlAgHhXXlsu4jGYkU+2gsoWIVda91iujd78k5/PojnLekTT+ID/7lkUi07x0feg6PSlgeeoUTUsWO5Gz3E706GtVbqesqlrg718niKtM+hpTC7jQOVH08X7517crZ6eWC9rl48SIxiN+QIDAQABAoIBAFGCbdA7IwWR0ft7OSgwcLKRuUOZlt6YWaYlJRIPq6CzBTZSqdEyhKaAReMYhBWMBn4CY833bF/Tq081fMgPDr3AkCm/U7YGp0AXX9CJH9Wm2EQGZpsFr2nT4AK0EsF4Ozq1hsozuxfL2D6+tYM9rhD7LvfvKC26NXsHxmSKmesmluUWn+Ck3nX+c2XovqfX06ebVzl/OUMyBC3avgK1JOzu5cT+Yyox4Yzs57j6YX8hrVQxBrFJL0AxSel72oeQkBNdIOBr8wujJS8b6oJeXKx1vD7E2fsTNOVnp8i4jsHCbp3N2OWIUhKXlbbNtEu4B68CcfyuRm+2HmoLcLi3qoECgYEA/3aQNR+T+Z2ONJb/AsPjY+BSobFMxLG7tRVjTC2kjdouD/gYTiwLHi2tSyMFbXI6hBHmCFklcHS5p50iCLiIlZnxQuGVONZ8FuCE/ZRopWgMdELioOn7u9EJ44hOubp8TuaP0AfgpgjVdcsdHxhT/6gc6nR0KmHUDdBlhTXg2xECgYEAwh16U0bwGdOVGP3YIhzhJdBFIAYjMYNd8qXFSzruwg9SPQtcJgr3tY+WmTOnAuWtnp111idyr3dsdrw24/GjdSZce812hyfioKMjlSIRx1SF6coMIi1pwIj2+X0Zw5jz8JEvC6rhwItABrOtfOOLkzofc0HX1RKsqqGYTy7rdGkCgYBHWlVjESPip5gtpjMqEY60udY6pWv80GvOY1/tyh3ZJSSSf0hCpVihoD5z6x8795jShLFMiaHEbEXixCfaabh0mJ/jf2CPlJDqTuG2djpYYNyBqKDmMxSF3Bg3/j2G8MiBvTJT969OkM8WbJoAsmnb0ZfqAIblw5dYGGoSr/7TEQKBgQCdDwDElKb8HoeKewj/QOKil8r2SED9dM7030+suPgpp//gSGq8lS8rhgxR1MsSuwcpSTnolm5irnvh7hNzhzW8Odemi+2VGZ5yXs0Rg0ljQG5BZStAFAJ2t9ssrh3EduMZCD9Kb27NPV4GjiaW3/00mFiOBv489ikivjDgEJSN0QKBgQDFzKT4ulYxPAkDSXk6ReypLBFOISkM0/j/joTapi+3RrPBA08+M1710dP+qTANiT86kRiJUaFjEwy/8yBxAdN9EIKbXLFzkixoO50Vp1UZ7GBsvWSSz6wrmizjwdf386O8NFy+CItUC6RSt/kjATmCm+u7/f+7oqOlqkkkuOqyoA==",

		//异步通知地址
		'notify_url' => "http://localhost.test.com/notify_url.php",

		//同步跳转
		'return_url' => "http://web.newtpshop.com/Order/returnUrl",
//		'return_url' => "http://localhost.test.com/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA6H9mLKUQnYDwUKz57CHQhuDuJcnFv5ff/Ck2iHxVTg4q1VTMvKSN/rSMl+vfE7p72I7N0MVeuCQfvg5HCRxZnWFjqR83ZvC+A6c3A+rSeXzLkrY97VaBcBad+9JrPsIper6lLXup9TFeNDqdchjeN+AeQt1dszhbkp+EFSF2iswi2+StXVf2T8a7dopDH31Bx/gRQFGon7ist8srHlsdt39VXK1d3AnI6ytU8pr+dM5Wpo/S3ts714ggLStXh0V2uAba6qa8fmLZ//81gsPDit5S/gBUzwpcntF0XaCAyEg4aMnRJL0wMftMyi/ZTKqkcKIBJvTY+VkLG2Ys/Y5G8QIDAQAB",
);