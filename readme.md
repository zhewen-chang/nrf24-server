# nRF24-server

## 功能
- 把 gateway 存來的資料存入資料庫
- Web 介面

## 定期清資料庫
- mysql_delete.sh
```shell
#!/bin/bash 
mysql -uzhe -ppassword-e "use swimmingpool;DELETE FROM log WHERE 1;"
```

- crontab
```
30 1 * * * mysql_delete.sh
```
