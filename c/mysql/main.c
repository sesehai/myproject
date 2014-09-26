#include "mysql.h"

int main(int argc, char *argv[]){
    MYSQL *connect;
    SQL_ROW_DATA row_data;
    MYSQL_CONNECT_CONF conConf = {
        "xxx.xxx.xxx.xxx",
        "user",
        "pwd",
        "db",
        3306,
        NULL,
        0,
        "utf8"
    };
    
    connect = get_connect(conConf);
    row_data = execute_sql(connect, "SELECT *  FROM tb LIMIT 1000 ");
    if(row_data.row_num > 0){
        printf("-----------has rows-----------\n");

        // 输出第一条
        /*
        if( (row_data.rows[0].cols[3].name) && (row_data.rows[0].cols[3].data) ){
            fprintf(stderr, "[*] \t%s = %s\n", row_data.rows[0].cols[3].name, row_data.rows[0].cols[3].data);
        }
        */

        // 全部输出
        print_rows(row_data);

    }else{
        printf("---------------no rows-------------\n");
    }
    free_data_rows(row_data);
    mysql_close(connect);

    return 0;
}